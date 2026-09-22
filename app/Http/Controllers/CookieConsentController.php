<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CookieConsentController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'consent' => 'nullable|string|max:500',
            'user_agent' => 'nullable|string|max:500',
            'ip_address' => 'nullable|ip',
            'url' => 'nullable|url|max:500',
            'accepted' => 'nullable|boolean',
        ]);

        $data = $validated;
        $csvFile = storage_path('app/cookie-consents.csv');
        
        // Create headers if file doesn't exist
        if (!file_exists($csvFile)) {
            $headers = array_keys($data);
            file_put_contents($csvFile, implode(',', array_map(function($h) {
                return '"' . str_replace('"', '""', $h) . '"';
            }, $headers)) . "\n");
        }
        
        // Append data with CSV injection prevention
        $values = array_map(function($value) {
            if (is_string($value)) {
                // Sanitize CSV injection: strip leading =, +, -, @, \t, \r
                $value = preg_replace('/^[=+\-@\t\r]/', '', $value);
                return '"' . str_replace('"', '""', $value) . '"';
            }
            return $value;
        }, array_values($data));
        
        file_put_contents($csvFile, implode(',', $values) . "\n", FILE_APPEND);
        
        return response()->json(['success' => true]);
    }
    
    public function download()
    {
        $csvFile = storage_path('app/cookie-consents.csv');
        
        if (!file_exists($csvFile)) {
            abort(404, 'No cookie consent data found');
        }
        
        return response()->download($csvFile, 'cookie-consents-' . date('Y-m-d') . '.csv');
    }
}
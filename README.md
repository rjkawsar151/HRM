# HRM & HRM SaaS - Human Resource Management System

A modern, comprehensive Human Resource Management System built with **Laravel 12**, **Inertia.js**, **React 19**, **TypeScript**, and **Tailwind CSS v4**.

---

## 📋 Table of Contents

- [Features](#-features)
- [Tech Stack](#-tech-stack)
- [System Requirements](#-system-requirements)
- [Installation Guide](#-installation-guide)
  - [Step 1: Clone or Extract Codebase](#step-1-clone-or-extract-codebase)
  - [Step 2: Install Composer Dependencies](#step-2-install-composer-dependencies)
  - [Step 3: Install Node Dependencies](#step-3-install-node-dependencies)
  - [Step 4: Configure Environment Variables](#step-4-configure-environment-variables)
  - [Step 5: Generate Application Key](#step-5-generate-application-key)
  - [Step 6: Create Storage Symlink](#step-6-create-storage-symlink)
  - [Step 7: Create the Installed Flag](#step-7-create-the-installed-flag)
  - [Step 8: Run Database Migrations & Seeders](#step-8-run-database-migrations--seeders)
  - [Step 9: Compile Frontend Assets](#step-9-compile-frontend-assets)
- [Default Login Credentials](#-default-login-credentials)
- [Running the Application](#-running-the-application)
  - [Development Mode](#development-mode)
  - [All-in-One Development Command](#all-in-one-development-command)
  - [Production Mode](#production-mode)
- [Queue & Background Scheduler](#-queue--background-scheduler)
- [Useful Commands & Troubleshooting](#-useful-commands--troubleshooting)

---

## ✨ Features

- **Multi-Tenancy & SaaS Support**: Switch between multi-tenant SaaS mode and standalone single-company mode (`IS_SAAS=true/false`).
- **Core HR**: Employee directories, departments, designations, branches, and profiles.
- **Attendance & Time Tracking**: Shift management, IP restrictions, biometric sync, daily attendance records, and regularization.
- **Leave Management**: Leave policies, types, allocations, balances, and multi-level approval workflows.
- **Recruitment (ATS)**: Job openings, requisitions, candidate pipeline, interview scheduling, assessments, and onboarding checklists.
- **Performance & Appraisal**: Indicators, goal tracking, review cycles, and 360-degree reviews.
- **Payroll Management**: Salary components, pay runs, payslips, and compensation structures.
- **Training & Development**: Programs, sessions, and employee training tracking.
- **Contracts & Document Management**: Templates, dynamic placeholders, acknowledgments, and NOC / joining letter generators.
- **Role-Based Access Control**: Granular permissions for Super Admin, Company Admin, HR, Manager, and Employee powered by Spatie.
- **Multi-Payment Gateway Integration**: Stripe, PayPal, Razorpay, Cashfree, MercadoPago, Mollie, Paystack, CoinGate, and more.

---

## 💻 Tech Stack

- **Backend**: PHP 8.2+, Laravel 12
- **Frontend**: React 19, TypeScript, Inertia.js 2.0, Tailwind CSS v4, Radix UI, Lucide React
- **Database**: MySQL 5.7+ / 8.0+ or MariaDB 10.3+
- **Asset Bundler**: Vite 6

---

## ⚙️ System Requirements

Ensure your server or local environment meets the following specifications:

- **PHP**: `>= 8.2`
- **Composer**: `>= 2.0`
- **Node.js**: `>= 18.x` or `>= 20.x`
- **NPM**: `>= 9.x` (or Yarn / PNPM)
- **Database Server**: MySQL `5.7+` / `8.0+` or MariaDB `10.3+`
- **Required PHP Extensions**:
  - `BCMath`
  - `Ctype`
  - `cURL`
  - `DOM`
  - `Fileinfo`
  - `JSON`
  - `Mbstring`
  - `OpenSSL`
  - `PCRE`
  - `PDO` & `pdo_mysql`
  - `Tokenizer`
  - `XML`
  - `GD` or `Imagick` (for image processing / badges)
  - `Zip` (for exports / imports)

---

## 🚀 Installation Guide

### Step 1: Clone or Extract Codebase

Open your terminal, navigate to your web root, and clone or extract the project:

```bash
git clone https://github.com/ekramasif/HRM.git
cd HRM
```

---

### Step 2: Install Composer Dependencies

Install the backend PHP dependencies using Composer:

```bash
composer install
```

> **Note for Production:** In production environments, run:
> ```bash
> composer install --no-dev --optimize-autoloader
> ```

---

### Step 3: Install Node Dependencies

Install the frontend packages using NPM:

```bash
npm install
```

---

### Step 4: Configure Environment Variables

Duplicate the `.env.example` file to create your `.env` configuration file:

**On Linux / macOS:**
```bash
cp env.example .env
```

**On Windows (PowerShell):**
```powershell
Copy-Item env.example .env
```

**On Windows (CMD):**
```cmd
copy env.example .env
```

Open `.env` in a text editor and update the primary settings:

```env
APP_NAME="HRM SaaS"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

# SaaS & Demo Modes
IS_SAAS=true             # Set to true for SaaS mode (Super Admin + Companies), or false for single-company
IS_DEMO=false            # Set to true only if you want comprehensive demo data seeded

# Database Configuration
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password

# Queue & Cache
QUEUE_CONNECTION=database # Or sync for local testing
CACHE_STORE=file
SESSION_DRIVER=file
```

> **Important:** Make sure you create an empty MySQL database matching `DB_DATABASE` in your database server before proceeding.

---

### Step 5: Generate Application Key

Generate the Laravel encryption key:

```bash
php artisan key:generate
```

---

### Step 6: Create Storage Symlink

Link the storage directory to the public directory so uploaded files (avatars, logos, documents) are accessible:

```bash
php artisan storage:link
```

---

### Step 7: Create the Installed Flag

The application checks for `storage/installed` to know installation is complete and begin loading global settings:

**On Linux / macOS:**
```bash
touch storage/installed
```

**On Windows (PowerShell):**
```powershell
New-Item -ItemType File -Path storage/installed -Force
```

**On Windows (CMD):**
```cmd
type nul > storage\installed
```

---

### Step 8: Run Database Migrations & Seeders

Migrate database tables and seed required system roles, permissions, currencies, email templates, and default users:

#### Standard Clean Installation (Recommended)
```bash
php artisan migrate --seed
```

#### Demo Installation (Populated with Dummy Employees, Departments, Reviews, etc.)
1. Ensure `IS_DEMO=true` is set in your `.env`.
2. Run:
```bash
php artisan migrate:fresh --seed
```

---

### Step 9: Compile Frontend Assets

#### For Local Development:
```bash
npm run dev
```

#### For Production Build:
```bash
npm run build
```

---

## 🔑 Default Login Credentials

After running `php artisan migrate --seed`:

### 1. Super Admin (Available when `IS_SAAS=true`)
- **URL**: `http://localhost:8000/login`
- **Email**: `superadmin@example.com`
- **Password**: `password`
- **Role**: Full access to platform management, subscriptions, companies, and global settings.

### 2. Default Company Admin
- **URL**: `http://localhost:8000/login`
- **Email**: `company@example.com`
- **Password**: `password`
- **Role**: Company administrator managing HR, employees, departments, payroll, and settings.

### 3. Demo Companies (Available when `IS_DEMO=true`)
If seeded in demo mode, multiple pre-configured companies are available:
- `admin@techcorp.com` / `password`
- `admin@digitalinnovations.com` / `password`
- `admin@globalsystems.com` / `password`

---

## 🖥️ Running the Application

### Development Mode

Run the backend server and frontend compiler concurrently in separate terminals:

**Terminal 1 (Backend):**
```bash
php artisan serve
```

**Terminal 2 (Frontend HMR):**
```bash
npm run dev
```

Visit the application at: **[http://localhost:8000](http://localhost:8000)**

---

### All-in-One Development Command

The project provides a built-in Composer development script that launches the Artisan server, queue worker, Laravel Pail log viewer, and Vite together:

```bash
composer run dev
```

---

### Production Mode

1. **Web Server Root**: Point your web server (Nginx or Apache) document root to the `public/` folder.
2. **Directory Permissions (Linux)**:
   ```bash
   chmod -R 775 storage bootstrap/cache
   chown -R www-data:www-data storage bootstrap/cache
   ```
3. **Optimize Laravel**:
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```
4. **Compile Assets**:
   ```bash
   npm run build
   ```

---

## ⏱️ Queue & Background Scheduler

### Background Queue Worker
Certain features like transactional emails, notifications, and webhooks utilize queues:

```bash
php artisan queue:work --tries=3
```

In production, run this under **Supervisor** or systemd.

### Cron Job Scheduler
To trigger scheduled tasks (e.g., contract renewal alerts, attendance syncs, leave balance resets):

Add this cron entry on your Linux server:
```bash
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```

---

## 🛠️ Useful Commands & Troubleshooting

| Task | Command |
| :--- | :--- |
| **Clear All Caches** | `php artisan optimize:clear` |
| **Refresh Database & Seed** | `php artisan migrate:fresh --seed` |
| **Re-link Storage** | `php artisan storage:link` |
| **Check Route List** | `php artisan route:list` |
| **Lint & Format Code** | `npm run lint` / `npm run format` |
| **Type Check TypeScript** | `npm run types` |
| **Extract Translations** | `php extract-translations.php` |

### Common Issues:

- **Storage / Uploaded Images Not Showing**: Run `php artisan storage:link` and ensure `storage/app/public` exists and has proper permissions.
- **Missing Global Settings / Errors on First Load**: Verify that the empty file `storage/installed` exists.
- **Styles or Scripts Missing**: Run `npm run build` or start `npm run dev`.
- **Permission Denied in `storage/` or `bootstrap/cache`**: On Linux/macOS, run `chmod -R 775 storage bootstrap/cache`.

---

## 📄 License

This project is licensed under the [MIT License](LICENSE).
#   H R M  
 
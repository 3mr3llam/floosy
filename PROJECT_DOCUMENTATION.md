# Floosy Money Transfer Platform

## Overview

Floosy is a Laravel-based money transfer platform that processes invoices in 10-minute batch cycles based on cumulative value thresholds. The system implements a sophisticated batching mechanism where invoices are grouped by time windows and processed collectively when the total value meets or exceeds 50 SAR.

## Core Process Flow

### 1. Invoice Creation Process

#### Client Perspective
1. **Client Login**: Client logs into the portal using their email and password
2. **Merchant Selection**: Client selects from a list of merchants they have relationships with
3. **Invoice Creation**: Client enters the invoice amount and submits
4. **Immediate Processing**:
   - System deducts 2% fee from the invoice amount
   - Invoice is marked as "Pending"
   - Invoice is assigned to the current 10-minute cycle
   - System checks for carry-over opportunities

#### System Processing
- **Fee Calculation**: `fee_amount = gross_amount * 0.02`
- **Net Amount**: `net_amount = gross_amount - fee_amount`
- **Cycle Assignment**: Invoice gets `entered_at` timestamp and is grouped with other invoices in the same 10-minute window

### 2. 10-Minute Cycle Evaluation

#### Automatic Processing (Every Minute via Scheduler)
At the end of each 10-minute window, the system:

1. **Collects All Pending Invoices** in the completed cycle
2. **Calculates Total Net Amount**:
   ```php
   $total = sum of all net_amounts in the cycle
   ```
3. **Threshold Check**:
   - If `total >= 50 SAR` → All invoices in cycle become "Scheduled"
   - If `total < 50 SAR` → All invoices in cycle become "Suspended"

4. **Scheduled Status**: Invoices are queued for transfer processing

### 3. Carry-Over Mechanism

When a new invoice is created in any cycle:

1. **Suspended Invoice Check**: System checks all previously "Suspended" invoices
2. **Combined Calculation**:
   ```php
   $combined_total = sum of all suspended net_amounts + new invoice net_amount
   ```
3. **Carry-Over Trigger**:
   - If `combined_total >= 50 SAR` → All suspended + new invoice become "Scheduled"
   - If `combined_total < 50 SAR` → New invoice becomes "Pending" (normal flow)

### 4. Status Transition Timeline

#### Scheduled → Overdue (10 Minutes After Scheduling)
- After 10 minutes in "Scheduled" status
- Automatic transition to "Overdue"
- Indicates transfer should be complete

#### Overdue → Paid/Not Received (Manual Merchant Action)
- Merchant logs into their dashboard
- Reviews "Overdue" invoices
- Manually marks as "Paid" (funds received) or "Not Received" (issue reported)

### 5. Complete Status Flow

```
Pending → Scheduled → Overdue → Paid
   ↓         ↓         ↓
Suspended  Scheduled  Not Received
```

## Technical Architecture

### Core Components

#### Domain Layer
- **Money**: Value object for SAR amounts with safe arithmetic
- **CycleWindow**: 10-minute time window representation
- **FeePolicy**: Strategy for fee calculation (currently 2%)
- **InvoiceStatus**: Enum for status values

#### Services
- **BatchAggregatorService**: Core batching logic and carry-over
- **InvoiceStatusTransitionService**: Status transition validation and execution
- **CycleBucketing**: Current cycle determination

#### Infrastructure
- **InvoiceRepository**: Data access with locking for concurrent safety
- **Scheduler Jobs**: Automatic cycle evaluation and overdue transitions
- **Event System**: Domain events for logging and notifications

### Database Schema

#### Core Tables
- `users`: Clients and merchants (role-based)
- `merchants`: Merchant profile details
- `merchant_user`: Many-to-many client-merchant relationships
- `invoices`: Invoice records with status tracking
- `cycles`: 10-minute batch windows (optional persistence)
- `site_settings`: Configuration (fee percentage, cumulative threshold)

## Setup Instructions

### Prerequisites
- PHP 8.2+
- Composer
- Node.js & NPM
- XAMPP/Laravel Valet/any web server
- MySQL database

### Installation Steps

#### 1. Clone and Install Dependencies
```bash
git clone https://github.com/your-repo/floosy.git
cd floosy
composer install
npm install
```

#### 2. Environment Configuration
```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` file:
```env
APP_NAME=Floosy
DB_DATABASE=floosy_db
DB_USERNAME=your_username
DB_PASSWORD=your_password

# For XAMPP Livewire fix
LIVEWIRE_UPDATE_PATH=floosy/livewire/update
LIVEWIRE_JAVASCRIPT_PATH=floosy/public/livewire/livewire.js
```

#### 3. Database Setup
```bash
# Create database in phpMyAdmin/XAMPP
php artisan migrate
php artisan db:seed
```

#### 4. Admin Setup
```bash
php artisan shield:super-admin --user=1
php artisan make:filament-user
```

#### 5. XAMPP Livewire Configuration

**Edit `config/livewire.php`:**
```php
'asset_url' => '/floosy/public/vendor/livewire/livewire.js',
```

**Edit `app/Providers/AppServiceProvider.php`:**
```php
use Livewire\Livewire;

Livewire::setUpdateRoute(function ($handle) {
    return Route::post(env('LIVEWIRE_UPDATE_PATH'), $handle)->name('custom-livewire.update');
});

Livewire::setScriptRoute(function ($handle) {
    return Route::get(env('LIVEWIRE_JAVASCRIPT_PATH'), $handle);
});
```

#### 6. Build Assets
```bash
npm run build
# or for development
npm run dev
```

#### 7. Start Scheduler (Required for batching)
```bash
# In production, add to cron:
# * * * * * cd /path-to-project && php artisan schedule:run >> /dev/null 2>&1

# For development testing:
php artisan schedule:work
php artisan queue:work
```

### User Setup

#### Create Merchants
1. Login to admin panel (`/admin`)
2. Go to Merchants → Create Merchant
3. Fill in details and set role to "merchant"

#### Create Clients
1. In admin panel, go to Clients → Create Client
2. Fill in details and set role to "client"

#### Link Clients to Merchants
- Use the `merchant_user` pivot table or admin interface
- Clients can only create invoices for linked merchants

### Testing the System

#### 1. Login as Client
- Visit `/` (portal landing page)
- Click "I'm a Client"
- Login with client credentials
- Select merchant and create invoice

#### 2. Monitor Batches
- Check admin panel for invoice status changes
- Watch logs: `storage/logs/laravel.log`
- Use scheduler to trigger automatic processing

#### 3. Login as Merchant
- Visit `/` → "I'm a Merchant"
- View and manage your invoices
- Mark overdue invoices as Paid/Not Received

### Configuration

#### Site Settings (Admin Panel)
- **Fee Percentage**: Default 2% (configurable)
- **Cumulative Value Threshold**: Default 50 SAR (configurable)
- These affect fee calculation and batch processing

### Key URLs
- **Portal**: `/`
- **Admin Panel**: `/admin`
- **Client Portal**: `/client` (authenticated)
- **Merchant Portal**: `/merchant` (authenticated)

### Troubleshooting

#### Common Issues

1. **Livewire not working in XAMPP**
   - Ensure asset_url in `config/livewire.php` matches your project path
   - Check `LIVEWIRE_*` env variables

2. **Scheduler not running**
   - Use `php artisan schedule:work` for development
   - Set up cron job for production

3. **Permission errors**
   - Run `php artisan shield:generate --all` to generate permissions
   - Check user roles in database

4. **Database connection**
   - Verify `.env` database credentials
   - Ensure database exists and user has permissions

### Production Deployment

#### Additional Steps
1. **Optimize for production**:
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

2. **Set up proper cron job**:
   ```bash
   crontab -e
   # Add: * * * * * cd /path-to-project && php artisan schedule:run >> /dev/null 2>&1
   ```

3. **Configure web server** (Apache/Nginx) for Laravel

4. **SSL certificate** for HTTPS

5. **Backup strategy** for database

### API Integration (Optional)

If external systems need to integrate:

#### Webhook Endpoints
The system emits events that can trigger webhooks:
- `InvoiceCreated`
- `InvoicesScheduled`
- `InvoicesSuspended`
- `InvoicesOverdue`

#### REST API
Add API routes for:
- Invoice creation
- Status checking
- Merchant/client management

### Monitoring & Maintenance

#### Logs to Monitor
- `storage/logs/laravel.log`: General application logs
- Database notifications: Admin action failures
- Event logs: Domain event tracking

#### Regular Tasks
- Monitor invoice processing rates
- Check for stuck invoices
- Review failed batch operations
- Clean up old logs

---

## Summary

Floosy implements a sophisticated batching system where:
1. **Individual invoices** are created with immediate fee deduction
2. **10-minute cycles** group invoices for collective processing
3. **Threshold evaluation** determines if batches proceed to transfer
4. **Carry-over logic** rescues suspended invoices when new ones arrive
5. **Status transitions** track the complete payment lifecycle
6. **Automatic scheduling** handles time-based status changes
7. **Admin oversight** allows manual status management

The system ensures efficient processing while maintaining financial controls and providing comprehensive audit trails.

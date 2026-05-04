# Debt Tracker Application

A Laravel-based application to track debts and repayments.

## Features
- Track total debt amounts.
- Manage repayment history.
- Estimate monthly installments.
- Mobile-responsive UI.

## Getting Started

### Prerequisites
- PHP 8.2+
- Composer
- Node.js & NPM

### Installation

1. **Clone the repository**
   ```bash
   git clone <your-repository-url>
   cd tang
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment Setup**
   Copy the example environment file and generate an application key:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database Setup**
   This project uses SQLite. Create the database file:
   ```bash
   touch database/database.sqlite
   ```
   *Note: On Windows PowerShell, use `New-Item database/database.sqlite`*

5. **Run Migrations & Seeders**
   ```bash
   php artisan migrate --seed
   ```

6. **Build Assets**
   ```bash
   npm run build
   ```

7. **Start the Server**
   ```bash
   php artisan serve
   ```

## Database Structure
The database consists of:
- `debts`: Stores the main debt records.
- `repayments`: Stores the payment history for each debt.

## License
MIT

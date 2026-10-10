# Mini POS (IT0049 TFA 2)

A four-page CodeIgniter 4 website: Home, About, Customer Accounts, User Accounts.
Customer and user records are stored in a MySQL database and retrieved through
CodeIgniter Models (Query Builder).

## Requirements
- PHP 8.2+ (with intl, mbstring, and mysqli)
- Composer
- MySQL (for example, through XAMPP)

## Setup
1. Clone the repo: `git clone https://github.com/Quack-Duckkk/1TSY2627_IT0049_TW32-11.git`, then `cd` into it
2. Run `composer install`
3. Copy `env` to `.env`, then set `CI_ENVIRONMENT = development`
   and `app.baseURL = 'http://localhost:8080/'`

## Database Setup
1. Start MySQL (for example, through XAMPP).
2. Import `app/Database/mysite_pos.sql` using phpMyAdmin (Import tab). This creates the `mysite_pos` database with the `customers` and `users` tables and sample data.
3. In your `.env`, set the database connection:

```ini
database.default.hostname = localhost
database.default.database = mysite_pos
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
database.default.port = 3306
```

## Run
1. Run `php spark serve`
2. Open http://localhost:8080

## Pages
| URL | Description |
|---|---|
| / | Landing page |
| /about | About page |
| /customers | Customer accounts (from MySQL via CustomerModel) |
| /users | User accounts (from MySQL via UserModel) |

## Live Demo
Not required for this activity (TFA 2). Run locally using the steps above.

# Mini POS (IT0049 TFA 3)

A CodeIgniter 4 website: Home, About, Customer Accounts, User Accounts.
Customer and user records are stored in a MySQL database and retrieved through
CodeIgniter Models (Query Builder). TFA 3 adds validated forms to create and edit
records, plus avatar upload for users.

## Requirements
- PHP 8.2+ (with intl, mbstring, mysqli, and **gd**)
- Composer
- MySQL (for example, through XAMPP)

## Setup
1. Clone the repo: `git clone https://github.com/Quack-Duckkk/1TSY2627_IT0049_TW32-11.git`, then `cd` into it
2. Run `composer install`
3. Copy `env` to `.env`, then set `CI_ENVIRONMENT = development`
   and `app.baseURL = 'http://localhost:8080/'`
4. Make sure the GD extension is enabled in `php.ini` (`extension=gd`), then restart the server. It is needed to resize avatar images.

## Database Setup
1. Start MySQL (for example, through XAMPP).
2. Import `app/Database/mysite_pos.sql` using phpMyAdmin (Import tab). This creates the `mysite_pos` database with the `customers` and `users` tables (including the `users.avatar` column) and sample data.
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
| /customers/new | New customer form (full name required, valid email required) |
| /customers/{id}/edit | Edit customer form, pre-filled with the existing record |
| /users | User accounts with avatars (from MySQL via UserModel) |
| /users/new | New user form (username required and unique, full name required) |
| /users/{id}/edit | Edit user form, pre-filled, with avatar upload |

## Forms, Validation, and File Upload (TFA 3)
- All forms are protected with CSRF tokens.
- Invalid input is rejected with clear error messages, and the user's entries are kept on redisplay.
- Avatar upload accepts JPG or PNG files up to 2MB only.
- Uploaded images get a random filename, are resized to a 150x150 thumbnail, and are saved in `public/uploads/`.
- Only the filename is stored in the `users.avatar` column.
- Users without an avatar show a placeholder image (`public/images/placeholder.svg`).

## Live Demo
Not required for this activity (TFA 3). Run locally using the steps above.
# Mini POS (IT0049 TFA 4)

A CodeIgniter 4 website: Home, About, Customer Accounts, User Accounts.
Customer and user records are stored in a MySQL database and retrieved through
CodeIgniter Models (Query Builder). TFA 3 added validated forms to create and edit
records, plus avatar upload for users. TFA 4 adds login, session-based
authentication, and a filter that protects the customer and user pages.

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
2. Import `app/Database/mysite_pos.sql` using phpMyAdmin (Import tab). This creates the `mysite_pos` database with the `customers` and `users` tables (including the `users.avatar` and `users.password` columns) and sample data.
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

## Test Login (TFA 4)
- URL: http://localhost:8080/login
- Username: `admin`
- Password: `password123`
- All seeded users (admin, cashier1, cashier2, manager1, staff1, Glnbr) share this same password.

## Pages
| URL | Description | Login required? |
|---|---|---|
| / | Landing page | No |
| /about | About page | No |
| /login | Login form | No |
| /logout | Destroys the session and redirects to /login | No |
| /customers | Customer accounts (from MySQL via CustomerModel) | **Yes** |
| /customers/new | New customer form (full name required, valid email required) | **Yes** |
| /customers/{id}/edit | Edit customer form, pre-filled with the existing record | **Yes** |
| /users | User accounts with avatars (from MySQL via UserModel) | **Yes** |
| /users/new | New user form (username required and unique, full name required) | **Yes** |
| /users/{id}/edit | Edit user form, pre-filled, with avatar upload | **Yes** |

## Sessions and Authentication (TFA 4)
- Passwords are stored in the `users.password` column as hashes created with `password_hash()`. No plain-text passwords are stored.
- The login form (`Auth::attempt`) finds the user by username and checks the typed password with `password_verify()`.
- Wrong username or wrong password shows the same generic error message.
- On success the session stores only small identifiers (`isLoggedIn`, `user_id`, `username`), and the session ID is regenerated.
- `AuthFilter` (`app/Filters/AuthFilter.php`, alias `auth`, registered in `app/Config/Filters.php`) runs before the controller. Logged-out visitors are redirected to `/login`.
- The filter is applied to all Customers and Users routes (including the new and edit forms and their POST routes) through a route group in `app/Config/Routes.php`.
- Logout (`Auth::logout`) calls `session()->destroy()` and redirects to `/login`.
- The navigation bar shows the logged-in username and a Logout link only when logged in.

### Access control tests
1. Logged out, visiting `/customers`, `/users`, `/customers/new`, or `/users/1/edit` redirects to `/login`.
2. A wrong password shows an error and stays on the login page.
3. A correct login redirects to `/customers`, and all protected pages open normally.
4. After logout, protected pages redirect to `/login` again.

## Forms, Validation, and File Upload (TFA 3)
- All forms are protected with CSRF tokens.
- Invalid input is rejected with clear error messages, and the user's entries are kept on redisplay.
- Avatar upload accepts JPG or PNG files up to 2MB only.
- Uploaded images get a random filename, are resized to a 150x150 thumbnail, and are saved in `public/uploads/`.
- Only the filename is stored in the `users.avatar` column.
- Users without an avatar show a placeholder image (`public/images/placeholder.svg`).

## Known Limitation
- The Create User form does not have a password field yet, so users created through it have no password and cannot log in until one is set in the database.

## Live Demo
Not required for this activity (TFA 4). Run locally using the steps above.
# Mini POS (IT0049 TFA 1)

A four-page CodeIgniter 4 website: Home, About, Customer Accounts, User Accounts.
Customer and user lists use static PHP arrays (no database yet).

## Requirements
- PHP 8.2+ (with intl and mbstring)
- Composer

## Setup
1. Clone the repo: `git clone https://github.com/Quack-Duckkk/1TSY2627_IT0049_TW32-11.git`, then `cd` into it
2. Run `composer install`
3. Copy `env` to `.env`, then set `CI_ENVIRONMENT = development`
   and `app.baseURL = 'http://localhost:8080/'`
4. Run `php spark serve`
5. Open http://localhost:8080

## Pages
| URL | Description |
|---|---|
| / | Landing page |
| /about | About page |
| /customers | Customer accounts (static array) |
| /users | User accounts (static array) |

## Live Demo
(add hosted link here once it's live)
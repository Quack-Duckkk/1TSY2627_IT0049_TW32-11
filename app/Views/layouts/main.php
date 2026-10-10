<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title ?? 'Mini POS') ?> | Mini POS</title>
    <style>
        body  { font-family: Arial, sans-serif; margin: 0; background: #f5f6f8; }
        nav   { background: #2c3e50; padding: 12px 24px; }
        nav a { color: #fff; margin-right: 18px; text-decoration: none; }
        nav a:hover { text-decoration: underline; }
        nav .user { color: #fff; float: right; }
        nav .user a { margin: 0 0 0 12px; }
        main  { max-width: 900px; margin: 24px auto; padding: 0 16px; }
        table { width: 100%; border-collapse: collapse; background: #fff; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        th    { background: #ecf0f1; }
    </style>
</head>
<body>
    <nav>
        <a href="<?= base_url('/') ?>">Home</a>
        <a href="<?= base_url('about') ?>">About</a>
        <a href="<?= base_url('customers') ?>">Customers</a>
        <a href="<?= base_url('users') ?>">Users</a>

        <?php if (session()->get('isLoggedIn')): ?>
            <span class="user">
                Hi, <?= esc(session()->get('username')) ?>
                <a href="<?= base_url('logout') ?>">Logout</a>
            </span>
        <?php endif; ?>
    </nav>

    <main>
        <?= $this->renderSection('content') ?>
    </main>
</body>
</html>
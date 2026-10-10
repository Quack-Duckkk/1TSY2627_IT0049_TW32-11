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
        nav .logout-form { display: inline; }
        nav .logout-button {
            background: none;
            border: 0;
            color: #fff;
            cursor: pointer;
            font: inherit;
            margin-left: 12px;
            padding: 0;
            text-decoration: none;
        }
        nav .logout-button:hover { text-decoration: underline; }
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

        <?php if (session()->get('isLoggedIn')): ?>
            <a href="<?= base_url('products') ?>">Products</a>
            <a href="<?= base_url('customers') ?>">Customers</a>
            <a href="<?= base_url('users') ?>">Users</a>
            <a href="<?= base_url('sales/record') ?>">Record Sale</a>
            <a href="<?= base_url('sales') ?>">Sales History</a>

            <span class="user">
                Hi, <?= esc(session()->get('username')) ?>

                <form action="<?= base_url('logout') ?>" method="post" class="logout-form">
                    <?= csrf_field() ?>
                    <button type="submit" class="logout-button">Logout</button>
                </form>
            </span>
        <?php else: ?>
            <span class="user">
                <a href="<?= base_url('login') ?>">Login</a>
            </span>
        <?php endif; ?>
    </nav>

    <main>
        <?= $this->renderSection('content') ?>
    </main>
</body>
</html>
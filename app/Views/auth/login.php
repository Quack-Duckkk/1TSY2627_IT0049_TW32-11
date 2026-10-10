<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<h1>Login</h1>

<?php if (session()->getFlashdata('error')): ?>
    <p style="color: red;"><?= esc(session()->getFlashdata('error')) ?></p>
<?php endif; ?>

<?php if (session()->getFlashdata('message')): ?>
    <p style="color: green;"><?= esc(session()->getFlashdata('message')) ?></p>
<?php endif; ?>

<form action="<?= base_url('login') ?>" method="post">
    <?= csrf_field() ?>

    <div>
        <label for="username">Username</label><br>
        <input type="text" id="username" name="username" value="<?= esc(old('username')) ?>">
        <?= validation_show_error('username') ?>
    </div>

    <div>
        <label for="password">Password</label><br>
        <input type="password" id="password" name="password">
        <?= validation_show_error('password') ?>
    </div>

    <button type="submit">Log in</button>
</form>

<?= $this->endSection() ?>
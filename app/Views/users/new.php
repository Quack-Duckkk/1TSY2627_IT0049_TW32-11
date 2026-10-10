<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<h1>New User</h1>

<form method="post" action="<?= site_url('users') ?>" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <p>
        <label>Username</label><br>
        <input type="text" name="username" value="<?= esc(old('username')) ?>">
        <br><small style="color:red"><?= validation_show_error('username') ?></small>
    </p>

    <p>
        <label>Full name</label><br>
        <input type="text" name="full_name" value="<?= esc(old('full_name')) ?>">
        <br><small style="color:red"><?= validation_show_error('full_name') ?></small>
    </p>

    <p>
        <label>Password</label><br>
        <input type="password" name="password">
        <br><small style="color:red"><?= validation_show_error('password') ?></small>
    </p>

    <p>
        <label>Confirm password</label><br>
        <input type="password" name="password_confirm">
        <br><small style="color:red"><?= validation_show_error('password_confirm') ?></small>
    </p>

    <p>
        <label>Avatar (optional, JPG/PNG/WebP, max 2MB)</label><br>
        <input type="file" name="avatar" accept="image/jpeg,image/png,image/webp">
        <br><small style="color:red"><?= validation_show_error('avatar') ?></small>
    </p>

    <button type="submit">Save User</button>
    <a href="<?= site_url('users') ?>">Cancel</a>
</form>
<?= $this->endSection() ?>
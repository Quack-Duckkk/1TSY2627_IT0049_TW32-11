<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<h1>New User</h1>

<form method="post" action="<?= site_url('users') ?>">
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

    <button type="submit">Save User</button>
    <a href="<?= site_url('users') ?>">Cancel</a>
</form>
<?= $this->endSection() ?>
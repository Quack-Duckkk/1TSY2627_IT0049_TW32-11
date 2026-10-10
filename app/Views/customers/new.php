<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
    <h1>New Customer</h1>

    <form method="post" action="<?= site_url('customers') ?>">
        <?= csrf_field() ?>

        <p>
            <label>Full name</label><br>
            <input type="text" name="full_name" value="<?= esc(old('full_name')) ?>">
            <br><small style="color:red"><?= validation_show_error('full_name') ?></small>
        </p>

        <p>
            <label>Email</label><br>
            <input type="text" name="email" value="<?= esc(old('email')) ?>">
            <br><small style="color:red"><?= validation_show_error('email') ?></small>
        </p>

        <p>
            <label>Phone (optional)</label><br>
            <input type="text" name="phone" value="<?= esc(old('phone')) ?>">
            <br><small style="color:red"><?= validation_show_error('phone') ?></small>
        </p>

        <button type="submit">Save Customer</button>
        <a href="<?= site_url('customers') ?>">Cancel</a>
    </form>
<?= $this->endSection() ?>
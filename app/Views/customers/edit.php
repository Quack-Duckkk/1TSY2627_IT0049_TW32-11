<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
    <h1>Edit Customer</h1>

    <form method="post" action="<?= site_url('customers/' . $customer['id']) ?>">
        <?= csrf_field() ?>

        <p>
            <label>Full name</label><br>
            <input type="text" name="full_name" value="<?= esc(old('full_name', $customer['full_name'])) ?>">
            <br><small style="color:red"><?= validation_show_error('full_name') ?></small>
        </p>

        <p>
            <label>Email</label><br>
            <input type="text" name="email" value="<?= esc(old('email', $customer['email'])) ?>">
            <br><small style="color:red"><?= validation_show_error('email') ?></small>
        </p>

        <p>
            <label>Phone (optional)</label><br>
            <input type="text" name="phone" value="<?= esc(old('phone', $customer['phone'])) ?>">
            <br><small style="color:red"><?= validation_show_error('phone') ?></small>
        </p>

        <button type="submit">Update Customer</button>
        <a href="<?= site_url('customers') ?>">Cancel</a>
    </form>
<?= $this->endSection() ?>
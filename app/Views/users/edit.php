<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
    <h1>Edit User</h1>

    <form method="post" action="<?= site_url('users/' . $user['id']) ?>" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <p>
            <label>Username</label><br>
            <input type="text" name="username" value="<?= esc(old('username', $user['username'])) ?>">
            <br><small style="color:red"><?= validation_show_error('username') ?></small>
        </p>

        <p>
            <label>Full name</label><br>
            <input type="text" name="full_name" value="<?= esc(old('full_name', $user['full_name'])) ?>">
            <br><small style="color:red"><?= validation_show_error('full_name') ?></small>
        </p>

        <p>
            <label>Profile picture (JPG or PNG, max 2MB)</label><br>
            <?php if (! empty($user['avatar'])): ?>
                <img src="<?= esc(base_url('uploads/' . $user['avatar'])) ?>" alt="Current avatar" width="80"><br>
            <?php endif; ?>
            <input type="file" name="avatar">
            <br><small style="color:red"><?= validation_show_error('avatar') ?></small>
        </p>

        <button type="submit">Update User</button>
        <a href="<?= site_url('users') ?>">Cancel</a>
    </form>
<?= $this->endSection() ?>
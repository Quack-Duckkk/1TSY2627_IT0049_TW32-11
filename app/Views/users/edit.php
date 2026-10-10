<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
    <h1>Edit User</h1>

    <form method="post" action="<?= site_url('users/' . $user['id']) ?>" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <p>
            <label for="username">Username</label><br>
            <input type="text" id="username" name="username" value="<?= esc(old('username', $user['username'])) ?>">
            <br><small style="color:red"><?= validation_show_error('username') ?></small>
        </p>

        <p>
            <label for="full_name">Full name</label><br>
            <input type="text" id="full_name" name="full_name" value="<?= esc(old('full_name', $user['full_name'])) ?>">
            <br><small style="color:red"><?= validation_show_error('full_name') ?></small>
        </p>

        <p>
            <label for="password">New password</label><br>
            <input type="password" id="password" name="password">
            <br><small>Leave blank to keep the current password (min 8 characters if changing).</small>
            <br><small style="color:red"><?= validation_show_error('password') ?></small>
        </p>

        <p>
            <label for="password_confirm">Confirm new password</label><br>
            <input type="password" id="password_confirm" name="password_confirm">
            <br><small style="color:red"><?= validation_show_error('password_confirm') ?></small>
        </p>

        <p>
            <label for="avatar">Profile picture (JPG, PNG, or WebP; max 2MB)</label><br>
            <?php if (! empty($user['avatar'])): ?>
                <img src="<?= esc(base_url('uploads/' . $user['avatar'])) ?>" alt="Current avatar" width="80"><br>
            <?php endif; ?>
            <input type="file" id="avatar" name="avatar" accept="image/jpeg,image/png,image/webp">
            <br><small style="color:red"><?= validation_show_error('avatar') ?></small>
        </p>

        <button type="submit">Update User</button>
        <a href="<?= site_url('users') ?>">Cancel</a>
    </form>
<?= $this->endSection() ?>
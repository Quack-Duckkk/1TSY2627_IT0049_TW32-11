<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
    <h1>User Accounts</h1>

    <p><a href="<?= site_url('users/new') ?>">+ Add User</a></p>

    <table>
        <thead>
            <tr><th>Avatar</th><th>Username</th><th>Full Name</th><th>Actions</th></tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <?php
                    $avatarUrl = ! empty($user['avatar'])
                        ? base_url('uploads/' . $user['avatar'])
                        : base_url('images/placeholder.svg');
                ?>
                <tr>
                    <td><img src="<?= esc($avatarUrl) ?>" alt="Avatar" width="50" height="50" style="border-radius:50%; object-fit:cover;"></td>
                    <td><?= esc($user['username']) ?></td>
                    <td><?= esc($user['full_name']) ?></td>
                    <td><a href="<?= site_url('users/' . $user['id'] . '/edit') ?>">Edit</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?= $this->endSection() ?>
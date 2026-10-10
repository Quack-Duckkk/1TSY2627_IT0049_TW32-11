<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
    <h1>User Accounts</h1>

    <?php if (session()->getFlashdata('success')): ?>
        <p style="color: green;"><?= esc(session()->getFlashdata('success')) ?></p>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <p style="color: red;"><?= esc(session()->getFlashdata('error')) ?></p>
    <?php endif; ?>

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
                    <td>
                        <a href="<?= site_url('users/' . $user['id'] . '/edit') ?>">Edit</a>

                        <form action="<?= site_url('users/' . $user['id'] . '/delete') ?>"
                              method="post"
                              style="display:inline;"
                              onsubmit="return confirm('Delete <?= esc($user['username'], 'js') ?>? This can\'t be undone.');">
                            <?= csrf_field() ?>
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?= $this->endSection() ?>
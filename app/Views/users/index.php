<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
    <h1>User Accounts</h1>
    <table>
        <thead>
            <tr><th>Username</th><th>Full Name</th><th>Role</th></tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= esc($user['username']) ?></td>
                    <td><?= esc($user['full_name']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?= $this->endSection() ?>
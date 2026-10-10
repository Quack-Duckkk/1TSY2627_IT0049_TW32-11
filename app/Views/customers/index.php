<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
    <h1>Customer Accounts</h1>

    <p><a href="<?= site_url('customers/new') ?>">+ Add Customer</a></p>

    <table>
        <thead>
            <tr><th>Full Name</th><th>Email</th><th>Phone</th><th>Actions</th></tr>
        </thead>
        <tbody>
            <?php foreach ($customers as $customer): ?>
                <tr>
                    <td><?= esc($customer['full_name']) ?></td>
                    <td><?= esc($customer['email']) ?></td>
                    <td><?= esc($customer['phone']) ?></td>
                    <td><a href="<?= site_url('customers/' . $customer['id'] . '/edit') ?>">Edit</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?= $this->endSection() ?>
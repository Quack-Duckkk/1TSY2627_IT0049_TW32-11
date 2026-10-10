<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
    <h1>Customer Accounts</h1>

    <?php if (session()->getFlashdata('success')): ?>
        <p style="color: green;"><?= esc(session()->getFlashdata('success')) ?></p>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <p style="color: red;"><?= esc(session()->getFlashdata('error')) ?></p>
    <?php endif; ?>

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
                    <td>
                        <a href="<?= site_url('customers/' . $customer['id'] . '/edit') ?>">Edit</a>

                        <form action="<?= site_url('customers/' . $customer['id'] . '/delete') ?>"
                              method="post"
                              style="display:inline;"
                              onsubmit="return confirm('Delete <?= esc($customer['full_name'], 'js') ?>? This can\'t be undone.');">
                            <?= csrf_field() ?>
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?= $this->endSection() ?>
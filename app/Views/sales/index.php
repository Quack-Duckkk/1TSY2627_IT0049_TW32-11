<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
    <h1>Sales History</h1>

    <p><a href="<?= site_url('sales/record') ?>">+ Record Sale</a></p>

    <table>
        <thead>
            <tr><th>Date</th><th>Product</th><th>Customer</th><th>Staff</th><th>Qty</th><th>Total</th></tr>
        </thead>
        <tbody>
            <?php if (empty($sales)): ?>
                <tr><td colspan="6">No sales yet.</td></tr>
            <?php endif; ?>

            <?php foreach ($sales as $sale): ?>
                <tr>
                    <td><?= esc(date('M d, Y h:i A', strtotime($sale['created_at']))) ?></td>
                    <td><?= esc($sale['product_name']) ?></td>
                    <td><?= ! empty($sale['customer_name']) ? esc($sale['customer_name']) : '—' ?></td>
                    <td><?= esc($sale['staff_name']) ?></td>
                    <td><?= esc($sale['quantity']) ?></td>
                    <td>₱<?= number_format((float) $sale['total_price'], 2) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?= $this->endSection() ?>
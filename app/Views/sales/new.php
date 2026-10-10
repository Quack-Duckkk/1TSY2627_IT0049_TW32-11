<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
    <h1>Record Sale</h1>

    <?php if (session()->getFlashdata('success')): ?>
        <p style="color:green"><?= esc(session()->getFlashdata('success')) ?></p>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <p style="color:red"><?= esc(session()->getFlashdata('error')) ?></p>
    <?php endif; ?>

    <form method="post" action="<?= site_url('sales') ?>">
        <?= csrf_field() ?>

        <p>
            <label>Product</label><br>
            <select name="product_id">
                <option value="">-- Select a product --</option>
                <?php foreach ($products as $product): ?>
                    <option value="<?= esc($product['id']) ?>" <?= (string) old('product_id') === (string) $product['id'] ? 'selected' : '' ?>>
                        <?= esc($product['name']) ?> (₱<?= number_format((float) $product['price'], 2) ?>, stock: <?= esc($product['stock_quantity']) ?>)
                    </option>
                <?php endforeach; ?>
            </select>
            <br><small style="color:red"><?= validation_show_error('product_id') ?></small>
        </p>

        <p>
            <label>Customer (optional)</label><br>
            <select name="customer_id">
                <option value="">-- No customer --</option>
                <?php foreach ($customers as $customer): ?>
                    <option value="<?= esc($customer['id']) ?>" <?= (string) old('customer_id') === (string) $customer['id'] ? 'selected' : '' ?>>
                        <?= esc($customer['full_name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br><small style="color:red"><?= validation_show_error('customer_id') ?></small>
        </p>

        <p>
            <label>Quantity</label><br>
            <input type="number" name="quantity" min="1" value="<?= esc(old('quantity', '1')) ?>">
            <br><small style="color:red"><?= validation_show_error('quantity') ?></small>
        </p>

        <button type="submit">Record Sale</button>
    </form>
<?= $this->endSection() ?>
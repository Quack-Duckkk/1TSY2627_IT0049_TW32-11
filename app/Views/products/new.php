<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
    <h1>New Product</h1>

    <form method="post" action="<?= site_url('products') ?>" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <p>
            <label for="name">Name</label><br>
            <input type="text" id="name" name="name" value="<?= esc(old('name')) ?>">
            <br><small style="color:red"><?= validation_show_error('name') ?></small>
        </p>

        <p>
            <label for="price">Price</label><br>
            <input type="number" id="price" name="price" step="0.01" min="0.01" value="<?= esc(old('price')) ?>">
            <br><small style="color:red"><?= validation_show_error('price') ?></small>
        </p>

        <p>
            <label for="stock_quantity">Stock quantity</label><br>
            <input type="number" id="stock_quantity" name="stock_quantity" min="0" step="1" value="<?= esc(old('stock_quantity', '0')) ?>">
            <br><small style="color:red"><?= validation_show_error('stock_quantity') ?></small>
        </p>

        <p>
            <label for="image">Product image (JPG, PNG, or WebP; max 2MB; optional)</label><br>
            <input type="file" id="image" name="image" accept="image/jpeg,image/png,image/webp">
            <br><small style="color:red"><?= validation_show_error('image') ?></small>
        </p>

        <button type="submit">Save Product</button>
        <a href="<?= site_url('products') ?>">Cancel</a>
    </form>
<?= $this->endSection() ?>
<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
    <h1>Edit Product</h1>

    <form method="post" action="<?= site_url('products/' . $product['id']) ?>" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <p>
            <label for="name">Name</label><br>
            <input type="text" id="name" name="name" value="<?= esc(old('name', $product['name'])) ?>">
            <br><small style="color:red"><?= validation_show_error('name') ?></small>
        </p>

        <p>
            <label for="price">Price</label><br>
            <input type="number" id="price" name="price" step="0.01" min="0.01" value="<?= esc(old('price', $product['price'])) ?>">
            <br><small style="color:red"><?= validation_show_error('price') ?></small>
        </p>

        <p>
            <label for="stock_quantity">Stock quantity</label><br>
            <input type="number" id="stock_quantity" name="stock_quantity" min="0" step="1" value="<?= esc(old('stock_quantity', $product['stock_quantity'])) ?>">
            <br><small style="color:red"><?= validation_show_error('stock_quantity') ?></small>
        </p>

        <p>
            <label for="image">Product image (JPG, PNG, or WebP; max 2MB)</label><br>
            <?php if (! empty($product['image'])): ?>
                <img src="<?= esc(base_url('uploads/' . $product['image'])) ?>" alt="Current image" width="80"><br>
            <?php endif; ?>
            <input type="file" id="image" name="image" accept="image/jpeg,image/png,image/webp">
            <br><small style="color:red"><?= validation_show_error('image') ?></small>
        </p>

        <button type="submit">Update Product</button>
        <a href="<?= site_url('products') ?>">Cancel</a>
    </form>
<?= $this->endSection() ?>
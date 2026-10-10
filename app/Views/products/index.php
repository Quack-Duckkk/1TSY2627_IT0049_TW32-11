<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
    <h1>Products</h1>

    <p><a href="<?= site_url('products/new') ?>">+ Add Product</a></p>

    <table>
        <thead>
            <tr><th>Image</th><th>Name</th><th>Price</th><th>Stock</th><th>Status</th><th>Actions</th></tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <?php
                    $imageUrl = ! empty($product['image'])
                        ? base_url('uploads/' . $product['image'])
                        : base_url('images/placeholder.svg');
                    $isActive = (int) $product['is_active'] === 1;
                ?>
                <tr style="<?= $isActive ? '' : 'opacity:0.5;' ?>">
                    <td><img src="<?= esc($imageUrl) ?>" alt="Product image" width="50" height="50" style="object-fit:cover;"></td>
                    <td><?= esc($product['name']) ?></td>
                    <td>₱<?= number_format((float) $product['price'], 2) ?></td>
                    <td><?= esc($product['stock_quantity']) ?></td>
                    <td><?= $isActive ? 'Active' : 'Archived' ?></td>
                    <td>
                        <a href="<?= site_url('products/' . $product['id'] . '/edit') ?>">Edit</a>

                        <?php if ($isActive): ?>
                            <form method="post" action="<?= site_url('products/' . $product['id'] . '/archive') ?>" style="display:inline;" onsubmit="return confirm('Archive this product?');">
                                <?= csrf_field() ?>
                                <button type="submit">Archive</button>
                            </form>
                        <?php else: ?>
                            <form method="post" action="<?= site_url('products/' . $product['id'] . '/restore') ?>" style="display:inline;">
                                <?= csrf_field() ?>
                                <button type="submit">Restore</button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?= $this->endSection() ?>
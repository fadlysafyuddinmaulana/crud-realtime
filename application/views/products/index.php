<!DOCTYPE html>
<html>

<head>
    <title>Products List</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
</head>

<body>
    <div class="container">
        <h2>Products List</h2>
        <a href="<?php echo site_url('products/create'); ?>" class="btn btn-primary">Add New Product</a>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>SKU</th>
                    <th>Price</th>
                    <th>QR Code</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?php echo $product->id; ?></td>
                        <td><?php echo $product->name; ?></td>
                        <td><?php echo $product->sku; ?></td>
                        <td><?php echo $product->price; ?></td>
                        <td>
                            <img src="<?php echo base_url($product->barcode); ?>"
                                alt="QR Code"
                                style="width: 100px; height: 100px;">
                        </td>
                        <td>
                            <a href="<?php echo site_url('products/edit/' . $product->id); ?>"
                                class="btn btn-sm btn-warning">Edit</a>
                            <a href="<?php echo site_url('products/delete/' . $product->id); ?>"
                                class="btn btn-sm btn-danger"
                                onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>
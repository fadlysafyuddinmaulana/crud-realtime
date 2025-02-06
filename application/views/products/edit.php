<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
</head>

<body>
    <div class="container mt-4">
        <h2 class="mb-3">Edit Product</h2>
        <form action="<?php echo site_url('products/update/' . $product->id); ?>" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $product->name; ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control"><?php echo $product->description; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="barcode" class="form-label">Barcode</label>
                <input type="text" name="barcode" class="form-control" value="<?php echo $product->barcode; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="<?php echo site_url('products'); ?>" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>

</html>
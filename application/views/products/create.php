<!DOCTYPE html>
<html>

<head>
    <title>Create Product</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
</head>

<body>
    <div class="container">
        <h2>Create Product</h2>

        <!-- Add form action and debug message -->
        <form method="post" action="<?php echo site_url('products/create'); ?>">
            <!-- Add CSRF protection -->
            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger">
                    <?php echo $this->session->flashdata('error'); ?>
                </div>
            <?php endif; ?>

            <div class="form-group mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="<?= random_string('alpha', 5) ?>" required>
            </div>

            <div class="form-group mb-3">
                <label>SKU</label>
                <input type="text" name="sku" class="form-control" value="<?= random_string('alpha', 5) ?>" required>
            </div>

            <div class="form-group mb-3">
                <label>Price</label>
                <input type="number" name="price" class="form-control" step="0.01" value="<?= random_string('numeric', 5) ?>"">
            </div>

            <button type=" submit" class="btn btn-primary">Save</button>
                <a href="<?php echo site_url('products'); ?>" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>

</html>
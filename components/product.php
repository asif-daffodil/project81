<?php 
    require_once './classes/Product.php';
    use classes\Product\Product as Product;
    
    if (isset($_POST['addProduct'])) {
        $name = $_POST['name'];
        $regular_price = $_POST['regular_price'];
        $sale_price = $_POST['sale_price'];
        $image = $_FILES['image'];
        $description = $_POST['description'];
        $product = new Product();
        $product->addProduct($name, $regular_price, $sale_price, $image, $description);
    }
?>
<div class="row">
    <div class="col-md-6 p-4">
        <div class="card">
            <div class="card-header">
                <h4>Add Product</h4>
            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group mb-3">
                        <label for="name">Product Name</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="price">Regular Price</label>
                        <input type="number" name="regular_price" id="price" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="sale_price">Sale Price</label>
                        <input type="number" name="sale_price" id="sale_price" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="image">Product Image</label>
                        <input type="file" name="image" id="image" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="description">Product Description</label>
                        <textarea name="description" id="description" class="form-control" required></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <button type="submit" class="btn btn-primary" name="addProduct">Add Product</button>
                    </div>
        </div>
    </div>
    <div class="col-md-6"></div>
</div>
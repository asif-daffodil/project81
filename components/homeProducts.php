<?php
require_once './classes/Product.php';
$product = new classes\Product\Product();
$products = $product->latestProducts();
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            Latest Products
        </div>
        <?php
        if ($products) {
            while ($row = $products->fetch_assoc()) {
        ?>
                <div class="col-md-2">
                    <div class="card">
                        <img src="uploads/<?php echo $row['image'] ?>" class="card-img-top w-100 object-fit-cover" style="height: 200px;" alt="<?php echo $row['name'] ?>">
                        <div class="card-body">
                            <h5 class="card-title text-truncate"><?php echo $row['name'] ?></h5>
                            <p class="card-text">Price: <span class="text-muted text-decoration-line-through "><?= $row['regular_price'] ?></span> <?php echo $row['sale_price'] ?></p>
                            <div class="w-100 d-flex justify-content-between mb-3">
                                <a href="product?id=<?php echo $row['id'] ?>" class="btn btn-primary">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <button class="addToCart btn btn-success" data-id="<?= $row['id'] ?>" >
                                    <i class="fas fa-cart-plus"></i>
                                </button>
                                <button class="wishlist btn btn-warning">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                            <button class="btn btn-lg btn-danger w-100">
                                Buy Now
                            </button>
                        </div>
                    </div>
                </div>
        <?php
            }
        } else {
            echo "<div class='col-md-12'><div class='alert alert-danger'>No products found</div></div>";
        }
        ?>
                            
    </div>
</div>
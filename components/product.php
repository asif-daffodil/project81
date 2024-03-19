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

if (isset($_POST['updateImage'])) {
    $id = $_GET['eid'];
    $image = $_FILES['image'];
    $product = new Product();
    $product = $product->getProduct($id)->fetch_assoc();
    $target_dir = "uploads/";
    $imageName =  time() . "_" . basename($image["name"]);
    $target_file = $target_dir . $imageName;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($image["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check file size
    if ($image["size"] > 500000) {
        echo "<script>alert('Sorry, your file is too large.');</script>";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');</script>";
        $uploadOk = 0;
    }


    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "<script>alert('Sorry, your file was not uploaded.');</script>";
        // if everything is ok, try to upload file
    } else {
        if (!move_uploaded_file($image["tmp_name"], $target_file)) {
            echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
        }
    }

    // delete old image
    $oldImage = $product['image'];
    unlink("uploads/" . $oldImage);

    $product = new Product();
    $product->updateImage($id, $imageName);
}


if (isset($_POST['updateProduct'])) {
    $id = $_GET['eid'];
    $name = $_POST['name'];
    $regular_price = $_POST['regular_price'];
    $sale_price = $_POST['sale_price'];
    $description = $_POST['description'];
    $product = new Product();
    $product->updateProduct($id, $name, $regular_price, $sale_price, $description);
}

?>

<style>
    .changeProImg {
        background: rgba(0, 0, 0, 0.5);
        display: none;
        width: 100%;
    }

    form:hover .changeProImg {
        display: flex !important;
    }

    .toast-success{
        background-color: #28a745;
    }
</style>

<?php
if (!isset($_GET['eid']) && !isset($_GET['did'])) {
?>
    <div class="row">
        <div class="col-md-5 p-4">
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
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-7 p-4">
            <div class="card">
                <div class="card-header">
                    <h4>Product List</h4>
                </div>
                <div class="card-body">
                    <table class="" id="myTable">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Image</th>
                                <th>Sale Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $product = new Product();
                            $products = $product->getProducts();
                            foreach ($products as $product) {
                            ?>
                                <tr>
                                    <td><?php echo $product['name']; ?></td>
                                    <td><img src="uploads/<?php echo $product['image']; ?>" alt="" width="40" height="40" style="object-fit: cover;"></td>
                                    <td><?php echo $product['sale_price']; ?></td>
                                    <td>
                                        <a href="admin?action=products&eid=<?php echo $product['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                                        <a href="admin?action=products&did=<?php echo $product['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php
if (isset($_GET['eid'])) {
    $id = $_GET['eid'];
    $product = new Product();
    $product = $product->getProduct($id)->fetch_assoc();
?>
    <div class="row">
        <div class="col-md-7 p-4">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Product</h4>
                </div>
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group mb-3">
                            <label for="name">Product Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="<?php echo $product['name']; ?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="price">Regular Price</label>
                            <input type="number" name="regular_price" id="price" class="form-control" value="<?php echo $product['regular_price']; ?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="sale_price">Sale Price</label>
                            <input type="number" name="sale_price" id="sale_price" class="form-control" value="<?php echo $product['sale_price']; ?>">
                        </div>
                        <div class="form-group mb-3">
                            <label for="description">Product Description</label>
                            <textarea name="description" id="description" class="form-control" required><?php echo $product['description']; ?></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary" name="updateProduct">Update Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-5 p-4">
            <div class="card">
                <div class="card-header">
                    <h4>Product Image</h4>
                </div>
                <div class="card-body position-relative">
                    <img src="uploads/<?php echo $product['image']; ?>" alt="" width="100%" height="auto" style="object-fit: cover;">
                    <form action="" method="post" enctype="multipart/form-data" class="position-absolute w-100 h-100 top-0 start-0">
                        <div class="d-none flex-column align-items-center justify-content-evenly changeProImg h-100">
                            <label for="image" class="fs-1 text-white">Change Image</label>
                            <input type="file" name="image" id="image" class="form-control" required style="width: 80%">
                            <button type="submit" class="btn btn-primary" name="updateImage">Update Image</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php } ?>

<?php if (isset($_GET['did'])) {
    $id = $_GET['did'];
    $product = new Product();
    $product = $product->getProduct($id)->fetch_assoc();
    unlink("uploads/" . $product['image']);
    $product = new Product();
    $product->deleteProduct($id);
} ?>

<script>
    let table = new DataTable('#myTable');
</script>
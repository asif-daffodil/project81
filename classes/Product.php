<?php

namespace classes\Product;

require_once './classes/Db.php';

use classes\Db\Db as Db;

class Product extends Db
{
    //  add product with image upload
    public function addProduct($name, $regular_price, $sale_price, $image, $description)
    {
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
        $sql = "INSERT INTO products (`name`, `regular_price`, `sale_price`, `image`, `description`) VALUES ('$name', '$regular_price', '$sale_price', '$imageName', '$description')";
        if ($this->conn->query($sql) === TRUE) {
            echo "<script>toastr['success']('New record created successfully')</script>";
        } else {
            echo "<script>alert('Error: " . $sql . "\\n" . $this->conn->error . "');</script>";
        }
    }

    // get all products
    public function getProducts()
    {
        $sql = "SELECT * FROM products";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function latestProducts()
    {
        $sql = "SELECT * FROM products ORDER BY id DESC LIMIT 6";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return 0;
        }
    }

    // get single product
    public function getProduct($id)
    {
        $sql = "SELECT * FROM products WHERE id = $id";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return 0;
        }
    }

    // update product image
    public function updateImage($id, $image)
    {
        $sql = "UPDATE products SET image = '$image' WHERE id = $id";
        if ($this->conn->query($sql) === TRUE) {
            echo "<script>toastr['success']('Image updated successfully')</script>";
        } else {
            echo "<script>alert('Error: " . $sql . "\\n" . $this->conn->error . "');</script>";
        }
    }

    // update product
    public function updateProduct($id, $name, $regular_price, $sale_price, $description)
    {
        $sql = "UPDATE products SET name = '$name', regular_price = '$regular_price', sale_price = '$sale_price', description = '$description' WHERE id = $id";
        if ($this->conn->query($sql) === TRUE) {
            echo "<script>toastr['success']('Product updated successfully');setTimeout(()=>location.href='admin?action=products', 2000)</script>";
        } else {
            echo "<script>alert('Error: " . $sql . "\\n" . $this->conn->error . "');</script>";
        }
    }

    // delete product
    public function deleteProduct($id)
    {
        $sql = "DELETE FROM products WHERE id = $id";
        if ($this->conn->query($sql) === TRUE) {
            echo "<script>toastr['success']('Product deleted successfully');setTimeout(()=>location.href='admin?action=products', 2000)</script>";
        } else {
            echo "<script>alert('Error: " . $sql . "\\n" . $this->conn->error . "');</script>";
        }
    }
}

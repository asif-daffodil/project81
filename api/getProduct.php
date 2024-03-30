<?php 
    namespace api\getProduct;

    require_once '../classes/Db.php';
    use classes\Db\Db as Db;

    class getProduct extends Db {
        public function getProduct($id) {
            $sql = "SELECT * FROM products WHERE id = $id";
            $result = $this->conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo json_encode($row);
            } else {
                echo "0 results";
            }
        }
    }

    $getProduct = new getProduct();

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $getProduct->getProduct($id);
    }
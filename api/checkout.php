<?php
    namespace api\checkout;
    require_once '../classes/Db.php';
    use classes\Db\Db as Db;

    class checkout extends Db {
        public function checkout($user_id, $product_id, $quantity, $total, $receiver_name, $receiver_phone, $receiver_address) {
            $sql = "INSERT INTO orders 
            (`user_id`, `product_id`, `quantity`, `total`, `receiver_name`, `receiver_phone`, `receiver_address`, `status`) VALUES ($user_id, $product_id, $quantity, $total, '$receiver_name', '$receiver_phone', '$receiver_address', 'Ordered')";
            if ($this->conn->query($sql) === TRUE) {
                echo 1;
            } else {
                echo $user_id, $product_id, $quantity, $total, $receiver_name, $receiver_phone, $receiver_address;
                echo "Error: " . $sql . "<br>" . $this->conn->error;
            }
        }
    }

    $checkout = new checkout();

    if (isset($_POST['user_id'])) {
        $user_id = $_POST['user_id'];
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];
        $total = $_POST['total'];
        $receiver_name = $_POST['receiver_name'];
        $receiver_phone = $_POST['receiver_phone'];
        $receiver_address = $_POST['receiver_address'];
        $checkout->checkout($user_id, $product_id, $quantity, $total, $receiver_name, $receiver_phone, $receiver_address);
    }


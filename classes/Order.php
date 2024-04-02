<?php
    require_once './Db.php';
    use classes\Db\Db as Db;
    $conn = new Db();
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
        $status = $_POST['status'];
        $sql = "UPDATE orders SET status = '$status' WHERE id = '$id'";
        if ($conn->conn->query($sql) === TRUE) {
            echo 1;
        } else {
            echo 0;
        }
    }
?>
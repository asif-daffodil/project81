<?php
require_once './classes/Db.php';
use classes\Db\Db as Db;
$db = new Db();
$sql = "SELECT * FROM orders";
$result_orders = $db->conn->query($sql); // Renamed variable to $result_orders
if ($result_orders->num_rows > 0) {
?>
<table id="orderTable" class="table">
    <thead>
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Receiver Name</th>
            <th>Receiver Phone</th>
            <th>Receiver Address</th>
            <th>Status</th>
            <th>Reg Date</th>
        </tr>
    </thead>
    <tbody>
<?php
    while($row = $result_orders->fetch_assoc()) { // Loop through $result_orders
        $user_id = $row['user_id'];
        $product_id = $row['product_id'];
        $quantity = $row['quantity'];
        $total = $row['total'];
        $receiver_name = $row['receiver_name'];
        $receiver_phone = $row['receiver_phone'];
        $receiver_address = $row['receiver_address'];
        $status = $row['status'];
        $reg_date = $row['reg_date'];
        $sql_user = "SELECT * FROM users WHERE id = $user_id"; // Changed variable name to $sql_user
        $result_user = $db->conn->query($sql_user); // Changed variable name to $result_user
        $user = $result_user->fetch_assoc(); // Changed variable name to $user
        $sql_product = "SELECT * FROM products WHERE id = $product_id"; // Changed variable name to $sql_product
        $result_product = $db->conn->query($sql_product); // Changed variable name to $result_product
        $product = $result_product->fetch_assoc(); // Changed variable name to $product
        ?>
        <tr>
            <td><?= $product['name'] ?></td>
            <td><?= $product['sale_price'] ?></td>
            <td><?= $quantity ?></td>
            <td><?= $total ?></td>
            <td><?= $receiver_name ?></td>
            <td><?= $receiver_phone ?></td>
            <td><?= $receiver_address ?></td>
            <td><?= $status ?></td>
            <td><?= $reg_date ?></td>
        </tr>
        <?php
    }
?>
</tbody>
</table>
<?php }else {
    echo "0 results";
}
?>

<script>
    let table = new DataTable('#orderTable');
</script>

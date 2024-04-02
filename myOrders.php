<?php
// Include the header file
include 'header.php';

// include db
require_once './classes/Db.php';

use classes\Db\Db as Db;

// Create a new Db object
$db = new Db();

//  get user id
$user_id = $auth->user()['id'];

// select all orders for the user
$sql = "SELECT * FROM orders WHERE user_id = $user_id ORDER BY id DESC";

// Execute the query
$result_orders = $db->conn->query($sql);
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">My Orders</h1>
        </div>
        <div class="col-md-12">
            <?php
            // Check if there are any orders
            if ($result_orders->num_rows > 0) {
            ?>
                <table id="userOrderTable" class="table">
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
                        // Loop through the orders
                        while ($row = $result_orders->fetch_assoc()) {
                            $user_id = $row['user_id'];
                            $product_id = $row['product_id'];
                            $quantity = $row['quantity'];
                            $total = $row['total'];
                            $receiver_name = $row['receiver_name'];
                            $receiver_phone = $row['receiver_phone'];
                            $receiver_address = $row['receiver_address'];
                            $status = $row['status'];
                            $reg_date = $row['reg_date'];
                            $sql_user = "SELECT * FROM users WHERE id = $user_id";
                            $result_user = $db->conn->query($sql_user);
                            $user = $result_user->fetch_assoc();
                            $sql_product = "SELECT * FROM products WHERE id = $product_id";
                            $result_product = $db->conn->query($sql_product);
                            $product = $result_product->fetch_assoc();
                        ?>
                            <tr>
                                <td><?= $product['name'] ?></td>
                                <td><?= $product['sale_price'] ?></td>
                                <td><?= $quantity ?></td>
                                <td><?= $total ?></td>
                                <td><?= $receiver_name ?></td>
                                <td><?= $receiver_phone ?></td>
                                <td><?= $receiver_address ?></td>
                                <td>
                                    <button class="btn <?= $status == 'pending' ? 'btn-warning' : ($status == 'processing' ? 'btn-info' : ($status == 'completed' ? 'btn-success' : ($status == 'Ordered' ? 'btn-dark' : 'btn-danger'))) ?> btn-sm rounded-pill changeStatus" data-id="<?= $row['id'] ?>"><?= $status ?></button>
                                </td>
                                <td><?= $reg_date ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            <?php
            } else {
                echo "0 results";
            }
            ?>
        </div>
    </div>
</div>

<script>
    let userOrderTable = new DataTable('#userOrderTable', {
        searchable: true,
        sortable: true,
        perPageSelect: true
    });
</script>

<?php
// Include the footer file
include 'footer.php';
?>
<?php
require_once './classes/Db.php';
use classes\Db\Db as Db;
$db = new Db();
$sql = "SELECT * FROM orders ORDER BY id DESC";
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
    if($result_orders->num_rows > 0) { 
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
                <td>
                    <button class="btn <?= $status == 'pending' ? 'btn-warning' : ($status == 'processing' ? 'btn-info' : ($status == 'completed' ? 'btn-success' : ($status == 'Ordered' ? 'btn-dark':'btn-danger'))) ?> btn-sm rounded-pill changeStatus" data-id="<?= $row['id'] ?>" ><?= $status ?></button>
                </td>
                <td><?= $reg_date ?></td>
            </tr>
            <?php
        }
    }else{
        echo "0 results";
    }
?>
</tbody>
</table>
<?php }else {
    echo "0 results";
}
?>

<!-- modal -->
<div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statusModalLabel">Change Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="changeStatusForm">
                    <input type="hidden" name="id" id="id">
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" name="status" id="status">
                            <option value="pending">Pending</option>
                            <option value="processing">Processing</option>
                            <option value="completed">Completed</option>
                            <option value="returned">Returned</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(".changeStatus").click(function(){
        let id = $(this).data('id');
        $("#id").val(id);
        $("#statusModal").modal('show');
    });

    $("#changeStatusForm").submit(function(e){
        e.preventDefault();
        let id = $("#id").val();
        let status = $("#status").val();
        $.ajax({
            url: './classes/Order.php',
            type: 'POST',
            data: {
                id: id,
                status: status
            },
            success: function(response){
                if(response == 1){
                    toastr['success']('Status changed successfully');
                    setTimeout(()=>location.reload(), 2000);
                }else{
                    toastr['error']('Failed to change status');
                }
            }
        });
    });
</script>

<script>
    let table = new DataTable('#orderTable');
</script>

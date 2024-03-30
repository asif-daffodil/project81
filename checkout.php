<?php
require_once "./header.php";
require_once './classes/Session.php';

use classes\Session\Session as Session;

$session = new Session();
$user_id = $session->get('user')['id'];
// orders:  id, user_id, product_id, quantity, total, receiver_name, receiver_phone, receiver_address, status, reg_date	
// products: id, name, regular_price, sale_price, image, description, reg_date
// users:  id, name, email, password, image, phone, address, role, reg_date
?>
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center my-5">Checkout</h1>
        </div>
        <div class="col-md-6">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot></tfoot>
            </table>
        </div>
        <div class="col-md-6">
            <form action="./api/checkout.php" method="POST" id="checkoutForm">
                <input type="hidden" name="user_id" id="user_id" value="<?= $user_id ?>">
                <div class="mb-3">
                    <label for="receiver_name" class="form-label
                    ">Receiver Name</label>
                    <input type="text" class="form-control" id="receiver_name" name="receiver_name" required>
                </div>
                <div class="mb-3">
                    <label for="receiver_phone" class="form-label">Receiver Phone</label>
                    <input type="text" class="form-control" id="receiver_phone" name="receiver_phone" required>
                </div>
                <div class="mb-3">
                    <label for="receiver_address" class="form-label">Receiver Address</label>
                    <textarea class="form-control" id="receiver_address" name="receiver_address" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Checkout</button>
            </form>
        </div>
    </div>
</div>

<script>
    const getProductsFromCart = () => {
        const cart = Cookies.get('cart');
        const cartItems = JSON.parse(cart);
        let total = 0;
        Object.entries(cartItems).forEach(([key, value]) => {
            $.ajax({
                url: './api/getProduct.php',
                type: 'POST',
                data: {
                    id: key
                },
                success: function(response) {
                    const product = JSON.parse(response);
                    $('tbody').append(`
                        <tr>
                            <td>${product.name}</td>
                            <td>${product.sale_price}</td>
                            <td>${value}</td>
                            <td>${product.sale_price * value}</td>
                        </tr>
                    `);
                    total += product.sale_price * value;
                    $('tfoot').html(`
                        <tr>
                            <td colspan="3">Total</td>
                            <td>${total}</td>
                        </tr>
                    `);
                }
            });
        });

    }

    getProductsFromCart();

    $("#checkoutForm").on('submit', (e) => {
        e.preventDefault();
        const cart2 = Cookies.get('cart');
        const cartItems2 = JSON.parse(cart2);
        const receiver_name = $('#receiver_name').val();
        const receiver_phone = $('#receiver_phone').val();
        const receiver_address = $('#receiver_address').val();
        const user_id = $('#user_id').val();
        let total = 0;
        Object.entries(cartItems2).forEach(([key, value]) => {
            // get tptal price
            $.ajax({
                url: './api/getProduct.php',
                type: 'POST',
                data: {
                    id: key
                },
                success: function(response) {
                    const product = JSON.parse(response);
                    total += product.sale_price * value;
                    $.ajax({
                url: './api/checkout.php',
                type: 'POST',
                data: {
                    user_id: user_id,
                    product_id: key,
                    quantity: value,
                    total: total,
                    receiver_name: receiver_name,
                    receiver_phone: receiver_phone,
                    receiver_address: receiver_address
                },
                success: function(response) {
                    if (response == 1) {
                        toastr.success('Order Placed Successfully');
                        Cookies.remove('cart');
                        setTimeout(() => {
                            window.location.href = './';
                        }, 3000);
                    } else {
                        toastr.error(response);
                    }
                }
            });
                }
            });
        });
    })
</script>

<?php
require_once './footer.php';
?>
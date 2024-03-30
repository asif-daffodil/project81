<?php  
    require_once "header.php";
    require_once "./classes/Product.php";

    use classes\Product\Product as Product;
    $product = new Product();
    $products = $product->getProducts();
?>


<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center my-5">Cart</h1>
            <table class="table table-bordered" id="cartTable">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="cart">
                    
                </tbody>
            </table>
            <div class="text-end">
                <a class="btn btn-primary" href="./checkout.php">Checkout</a>
            </div>
        </div>
    </div>
</div>
<script>
    const getProductsFromCart = () => {
        const cart = Cookies.get('cart');
        const cartItems = JSON.parse(cart);
        console.log(cartItems);
        Object.entries(cartItems).forEach(([key, value]) => {
            $.ajax({
                url: './api/getProduct.php',
                type: 'POST',
                data: {
                    id: key
                },
                success: function(response){
                    const product = JSON.parse(response);
                    console.log(product);
                    $('#cart').append(`
                        <tr>
                            <td>${product.name}</td>
                            <td>${product.sale_price}</td>
                            <td>${value}</td>
                            <td>${product.sale_price * value}</td>
                            <td>
                                <button class="btn btn-danger remove-product" data-id=${product.id}>Remove</button>
                            </td>
                        </tr>
                    `);
                }
            })
        })
    }
    getProductsFromCart();

</script>
<script>
    $('document').ready(()=>{
        let carttable = new DataTable('#cartTable');
        $('.remove-product').on('click', function(){
            const id = $(this).data('id');
            let cart = JSON.parse(Cookies.get('cart'));
            delete cart[id];
            Cookies.set('cart', JSON.stringify(cart));
            $(this).closest('tr').remove();
            $('#shortCart').text(Object.keys(cart).length);
        })
    })
</script>
<?php
    require_once "footer.php";
?>
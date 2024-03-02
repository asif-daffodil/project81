<?php
    require_once './header.php';
    $auth->user()['role'] != 'admin' ? header('Location: ./') : null;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 text-bg-dark side-bar p-4">
            <div class="list-group ">
                <a href="./admin" class="list-group-item text-bg-dark border-0 border-bottom">Dashboard</a>
                <a href="./admin?action=users" class="list-group-item text-bg-dark border-0 border-bottom">Users</a>
                <a href="./admin?action=products" class="list-group-item text-bg-dark border-0 border-bottom">Products</a>
                <a href="./admin?action=orders" class="list-group-item text-bg-dark border-0">Orders</a>
            </div>
        </div>
        <div class="col-md-10"></div>
    </div>
</div>

<div class="d-none">
<?php
    require_once './footer.php';
?>
</div>
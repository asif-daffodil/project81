<?php
    require_once './header.php';
    $auth->user()['role'] != 'admin' ? header('Location: ./') : null;
?>
<div class="container-fluid">
    <div class="row">
        <?php
            require_once './components/adminSidebar.php';
        ?>
        <div class="col-md-10">
            <?php 
            if(isset($_GET['action']) && $_GET['action'] == 'products'){
                require_once './components/product.php';
            } 
            ?>
        </div>
    </div>
</div>

<div class="d-none">
<?php
    require_once './footer.php';
?>
</div>
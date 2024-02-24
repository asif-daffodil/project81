<?php
    require_once "header.php";
    $action = $_GET['action'] ?? header("Location: ./account?action=login");


    if (isset($_POST['createAccount'])) {
        $name = $auth->clean($_POST['name']);
        $email = $auth->clean($_POST['email']);
        $password = $auth->clean($_POST['password']);

        $validation = $auth->validation($name, $email, $password);
        if ($validation) {
            $signup = $auth->signup($name, $email, $password);
            if ($signup) {
                // bottstrap alert dismissable message
                $msg = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> Account created successfully.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                echo "<script>setTimeout(()=>location.href='./account?action=login',2000)</script>";
            }else{
                $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> Account not created.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            
            }
        }
    }

    if (isset($_POST['login'])) {
        $email = $auth->clean($_POST['email']);
        $password = $auth->clean($_POST['password']);

        $validation = $auth->loginValidate($email, $password);
        if ($validation) {
            $login = $auth->login($email, $password);
            if ($login) {
                $msg = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> USER Sign in successfully.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                echo "<script>setTimeout(()=>location.href='./',2000)</script>";
            }else{
                $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> Invalid email or password.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
        }
    }
?>
    <div class="container">
        <div class="row my-5 py-5">
            <?php 
            if($action == "login") {
                require_once "./components/login.php";
            } else if($action == "signup") {
                require_once "./components/signup.php";
            }
            echo '<div class="mb-3"></div>';
            echo $msg ?? null;
            ?>
        </div>
    </div>
<?php
    require_once "footer.php";
?>


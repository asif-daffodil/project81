<?php
    require_once "header.php";
?>
    <div class="container">
        <div class="row my-5 py-5">
            <div class="col-12">
                <h1>Profile</h1>
            </div>
            <div class="col-md-4">
                <div class="d-flex flex-column align-items-center" style="width: max-content">
                    <img src="./assets/images/demo-avatar.png" alt="" class="img-fluid" style="max-width: 300px">
                    <small>Full Name</small>
                </div>
            </div>
            <div class="col-md-8">
                <table class="table">
                    <tr>
                        <th>Email</th>
                        <td>demo@gmail.com</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>01700000000</td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>Dhaka, Bangladesh</td>
                    </tr>
                </table>
                <a href="" class="btn btn-primary btn-sm">Update Profile</a>
            </div>
        </div>
    </div>

<?php
    require_once "footer.php";
?>


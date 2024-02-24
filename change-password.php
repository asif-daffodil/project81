<?php
    require_once "header.php";
?>

<div class="container">
    <div class="row my-5 py-5">
        <div class="col-md-6 mx-auto">
        <h1 class="mb-4">Change Password</h1>
            <form action="" method="post">
                <div class="form-group mb-3">
                    <label for="currentPassword">Current Password</label>
                    <input type="password" class="form-control" id="currentPassword" name="currentPassword" required>
                </div>
                <div class="form-group mb-3">
                    <label for="newPassword">New Password</label>
                    <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                </div>
                <div class="form-group mb-3">
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Change Password</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
    require_once "footer.php";
?>
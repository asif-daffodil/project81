<div class="col-md-6">
    <h2>Login</h2>
    <form action="" method="post">
        <div class="mb-3">
            <input type="email" class="form-control <?= isset($auth->errEmail) ? 'is-invalid':null ?>" placeholder="Your Email" name="email">
            <div class="invalid-feedback">
                <?= $auth->errEmail ?? null ?>
            </div>
        </div>
        <div class="mb-3">
            <input type="password" class="form-control <?= isset($auth->errPassword) ? 'is-invalid':null ?>" placeholder="Your Password" name="password">
            <div class="invalid-feedback">
                <?= $auth->errPassword ?? null ?>
            </div>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary" name="login">Login</button>
        </div>
    </form>
    <p class="small">
        Don't have an account? <a href="./account?action=signup" class="text-decoration-none">Create Account</a>
    </p>
</div>
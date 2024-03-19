<?php
    require_once "./classes/Get_Route.php";
    use classes\Get_Route as Get_Route;
    $route = new Get_Route\Get_Route();

    if(isset($_POST['logout'])){
        $auth->logout();
    }
?>
<nav class="navbar navbar-expand-lg bg-dark navbar-dark sticky-top">
  <div class="container">
    <a class="navbar-brand" href="./">E-Commerce</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link <?= $route->isActive("index") ?>" aria-current="page" href="./">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= $route->isActive("about") ?>" href="./about">
            About
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= $route->isActive("contact") ?>" href="./contact">Contact</a>
        </li>
        <?php if(!$auth->isLogged()){ ?>
        <li class="nav-item">
          <a class="nav-link <?= $route->isActive("account") ?>" href="./account" >
            Sign-in / Sign-up
          </a>
        </li>
        <?php } ?>
        <li class="nav-item">
          <a href="" class="nav-link" >
            <i class="fas fa-shopping-cart"></i>
            <span class="badge bg-primary" id="shortCart" >0</span>
          </a>
        </li>
        <?php if($auth->isLogged()){ ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?php if($auth->user()['image'] == null){ ?>
              <i class="fa-solid fa-user"></i>
            <?php }else{ ?>
              <img src="./assets/images/users/<?= $auth->user()['image'] ?>" alt="" style="height: 16px">
            <?php } ?>
            <?= explode(" ", $auth->user()['name'])[0] ?>
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="./profile">Update Profile</a></li>
            <li><a class="dropdown-item" href="./change-password">Change Password</a></li>
            <?php if($auth->user()['role'] === 'admin'){ ?>
              <li><a class="dropdown-item" href="./admin">Admin</a></li>
            <?php } ?>
            <li><hr class="dropdown-divider"></li>
            <li>
              <form action="" method="post">
                <button class="dropdown-item" name="logout">Logout</button>
              </form>
            </li>
          </ul>
        </li>
        <?php } ?>
      </ul>
      <form class="d-flex" role="search">
        <div class="input-group ">
            <input class="form-control border border-success" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-light btn-outline-success btn-sm input-group-text border-start-0 " type="submit">
                <fa class="fas fa-search"></fa>
            </button>
        </div>
      </form>
    </div>
  </div>
</nav>
<?php
    require_once "header.php";
    require_once './classes/User.php';

    use classes\User\User as User;

    if(isset($_POST['uploadImage'])){
        $user = new User;
        if($user->imgValidate($_FILES['img'])){
            if($user->uploadImg($_FILES['img'])){
                if($user->updateImg($auth->user()['id'])){
                    // header('Location: profile.php');
                }
            }
        }else{
            echo "<script>alert('". $user->imgErrMsg ."')</script>";
        }
    }

    if(isset($_POST['updateProfile'])){
        $user = new User;
        $name = $auth->clean($_POST['name']);
        $email = $auth->clean($_POST['email']);
        $phone = $auth->clean($_POST['phone']);
        $address = $auth->clean($_POST['address']);
        $id = $auth->clean($_POST['id']);
        if($user->updateProfile($name, $email, $phone, $address, $id)){
            $msg = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> Profile updated successfully.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            echo "<script>setTimeout(()=>location.href='./profile',2000)</script>";
        }else{
            $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> Profile not updated.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
    }
?>
    <div class="container">
        <div class="row my-5 py-5">
            <div class="col-12">
                <h1>Profile</h1>
            </div>
            <div class="col-md-4">
                <div class="d-flex flex-column align-items-center" style="width: max-content">
                    <?php
                        if($auth->user()['image'] != null){
                            $proImg = $auth->user()['image'];
                        }else{
                            $proImg = "demo-avatar.png";
                        }
                    ?>
                    <form action="" method="post" id="uploadImageForm" class="text-center" enctype="multipart/form-data">
                        <label for="upProImg" class="d-flex flex-column align-items-center">
                            <figure>
                                <img src="./uploads/<?= $proImg ?>" alt="" class="img-fluid figure-img img-thumbnail mb-3" style="max-width: 300px" id="profileImage">
                                <figcaption class="figure-caption" id="uploadImgName">
                                    <?= $auth->user()['name'] ?><br>
                                    <small class="fs-5 fw-bolder w-100" id="uploadImgText">Click To Upload Image</small>
                                </figcaption>
                            </figure>
                        </label>
                        <input type="file" class="d-none" id="upProImg" name="img">
                        <button type="submit" class="btn btn-primary btn-sm mx-auto d-none" id="uploadImgBtn" name="uploadImage">Upload Image</button>
                    </form>
                </div>
            </div>
            <div class="col-md-8">
                <?php if(!isset($_GET['update'])){ ?>
                <table class="table">
                    <tr>
                        <th>Email</th>
                        <td><?= $auth->user()['email'] ?></td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td><?= $auth->user()['phone'] ?? null ?></td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td><?= $auth->user()['address'] ?? null ?></td>
                    </tr>
                </table>
                <a href="./profile?update=1" class="btn btn-primary btn-sm">Update Profile</a>
                <?php }else{ ?>
                <form action="" method="post" >
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= $auth->user()['name'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control disabled" id="email" name="email" value="<?= $auth->user()['email'] ?>" disabled >
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="<?= $auth->user()['phone'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="<?= $auth->user()['address'] ?>">
                    </div>
                    <input type="hidden" name="id" value="<?= $auth->user()['id'] ?>">
                    <button type="submit" class="btn btn-primary btn-sm" name="updateProfile">Update Profile</button>
                    <a href="./profile" class="btn btn-danger btn-sm">Cancel</a>
                <?php } ?>
                <div class="mb-3"></div>
                <?= $msg ?? null ?>
            </div>

        </div>
    </div>
    <script>
        const uploadImageForm =document.getElementById('uploadImageForm');
        const profileImage =document.getElementById('profileImage');
        const upProImg =document.getElementById('upProImg');
        const uploadImgText = document.getElementById('uploadImgText');
        const uploadImgName = document.getElementById('uploadImgName');
        const uploadImgBtn = document.getElementById('uploadImgBtn');

        upProImg.addEventListener('change', (e)=>{
            const file = e.target.files[0];
            const reader = new FileReader();
            reader.onload = function(){
                profileImage.src = reader.result;
            }
            reader.readAsDataURL(file);
            uploadImgText.classList.add('d-none');
            uploadImgName.classList.add('d-none');
            uploadImgBtn.classList.remove('d-none');
        });
        
    
    </script>
<?php
    require_once "footer.php";
?>


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


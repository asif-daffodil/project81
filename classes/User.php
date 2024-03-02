<?php
    namespace classes\User;
    
    require_once 'Db.php';
    require_once 'Session.php';

    use classes\Db\Db as Db;
    use classes\Clean\Clean as Clean;
    use classes\Session\Session as Session;
    
    class User {
        public $imgErrMsg, $db, $session, $imgName;
        public function __construct() {
            $this->db = new Db();
            $this->session = new Session();
        }

        public function imgValidate ($file)
        {
            $imgName = $file['name'];
            $imgSize = $file['size'];
            $imgExt = strtolower(pathinfo($imgName, PATHINFO_EXTENSION));
            $allowed = array('jpg', 'jpeg', 'png');
            if (!in_array($imgExt, $allowed))
            {
                $this->imgErrMsg = "Invalid file type. Only jpg, jpeg and png are allowed";
            }elseif($imgSize > 10000000)
            {
                $this->imgErrMsg = "File size is too large. Maximum file size is 10MB";
            }else{
                return true;
            }
        }

        public function uploadImg ($file)
        {
            $imgTmp = $file['tmp_name'];
            $imgName = $file['name'];
            $imgExt = strtolower(pathinfo($imgName, PATHINFO_EXTENSION));
            $imgName = strtolower(pathinfo($imgName, PATHINFO_FILENAME));
            $imgName = str_replace(' ', '_', $imgName);
            $imgName = $imgName . time();
            $imgName = $imgName . '.' . $imgExt;
            // create dir if not exists
            if (!file_exists('uploads'))
            {
                mkdir('uploads');
            }
            $imgPath = "uploads/" . $imgName;
            if(move_uploaded_file($imgTmp, $imgPath)){
                $this->imgName = $imgName;
                // delete previous file if exicts
                if($this->session->get('user')['image'] != null){
                    $prevImg = "uploads/" . $this->session->get('user')['image'];
                    if(file_exists($prevImg)){
                        unlink($prevImg);
                    }
                }
                return true;
            }else{
                $this->imgErrMsg = "File uploaded failed";
            }
            
        }

        // update database on image upload
        public function updateImg ($id)
        {
            $imgName = $this->imgName;
            $sql = "UPDATE users SET image = '$imgName' WHERE id = $id";
            if ($this->db->conn->query($sql))
            {
                // set image value on session
                $this->session->update('user', 'image', $imgName);
                return true;
            }else{
                return false;
            }
        }

        public function updateProfile ($name, $email, $phone, $address, $id) {
            $name = $this->db->conn->real_escape_string($name);
            $email = $this->db->conn->real_escape_string($email);
            $phone = $this->db->conn->real_escape_string($phone);
            $address = $this->db->conn->real_escape_string($address);
            $id = $this->db->conn->real_escape_string($id);
            $sql = "UPDATE users SET name = '$name', email = '$email', phone = '$phone', address = '$address' WHERE id = $id";
            if ($this->db->conn->query($sql))
            {
                $this->session->update('user', 'name', $name);
                $this->session->update('user', 'email', $email);
                $this->session->update('user', 'phone', $phone);
                $this->session->update('user', 'address', $address);
                return true;
            }else{
                return false;
            }
        }
        
        
    }
?>
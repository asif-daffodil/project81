<?php
    namespace classes\Auth;
    require_once "Db.php";
    require_once "Session.php";
    require_once "clean.php";

    use classes\Db\Db as Db;
    use classes\Session\Session as Session;
    use classes\Clean\Clean as Clean;

    class Auth 
    {
        public $errName, $errEmail, $errPassword;
        public $crrName, $crrEmail, $crrPassword = false;
        private $session;

        public function __construct() {
            $this->session = new Session();
        }

        public function clean ($data)
        {
            $clean = new Clean();
            return $clean->clean($data);
        }
        public function validation ($name, $email, $password)
        {
            if (empty($name))
            {
                $this->errName = "Name is required";
            }elseif(!preg_match('/^[a-zA-Z. ]*$/', $name))
            {
                $this->errName = "Name must contain only letters and spaces";
            }else{
                $this->crrName = true;
            }

            if (empty($email))
            {
                $this->errEmail = "Email is required";
            }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                $this->errEmail = "Invalid email format";
            }else{
                $this->crrEmail = true;
            }

            if (empty($password))
            {
                $this->errPassword = "Password is required";
            }elseif(strlen($password) < 6)
            {
                $this->errPassword = "Password must be at least 6 characters";
            }else{
                $this->crrPassword = true;
            }

            if ($this->crrName && $this->crrEmail && $this->crrPassword)
            {
                return true;
            }else{
                return false;
            }
        }
        public function signup ($name, $email, $password)
        {
            $db = new Db();
            $conn = $db->conn;
            $name = $conn->real_escape_string($name);
            $email = $conn->real_escape_string($email);
            $password = $conn->real_escape_string($password);
            $password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

            if ($conn->query($sql) === TRUE) {
                return true;
            } else {
                return false;
            }
        }
        
        public function loginValidate ($email, $password)
        {
            if (empty($email))
            {
                $this->errEmail = "Email is required";
            }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                $this->errEmail = "Invalid email format";
            }else{
                $this->crrEmail = true;
            }

            if (empty($password))
            {
                $this->errPassword = "Password is required";
            }elseif(strlen($password) < 6)
            {
                $this->errPassword = "Password must be at least 6 characters";
            }else{
                $this->crrPassword = true;
            }

            if ($this->crrEmail && $this->crrPassword)
            {
                return true;
            }else{
                return false;
            }
        }


        public function login ($email, $password)
        {
            $db = new Db();
            $conn = $db->conn;
            $email = $conn->real_escape_string($email);
            $password = $conn->real_escape_string($password);
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if (password_verify($password, $row['password'])) {
                    $this->session->set("user", $row);
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }

        public function logout ()
        {
            $this->session->remove("user");
            header("Location: ./");
        }

        public function user ()
        {
            return $this->session->get("user");
        }

        public function isLogged ()
        {
            return $this->session->get("user") ? true : false;
        }
        
    }

?>
<?php
    namespace classes\Db;
    use mysqli;
    class Db {
        private $host = "localhost";
        private $user = "root";
        private $password = "";
        private $database = "ecommerce81";
        private $port = 4308; // Change this to your desired port number

        public $conn;

        public function __construct() {
            // create database if not exists
            $this->conn = new mysqli($this->host, $this->user, $this->password, $this->database, $this->port);
            if ($this->conn->connect_error) {
                die("Connection failed: " . $this->conn->connect_error);
            }

            $sql = "CREATE DATABASE IF NOT EXISTS $this->database";

            if ($this->conn->query($sql)) {
                $this->conn->close();
                $this->conn = new mysqli($this->host, $this->user, $this->password, $this->database, $this->port);
                $sql = "CREATE TABLE IF NOT EXISTS users (
                    id INT(6) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                    name VARCHAR(100) NOT NULL,
                    email VARCHAR(100) NOT NULL,
                    password VARCHAR(100) NOT NULL,
                    image  VARCHAR(100),
                    phone  VARCHAR(20),
                    address  VARCHAR(255),
                    role VARCHAR(10) DEFAULT 'user',
                    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                )";
                if ($this->conn->query($sql)) {
                    // echo "Table users created successfully";
                } else {
                    echo "Error creating table: " . $this->conn->error;
                }

                // create table for products
                $sql = "CREATE TABLE IF NOT EXISTS products (
                    id INT(6) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                    name VARCHAR(100) NOT NULL,
                    regular_price DECIMAL(10, 2) NOT NULL,
                    sale_price DECIMAL(10, 2),
                    image  VARCHAR(100),
                    description  TEXT,
                    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                )";
                if ($this->conn->query($sql)) {
                    // echo "Table products created successfully";
                } else {
                    echo "Error creating table: " . $this->conn->error;
                }

                // create table for orders
                $sql = "CREATE TABLE IF NOT EXISTS orders (
                    id INT(6) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                    user_id INT(6),
                    product_id INT(6),
                    quantity INT(6),
                    total DECIMAL(10, 2) NOT NULL,
                    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                    FOREIGN KEY (user_id) REFERENCES users(id),
                    FOREIGN KEY (product_id) REFERENCES products(id)
                )";
                if ($this->conn->query($sql)) {
                    // echo "Table orders created successfully";
                } else {
                    echo "Error creating table: " . $this->conn->error;
                }
            } else {
                echo "Error creating database: " . $this->conn->error;
            }
        }


        public function __destruct() {
            $this->conn->close();
        }
    }
?>

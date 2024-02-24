<?php
    namespace classes\Get_Route;
    class Get_Route {
        private $route;
        public function __construct() {
            $this->route = (string) explode(".", basename($_SERVER['PHP_SELF']))[0];
        }

        public function isActive ($page) {
            return $this->route === $page ? 'active':null;
        }

    }
?>
<?php
Namespace classes\Session;
class Session {
    public function __construct() {
        // session start if not already started
        if (session_status() == PHP_SESSION_NONE){
            session_start();
        }
    }

    public function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    public function update($name, $key, $value) {
        $_SESSION[$name][$key] = $value;
    }

    public function get($key) {
        return $_SESSION[$key] ?? null;
    }

    public function remove($key) {
        unset($_SESSION[$key]);
    }

    public function destroy() {
        session_destroy();
    }
}

?>

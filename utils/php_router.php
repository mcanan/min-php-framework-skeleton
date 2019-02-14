<?php
if (preg_match('/\.(?:png|jpg|jpeg|gif|css|js)$/', $_SERVER["REQUEST_URI"])) {
    return false;
} else {
    $_GET['url'] = ltrim($_SERVER["REQUEST_URI"], '/');
    include 'index.php';
}

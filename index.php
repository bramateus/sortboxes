<?php
require_once('includes/config.php');
$response = ($status == 3) ? true : false;
if ($response) {
    require_once('home.php');
}
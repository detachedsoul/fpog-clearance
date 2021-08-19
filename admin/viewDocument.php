<?php

require_once('includes/functions.php');
(!isset($_SESSION['admin_id'])) ? header("Location: index.php") : $id = $_SESSION['admin_id'];
$name = $_SESSION['admin_username'];

$user_id = $_GET['id'];
$option = strtolower($_GET['option']);

?>

<?= viewDocument($user_id, $option); ?>
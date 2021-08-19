<?php

require_once('includes/functions.php');
(!isset($_SESSION['id'])) ? header("Location: index.php") : $id = $_SESSION['id'];
$name = $_SESSION['username'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Clearance Portal | Print Clearance Form</title>

    <!-- Bootstrap core CSS -->
    <link href="css/printform.min.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
</head>

<body>


    <?= printClearanceForm($id); ?>

    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>

</body>

</html>
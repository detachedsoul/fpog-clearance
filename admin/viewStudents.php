<?php

require_once('includes/functions.php');
(!isset($_SESSION['admin_id'])) ? header("Location: index.php") : $id = $_SESSION['admin_id'];
$name = $_SESSION['admin_username'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Clearance Portal | Home</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
</head>

<body>

    <div id="wrapper">

        <!-- Sidebar -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Clearance Portal | Home</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active"><a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down fa-fw"></i> Students <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <?= getPendingStudentID();  ?>
                        </ul>
                    </li>
                </ul>

                <ul class="nav navbar-nav navbar-right navbar-user">
                    <li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-user fa-fw"></i>
                            <?= $name; ?>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="logout.php"><i class="fa fa-power-off"></i> Log Out</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>


        <div id="page-wrapper">

            <div class="row">
                <div class="col-lg-12">
                    <h1>Welcome back, <small><?= $name; ?></small></h1>
                    <ol class="breadcrumb">
                        <li class="active">
                            <i class="fa fa-dashboard fa-fw"></i> Dashboard
                        </li>
                        <li class="active">
                            <i class="fa fa-edit"></i>
                            Students Uploads 
                        </li>
                    </ol>
                </div>
            </div><!-- /.row -->


            <div class="row">
                <div class="col-lg-12">
                    <?= uploadsTable(); ?>
                </div>
            </div><!-- /.row -->

        </div>

    </div>


    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>

</body>

</html>
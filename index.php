<?php require_once('includes/functions.php'); ?>

<?php (isset($_SESSION['id'])) ? header("Location: portal.php") : null; ?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Clearance Portal | Login</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/sign-in.css" rel="stylesheet">

</head>

<body class="text-center">

    <main class="form-signin">
        <form method="post">
            
            <p>
                <?=
                login();
                ?>
            </p>

            <div class="form-floating">
                <label for="floatingInput">Reg Number</label>
                <input type="text" class="form-control" id="floatingInput" placeholder="Reg Number" name="username" autocomplete="off">
            </div>
            <div class="form-floating">
                <label for="floatingPassword">Password</label>
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password" autocomplete="off">
            </div>

            <button class="w-100 btn btn-lg btn-primary" type="submit">
                Log in
            </button>

        </form>

    </main>



</body>

</html>
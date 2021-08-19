<?php require_once('init.php'); ?>

<?php

// Create a connection to the database
function db_connect()
{
    $con = mysqli_connect('localhost', 'root', '', 'eddyquincy');
    return $con;
}

// Log a user in
function login()
{
    $con = db_connect();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = strtoupper($_POST['username']);
        $password = $_POST['password'];

        if (empty($username) || empty($password)) {
            echo $error = "<h3 class='text-danger'>Record not found.</h3>";
            return;
        }

        $sql = 'SELECT * FROM students WHERE `student_id` = ?';
        $query = $con->prepare($sql);
        $query->bind_param('s', $username);
        $query->execute();
        $result = $query->get_result();

        // Check if the username exists
        if ($result->num_rows < 1) {
            echo $error = "<h3 class='text-danger'>Record not found.</h3>";
            return;
        }

        while ($row = $result->fetch_object()) {
            $userPassword = $row->password;

            if (password_verify($password, $userPassword)) {
                $name   =   $row->fname . ' ' . $row->lname . '<br>';
                $id     =   $row->student_id;

                $_SESSION['username'] = $name;
                $_SESSION['id'] = $id;
                header("Location: portal.php");
            } else {
                echo $error = "<h3 class='text-danger'>Record not found.</h3>";
            }
        }
    } else {
        echo $error =   "<h1 class='h3 mb-5 fw-normal'>
                            Welcome. Please Sign In to continue
                        </h1>";
    }
}

// Logs the user out
function logout()
{
    $_SESSION['username'] = null;
    $_SESSION['id'] = null;
    session_destroy();
    header("Location: index.php");
}

// Check the user clearance status once logged in
function checkClearanceStatus($id)
{
    $con = db_Connect();

    $sql = 'SELECT `clearance_status` FROM students WHERE student_id = ?';
    $query = $con->prepare($sql);
    $query->bind_param('s', $id);
    $query->execute();
    $result = $query->get_result()->fetch_object();

    if ($result->clearance_status === 'not cleared') {
        echo "
                <div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <p class='py-3'>
                        Please be informed that you are yet to finish your clearance exercise. Below are the department(s) you are yet to clear.
                    </p>
                    <p>
                        You can use <a href='status.php'>this link</a> to view your clearance details.
                    </p>
                </div>
            ";
    } else if ($result->clearance_status === 'pending') {
        echo "
                <div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <p class='py-3'>
                        The admin is yet to verify your uploaded documents. Please be patient.
                    </p>
                    <p>
                        Use the <a href='status.php'>clearance status</a> page to get further information.
                    </p>
                </div>
            ";
    } else {
        echo "
                <div class='alert alert-success alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h2 class='alert-heading'>Well done!</h2>
                    <p>
                        Congratulations on your successful clearance. It's been a pleasure having you here and we hope you'll be successful in all you endeavors.
                    </p>
                    <hr>
                    <p class='mb-0'>
                        You can now proceed to print your clearance status using this <a href='printForm.php'>this link.</a> Congratulations once again!
                    </p>
                </div>
            ";
    }
}

// Generates links to the uncleared options
function getUnregisteredDepartments($id)
{
    $con = db_Connect();

    $sql = "SELECT * FROM clearance WHERE `student_id` = ? AND `status` = 'not cleared'";
    $query = $con->prepare($sql);
    $query->bind_param('s', $id);
    $query->execute();
    $result = $query->get_result();

    while ($row = $result->fetch_object()) {

        $department = $row->clearance_option;
        $option = $row->link_name;

        echo "

                <li>
                    <a href='clearance.php?option=$option'>
                        $department
                    </a>
                <li>
            ";
    }
}

// Generates  clues on the index page as to uncleared options
function getClearanceOption($id)
{
    $con = db_Connect();

    $sql = "SELECT * FROM clearance WHERE `student_id` = ? AND `status` = 'not cleared'";
    $query = $con->prepare($sql);
    $query->bind_param('s', $id);
    $query->execute();
    $result = $query->get_result();

    while ($row = $result->fetch_object()) {

        $department = $row->clearance_option;
        $option = $row->link_name;

        echo "
                <div class='col-lg-4'>
                    <div class='panel panel-danger'>
                        <div class='panel-heading'>
                            <div class='row'>
                                <div class='col-xs-6'>
                                    <i class='fa fa-tasks fa-5x'></i>
                                </div>
                                <div class='col-xs-6 text-right'>
                                    <p class='announcement-heading'>$department</p>
                                    <p class='announcement-text'>Clearance</p>
                                </div>
                            </div>
                        </div>
                        <a href='clearance.php?option=$option'>
                            <div class='panel-footer announcement-bottom'>
                                <div class='row'>
                                    <div class='col-xs-6'>
                                        Complete Clearance
                                    </div>
                                    <div class='col-xs-6 text-right'>
                                        <i class='fa fa-arrow-circle-right'></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            ";
    }
}

// Get uncleared options in a tabular form and perform appropriate actions
function getUnclearedOptionsTable($id)
{
    $con = db_Connect();

    $sql = "SELECT * FROM clearance WHERE `student_id` = ?";
    $query = $con->prepare($sql);
    $query->bind_param('s', $id);
    $query->execute();
    $result = $query->get_result();

    while ($row = $result->fetch_object()) {

        $department = $row->clearance_option;
        $option = $row->link_name;
        $status = ucwords($row->status);
        $remark = $row->remark;

        if ($status !== 'Cleared') {
            $class = 'danger';
        } else {
            $class = 'success';
        }

?>
        <tbody>
            <tr class=<?= $class ?>>
                <td>
                    <?= $department ?>
                </td>
                <td>
                    <?= $status ?>
                </td>
                <td>
                    <?php
                    if ($status !== 'Cleared' && $status !== 'Pending') : ?>
                        <a href='clearance.php?option=<?= $option ?>'>
                            Upload Document
                        </a>
                    <?php
                    endif;
                    ?>
                </td>
                <td>
                    <?=
                    $status !== 'Cleared' ?
                        $remark
                        :
                        'Clearance successful.';
                    ?>
                </td>
            </tr>
        </tbody>
        <?php
    }
}

// Handles the uploading of files for clearance for the user
function clearanceProcess($id)
{
    if (!isset($_GET['option'])) {
        header("Location: portal.php");
    }
    $option = $_GET['option'];
    $uppercaseOption = ucwords($option);
    $con = db_Connect();

    $sql = "SELECT student_id, clearance_option FROM clearance WHERE `student_id` = ? AND `link_name` = ? AND `status` = 'not cleared'";

    $query = $con->prepare($sql);
    $query->bind_param('ss', $id, $option);
    $query->execute();
    $result = $query->get_result();

    while ($row = $result->fetch_object()) {
        $clearanceOptiopn = $row->clearance_option;
    }

    if ($result->num_rows < 1) {
        echo "<h4 class='text-danger'>
                {$uppercaseOption} is not a registered option for clearance for {$_SESSION['username']}. You'll be redirected back to your portal shortly.
             </h4>";

        header("Refresh: 5, portal.php");
    } else {
        echo "<h4 class='text-info'>
                Please upload your {$clearanceOptiopn} documents.
            </h4>
            <p class='text-danger'>
                Please note that the file must be in PDF format.
            </p>
            <p class='text-danger'>
                Document size must not exceed 2MB
            </p>
            ";
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $allowedType = 'pdf';
        $file = $_FILES['file']['name'];
        $tmpLocation = $_FILES['file']['tmp_name'];


        // Check if a file was selected
        if (empty($file)) {
            echo "<h4 class='text-danger'>Please select a file.</h4>";
            return;
        }

        // Check if the file is of the pdf type
        if (pathinfo($file, PATHINFO_EXTENSION) !== strtolower($allowedType)) {
            echo "<h4 class='text-danger'>Invalid file type. File must in pdf format.</h4>";
            return;
        }

        // Check if file is not more than 2mb
        if ($_FILES['file']['size'] > 2000000) {
            echo "<h4 class='text-danger'>File size too larger. File must be less than 2mb.</h4>";
            return;
        } else {

            // Renames the file to the students name and department for verification
            $files = strtolower(str_replace(' ', '-', $_SESSION['username']));
            $files = strip_tags($files);
            $files = $files . '-' . strtolower(str_replace(' ', '-', $clearanceOptiopn)) . '.' . pathinfo($file, PATHINFO_EXTENSION);

            $dir = 'uploads/' . $files;

            if (move_uploaded_file($tmpLocation, $dir)) {

                /**
                 * Insert the name of the document in the corresponding
                 * table 
                 */

                switch ($option) {

                    case 'library':

                        $sql = "INSERT INTO library (`student_id`, `form`) VALUES(?, ?)";
                        $stmt = $con->prepare($sql);
                        $stmt->bind_param('ss', $id, $files);
                        $stmt->execute();

                        $sql = "UPDATE library SET status = 'pending' WHERE student_id = ?";
                        $query = $con->prepare($sql);
                        $query->bind_param('s', $id);
                        $query->execute();

                        $sql = "UPDATE clearance SET status = 'pending', `remark` = 'Please wait for verification by the site admin' WHERE student_id = ? AND clearance_option = ?";
                        $query = $con->prepare($sql);
                        $query->bind_param('ss', $id, $clearanceOptiopn);
                        $query->execute();

                        break;

                    case 'bursary':

                        $year = $_POST['year'];
                        $sql = "INSERT INTO bursary (`student_id`, `form`, `year`) VALUES(?, ?, ?)";
                        $stmt = $con->prepare($sql);
                        $stmt->bind_param('ssi', $id, $files, $year);
                        $stmt->execute();

                        $sql = "UPDATE bursary SET status = 'pending' WHERE student_id = ?";
                        $query = $con->prepare($sql);
                        $query->bind_param('s', $id);
                        $query->execute();

                        $sql = "UPDATE clearance SET status = 'pending', `remark` = 'Please wait for verification by the site admin' WHERE student_id = ? AND clearance_option = ?";
                        $query = $con->prepare($sql);
                        $query->bind_param('ss', $id, $clearanceOptiopn);
                        $query->execute();

                        break;

                    case 'science':

                        $sql = "INSERT INTO science (`student_id`, `form`) VALUES(?, ?)";
                        $stmt = $con->prepare($sql);
                        $stmt->bind_param('ss', $id, $files);
                        $stmt->execute();

                        $sql = "UPDATE science SET status = 'pending' WHERE student_id = ?";
                        $query = $con->prepare($sql);
                        $query->bind_param('s', $id);
                        $query->execute();

                        $sql = "UPDATE clearance SET status = 'pending', `remark` = 'Please wait for verification by the site admin' WHERE student_id = ? AND clearance_option = ?";
                        $query = $con->prepare($sql);
                        $query->bind_param('ss', $id, $clearanceOptiopn);
                        $query->execute();

                        break;

                    case 'department':

                        $course = $_POST['course'];
                        $sql = "INSERT INTO department (`student_id`, `result`, `course`) VALUES(?, ?, ?)";
                        $stmt = $con->prepare($sql);
                        $stmt->bind_param('sss', $id, $files, $course);
                        $stmt->execute();

                        // Update the cleared status of the user in the couse table accordinly
                        $sql = "UPDATE courses SET status = 'pending' WHERE student_id = ? AND course = ?";
                        $query = $con->prepare($sql);
                        $query->bind_param('ss', $id, $course);
                        $query->execute();


                        /**
                         * Check if that is the last course and then update the cleared status accordingly
                         * 
                         * First get the total number of courses for a student
                         */
                        $sql = "SELECT course FROM courses WHERE student_id = ?";
                        $stmt = $con->prepare($sql);
                        $stmt->bind_param('s', $id);
                        $stmt->execute();
                        $totalCourses = $stmt->get_result()->num_rows;

                        // Then get the total number of pending courses
                        $sql = "SELECT course FROM courses WHERE student_id = ? AND status = 'pending'";
                        $stmt = $con->prepare($sql);
                        $stmt->bind_param('s', $id);
                        $stmt->execute();
                        $totalPendingCourses = $stmt->get_result()->num_rows;

                        // Check if the total courses equal the total number of pending courses
                        if ($totalCourses === $totalPendingCourses) {

                            $sql = "UPDATE clearance SET status = 'pending', `remark` = 'Please wait for verification by the site admin' WHERE student_id = ? AND clearance_option = ?";
                            $query = $con->prepare($sql);
                            $query->bind_param('ss', $id, $clearanceOptiopn);
                            $query->execute();
                        }

                        break;

                    case 'registrar':

                        $sql = "INSERT INTO registrar (`student_id`, `form`) VALUES(?, ?)";
                        $stmt = $con->prepare($sql);
                        $stmt->bind_param('ss', $id, $files);
                        $stmt->execute();

                        $sql = "UPDATE registrar SET status = 'pending' WHERE student_id = ?";
                        $query = $con->prepare($sql);
                        $query->bind_param('s', $id);
                        $query->execute();

                        $sql = "UPDATE clearance SET status = 'pending', `remark` = 'Please wait for verification by the site admin' WHERE student_id = ? AND clearance_option = ?";
                        $query = $con->prepare($sql);
                        $query->bind_param('ss', $id, $clearanceOptiopn);
                        $query->execute();

                        break;

                    case 'affairs':

                        $sql = "INSERT INTO affairs (`student_id`, `form`) VALUES(?, ?)";
                        $stmt = $con->prepare($sql);
                        $stmt->bind_param('ss', $id, $files);
                        $stmt->execute();

                        $sql = "UPDATE affairs SET status = 'pending' WHERE student_id = ?";
                        $query = $con->prepare($sql);
                        $query->bind_param('s', $id);
                        $query->execute();

                        $sql = "UPDATE clearance SET status = 'pending', `remark` = 'Please wait for verification by the site admin' WHERE student_id = ? AND clearance_option = ?";
                        $query = $con->prepare($sql);
                        $query->bind_param('ss', $id, $clearanceOptiopn);
                        $query->execute();

                        break;

                    default:

                        header("Location: portal.php");

                        break;
                }


                /**
                 * Check if this was the last department left to clear and update his cleared status.
                 * 
                 * First get the number of departments available
                 */
                $sql = "SELECT clearance_option FROM clearance WHERE `student_id` = ?";
                $stmt = $con->prepare($sql);
                $stmt->bind_param('s', $id);
                $stmt->execute();
                $departmentCount = $stmt->get_result()->num_rows;


                // Get the number of departments cleared by the user
                $sql = "SELECT `status` FROM clearance WHERE `student_id` = ?  AND status = 'pending'";
                $query = $con->prepare($sql);
                $query->bind_param('s', $id);
                $query->execute();
                $result = $query->get_result();


                /**
                 * Check if the number of cleared options matches the the
                 * total number of departments
                 */
                if ($result->num_rows === $departmentCount) {
                    $sql = "UPDATE students SET `clearance_status` = 'pending' WHERE student_id = ?";
                    $query = $con->prepare($sql);
                    $query->bind_param('s', $id);
                    $query->execute();
                }

                echo "<h4 class='text-success'>Document uploaded successfully. You'll be redirected to your portal shortly.</h4>";
                header("Refresh: 5, status.php");

                return;
            } else {
                echo "<h4 class='text-danger'>There was a problem uploading file. Please try again later.</h4>";
                return;
            }
        }
    }
}

// Shows the necessary form elements based on the clearance option
function clearanceForm($option, $id)
{
    switch ($option) {
        case 'bursary': ?>

            <div class="form-group">
                <label>Select Year</label>
                <select class="form-control" name="year">
                    <option value="1">1</option>
                </select>
            </div>

    <?php

            break;

        case 'department':

            getCourses($id);

            break;
    }
}

// Get the courses for the departmental clearance
function getCourses($id)
{
    $con = db_connect();

    $sql = "SELECT course FROM courses WHERE student_id = ? AND status = 'not cleared'";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('s', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    ?>

    <div class="form-group">
        <label>Course</label>
        <select class="form-control" name="course">

            <?php
            while ($row = $result->fetch_object()) {
                $course = $row->course;
            ?>
                <option value="<?= $course; ?>"><?= $course; ?></option>
            <?php
            }
            ?>

        </select>
    </div>

    <?php

}

// Shows the clearance status
function printClearanceForm($id)
{
    $con = db_Connect();

    $sql = 'SELECT * FROM students WHERE student_id = ?';
    $query = $con->prepare($sql);
    $query->bind_param('s', $id);
    $query->execute();
    $result = $query->get_result();

    // Prevent people who haven't completed their clearance from accessing this page
    // if ($result->fetch_object()->clearance_status !== 'cleared') {
    //     header("Location: portal.php");
    // }       


    // Show the user detials
    while ($row[] = $result->fetch_object()) {
        foreach ($row as $details) : ?>

            <div class="card d-flex m-auto" style="place-content: center; width: 95%;">

                <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-sm-3 gap-md-5">
                    <h5>
                        Federal Polytechnic of Oil and Gas, Bonny, Rivers State, Nigeria
                    </h5>

                    <h5>
                        Department of Computer Science
                    </h5>

                    <img src="images/logo.jpg" alt="Federal Polytechnic of Oil and Gas Bonny" width="auto" height="50">
                </div>

                <div class="card-body px-lg-5">

                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 px-md-5">

                        <div>

                            <div class="d-flex gap-5 align-content-center">

                                <div class="h5">
                                    Ref:
                                </div>

                                <div class="h4">
                                    <?= random_int(1000, 9999); ?>
                                </div>

                            </div>

                            <div class="d-flex gap-5 align-content-center">

                                <div class="h5">
                                    Date:
                                </div>

                                <div class="h4">
                                    <?= date('d/m/Y') ?>
                                </div>

                            </div>

                        </div>

                        <img src="images/<?= $details->passport; ?>" width="150" height="150" style="margin-bottom: 2rem;">

                    </div>

                    <div class="px-md-5">

                        <h2 class="card-title text-center text-decoration-underline mt-4 mb-5">
                            Clearance Certificate
                        </h2>

                        <div class="d-flex flex-column gap-4">

                            <div class="d-flex gap-2 gap-sm-5 gap-md-5 align-items-center flex-wrap">

                                <div class="h5">
                                    Full Name:
                                </div>

                                <div class="h4">
                                    <?= $_SESSION['username']; ?>
                                </div>

                            </div>

                            <div class="d-flex gap-2 gap-sm-5 gap-md-5 align-items-center flex-wrap">

                                <div class="h5">
                                    Registration Number:
                                </div>

                                <div class="h4">
                                    <?= $_SESSION['id']; ?>
                                </div>

                            </div>

                            <div class="d-flex gap-2 gap-sm-5 gap-md-5 align-items-center flex-wrap">

                                <div class="h5">
                                    Department:
                                </div>

                                <div class="h4">
                                    <?= $details->department; ?>
                                </div>

                            </div>

                            <div class="d-flex gap-2 gap-sm-5 gap-md-5 align-items-center flex-wrap">

                                <div class="h5">
                                    Status:
                                </div>

                                <div class="text-success h4">
                                    <?= ucwords($details->clearance_status); ?>
                                </div>

                            </div>

                        </div>

                        <?php if ($details->clearance_status === 'Cleared') : ?>

                            <p class="card-text h4 mt-5 mb-5 w-auto">
                                This is to certify that the bearer of this certificate whose photo and description are shown below has completed the mandatory 2 years program and was awarded this certificate as a proof of completion.
                            </p>

                        <?php
                        else : ?>
                            <p class="card-text h4 mt-5 text-danger w-auto">
                                Please go back and complete your clearance exercise!
                            </p>
                        <?php
                        endif;
                        ?>

                        <p class="card-text h4 mt-5 mb-5 text-danger w-auto">
                            Please note that any amendment to this certificate would render the certificate invalid.
                        </p>

                    </div>

                </div>

            </div>

            <a href="javascript:void(0)" class="btn btn-primary my-5 mx-2 mx-lg-4" onclick="window.print()">
                Print Document
            </a>

<?php
        endforeach;
    }
}

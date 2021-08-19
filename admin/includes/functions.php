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

        $sql = 'SELECT * FROM `admin` WHERE `admin_id` = ?';
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
                $name   =   $row->fullname;
                $id     =   $row->admin_id;

                $_SESSION['admin_username'] = $name;
                $_SESSION['admin_id'] = $id;
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
    $_SESSION['admin_username'] = null;
    $_SESSION['admin_id'] = null;
    session_destroy();
    header("Location: index.php");
}

// Get all students whose clearance status is pending
function getPendingStudents () {

    $con = db_connect();

    $sql = "SELECT * FROM clearance WHERE status = 'pending'";
    $query = $con->query($sql);
    return $query;

}

// Generate links of student names that need verification
function getPendingStudentID () {

    $con = db_connect();

    $sql = "SELECT DISTINCT(student_id) FROM clearance WHERE status = 'pending'";
    $query = $con->query($sql);

    while ($row = $query->fetch_object()) {
        $id = $row->student_id;

        echo "

                <li>
                    <a href='verify.php?verify=$id'>
                        {$id}
                    </a>
                <li>
            ";
    }

}

// Get the uploaded documents that needs to be verified
function getVerifiableDoucments () {

    $students = getPendingStudents();

    while ($row = $students->fetch_object()) {
        $id = $row->student_id;
        $clearance_option = $row->clearance_option;
        $link = $row->link_name;
    ?>

    <form method="POST">
        
        <tbody>
            <tr>
                <td>
                    <?= $id ?>
                </td>
                <td>
                    <?= $clearance_option ?>
                </td>
                <td>
                    <a href='viewDocument.php?id=<?= $id ?>&option=<?= $link ?>' target="_blank">
                        View Document
                    </a>
                </td>
                <td>
                    <input type="text" class="form-control" id="floatingPassword" placeholder="Remark" name="remark[]" autocomplete="off">
                </td>
                <td>
                    <div class="form-group">
                        <select class="form-control" name="status[]">
                            <option value="Not Cleared">
                                Not Cleared
                            </option>
                            <option value="Cleared">
                                Cleared
                            </option>
                        </select>
                    </div>
                </td>
                <td>
                    <button class="btn btn-primary" type="submit">
                        Update
                    </button>
                </td>
            </tr>
        </tbody>

        <?php
            ?>
                <input type="hidden" name="ids[]" value="<?= $id ?>">
                <input type="hidden" name="link_name[]" value="<?= $link ?>">
            <?php
        ?>

    </form>

    <?php
    }

    updateStatus();

}


// Outputs the table for the uploaded documents
function uploadsTable () {

?>  

    <h2>
        Students Uploads
    </h2>

    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped tablesorter">
            <thead>
                <tr>
                    <th>Student  ID <i class="fa fa-sort"></i></th>
                    <th>Clearance Option <i class="fa fa-sort"></i></th>
                    <th>Verify <i class="fa fa-sort"></i></th>
                    <th>Remark <i class="fa fa-sort"></i></th>
                    <th>Change Status <i class="fa fa-sort"></i></th>
                </tr>
            </thead>

            <?= getVerifiableDoucments(); ?>

        </table>
    </div>
<?php
}


// Gets the documents to be verified for a particular student
function getIndividualDocumentsTable ($id) {

    $con = db_connect();
    
    // Get the fields for the student
    $sql = "SELECT * FROM clearance WHERE status = 'pending' AND student_id = ?";
    $query = $con->prepare($sql);
    $query->bind_param('s', $id);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows < 1) {
        echo "<h4 class='text-danger'> $id  is not a valid student ID. You will be redirected to the homepage</h4>";
        header("refresh: 3, portal.php");
    }

    while ($row = $result->fetch_object()) {
        $id = $row->student_id;
        $clearance_option = $row->clearance_option;
        $link = $row->link_name;
    ?>

    <form method="POST">
        
        <tbody>
            <tr>
                <td>
                    <?= $id ?>
                </td>
                <td>
                    <?= $clearance_option ?>
                </td>
                <td>
                    <a href='viewDocument.php?id=<?= $id ?>&option=<?= $link ?>' target="_blank">
                        View Document
                    </a>
                </td>
                <td>
                    <input type="text" class="form-control" id="floatingPassword" placeholder="Remark" name="remark[]" autocomplete="off">
                </td>
                <td>
                    <div class="form-group">
                        <select class="form-control" name="status[]">
                            <option value="Not Cleared">
                                Not Cleared
                            </option>
                            <option value="Cleared">
                                Cleared
                            </option>
                        </select>
                    </div>
                </td>
                <td>
                    <button class="btn btn-primary" type="submit">
                        Update
                    </a>
                </td>
            </tr>
        </tbody>

        <?php
            ?>
                <input type="hidden" name="ids[]" value="<?= $id ?>">
                <input type="hidden" name="link_name[]" value="<?= $link ?>">
            <?php
        ?>

    </form>

    <?php
    }

    updateStatus();

}


// Outputs the table for the uploaded documents for a particular student
function uploadsTableForStudent ($id) {

    if (!isset($id)) {
        header("Location: portal.php");
    }

    $con = db_connect();

    // Get the name of the student
    $sql = "SELECT fname, lname FROM students WHERE student_id = ?";
    $query = $con->prepare($sql);
    $query->bind_param('s', $id);
    $query->execute();
    $result = $query->get_result();

    while ($row = $result->fetch_object()) {
        $fullname = $row->fname . ' ' . $row->lname;
    }
?> 

    <h2>
        <?= isset($fullname) ? $fullname . " Uploads" : null; ?>
    </h2>


    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped tablesorter">
            <thead>
                <tr>
                    <th>Student  ID <i class="fa fa-sort"></i></th>
                    <th>Clearance Option <i class="fa fa-sort"></i></th>
                    <th>Verify <i class="fa fa-sort"></i></th>
                    <th>Remark <i class="fa fa-sort"></i></th>
                    <th>Change Status <i class="fa fa-sort"></i></th>
                </tr>
            </thead>

            <?= getIndividualDocumentsTable($id); ?>

        </table>
    </div>
<?php
}

// View the uploaded document
function viewDocument ($id, $option) {

    $con = db_connect();

    echo $option;

    // Make sure that the option is a valid one
    $sql = "SELECT link_name FROM clearance WHERE student_id = ? AND status = 'pending' AND link_name = '$option'";
    $query = $con->prepare($sql);
    $query->bind_param('s', $id);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows < 1) {
        echo "
                <h1 class='text-danger'>" 
                    . ucwords($option) . " is not a valid clearance department.
                </h1>

                <p> Go back to the <a href='portal.php' style='color: dodgerblue; text-decoration: none;'>home page</a></p>
             ";
        return;
    }

    if ($option === 'department') {
        $sql = "SELECT `result` FROM `{$option}` WHERE student_id = ?";
    } else {
        $sql = "SELECT `form` FROM `{$option}` WHERE student_id = ?";
    }

    
    $query = $con->prepare($sql);
    $query->bind_param('s', $id);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows < 1) {
        echo "<h4 class='text-danger'> Record not found. You will be redirected to the homepage</h4>";
        header("refresh: 3, portal.php");
    }

    if ($option === 'department') {
        $file = "../uploads/" . $result->fetch_object()->result;
    } else {
        $file = "../uploads/" . $result->fetch_object()->form;
    }

    if (file_exists($file)) {
        header("Location: " . $file);
    } else {
        echo "
                <h1 class='text-danger'>
                    File does not exist!
                </h1>

                <p> Go back to the <a href='portal.php' style='color: dodgerblue; text-decoration: none;'>home page</a></p>
             ";
    }


}

// Update the students clearance status after verifying the documents' correctness
function updateStatus () {

    $con = db_connect();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $ids = $_POST['ids'];
        $link_names = $_POST['link_name'];
        $remarks = $_POST['remark'];
        $statuses = $_POST['status'];

        foreach ($statuses as $status) {
            foreach ($remarks as $remark) {
                foreach ($ids as $id) {
                    foreach ($link_names as $link) {
                        echo $id . '<br/>' . $status . '<br/>' . $remark . '<br/>' . $link;

                        $sql = "UPDATE clearance SET remark = ?, status = ? WHERE student_id = ? AND link_name = ?";
                        $query = $con->prepare($sql);
                        $query->bind_param('ssss', $remark, $status, $id, $link);
                        $query->execute();


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
                        $sql = "SELECT `status` FROM clearance WHERE `student_id` = ? AND status = 'Cleared'";
                        $query = $con->prepare($sql);
                        $query->bind_param('s', $id);
                        $query->execute();
                        $result = $query->get_result();


                        /**
                        * Check if the number of cleared options matches the the
                        * total number of departments
                        */
                        if ($result->num_rows === $departmentCount) {
                        $sql = "UPDATE students SET `clearance_status` = 'Cleared' WHERE student_id = ?";
                        $query = $con->prepare($sql);
                        $query->bind_param('s', $id);
                        $query->execute();
                        }

                        if ($query) {
                            header("Location: portal.php");
                        } else {
                            echo "Failed";
                        }

                    }
                }
            }
        }
    }

}
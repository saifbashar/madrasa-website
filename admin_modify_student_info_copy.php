<?php include 'connection_db.php'; ?>
<?php
$msg = "-1";
session_start();
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
} else {
    header('location: login.php');
    session_abort();
}

?>

<?php


try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // foreach ($_POST as $key => $value) {
    //     echo $key . ' = ' . $value . '<br>';
    // }

    if (isset($_POST["btnUpdate"])) {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["Image"]["tmp_name"]) && !empty($_FILES["Image"]["tmp_name"])) {
            $queryId = $_POST['id'];
            $studentName = $_POST['studentName'];
            $class = $_POST['class'];
            echo $class;
            $roll = $_POST['roll'];
            $fatherName = $_POST['fatherName'];
            $motherName = $_POST['motherName'];
            $phoneNo = $_POST['phoneNo'];
            $address = $_POST['address'];
            $picture = file_get_contents($_FILES["Image"]["tmp_name"]);
            $class = $_POST['status'];
            // status => 1 (resident), 0 (non resident)
            $stmt = $pdo->prepare("UPDATE students SET studentName = :studentName, class = :class, roll=:roll,fatherName=:fatherName,motherName=:motherName,phoneNo = :phoneNo,address=:address,picture=:picture,status = :status WHERE id = :id ");
            $stmt->bindParam(':studentName', $studentName);
            $stmt->bindParam(':class', $class);
            $stmt->bindParam(':roll', $roll);
            $stmt->bindParam(':fatherName', $fatherName);
            $stmt->bindParam(':motherName', $motherName);
            $stmt->bindParam(':phoneNo', $phoneNo);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':id', $queryId);
            $stmt->bindParam(':picture', $picture, PDO::PARAM_LOB);
            $success = $stmt->execute();
            if ($success) {
                $msg = "Student information sucessfully inserted.";
                // echo "New record created successfully 1";
            } else {
                $msg = "Student information insertion unsuccessfull.";
                // echo "Failed";
            }
        } else if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $queryId = $_POST['id'];
            $studentName = $_POST['studentName'];
            $classname = $_POST['class'];
            // echo $class;
            $roll = $_POST['roll'];
            $fatherName = $_POST['fatherName'];
            $motherName = $_POST['motherName'];
            $phoneNo = $_POST['phoneNo'];
            $address = $_POST['address'];
            // $picture = file_get_contents($_FILES["Image"]["tmp_name"]);
            $class = $_POST['status'];
            // status => 1 (resident), 0 (non resident)
            $stmt = $pdo->prepare("UPDATE students SET studentName = :studentName, roll=:roll,fatherName=:fatherName,motherName=:motherName,phoneNo = :phoneNo,address=:address,status = :status, class = :classname WHERE id = :id ");
            $stmt->bindParam(':studentName', $studentName);
            $stmt->bindParam(':classname', $classname);
            $stmt->bindParam(':roll', $roll);
            $stmt->bindParam(':fatherName', $fatherName);
            $stmt->bindParam(':motherName', $motherName);
            $stmt->bindParam(':phoneNo', $phoneNo);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':id', $queryId);
            // $stmt->bindParam(':picture', $picture, PDO::PARAM_LOB);
            $success = $stmt->execute();
            if ($success) {
                $msg = "Student information sucessfully inserted.";
                // echo "New record created successfully 2";
            } else {
                $msg = "Student information insertion unsuccessfull.";
                // echo "Failed";
            }
        }
    } else if (isset($_POST["btnDelete"])) {
        $queryId = $_POST['id'];
        $stmt = $pdo->prepare("DELETE FROM students WHERE id = :id ");
        $stmt->bindParam(':id', $queryId);
        $success = $stmt->execute();
        if ($success) {
            $msg = 'Deletion success fully with id : ' . $queryId;
        } else {
            $msg = "Deletion Failed";
        }
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./extra/css/dataTables.bootstrap5.css">

</head>

<body>


    <?php include 'header.php' ?>
    <div class="my-5"></div>
    <h2 class="text-center">Hello <?php
                                    echo $email;
                                    ?></h2>


    <section>
        <div class="text-center">
            <a href="./admin_notice.php" class="btn mx-3 btn-primary ">Notice</a>
            <a href="./admin_complain.php" class="btn mx-3 btn-primary">Complain</a>
            <a href="./admin_student.php" class="btn mx-3 btn-primary active">Student Information</a>

        </div>
    </section>
    <section class=" my-4">
        <div class="text-center">
            <a href="./admin_add_student.php" class="btn btn-success mx-3 active">Add Students</a>
            <a href="./admin_modify_student.php" class="btn btn-success mx-3">Modify Students</a>
        </div>
    </section>


    <section class="text-center text-danger">
        <?php
        if (isset($msg)) {
            echo $msg;
        }
        ?>
    </section>



    <div class="my-5"></div>
    <?php include 'footer.php' ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="./extra/jquery/jquery-3.7.1.js"></script>
    <script src="./extra/jquery/dataTables.js"></script>
    <script src="./extra/jquery/dataTables.bootstrap5.js"></script>
    <script src="./extra/jquery/Jquery.autoResize.min.js"></script>

    <script>
        $(document).ready(function() {
            $('textarea').autoResize();

        });
    </script>
</body>

</html>
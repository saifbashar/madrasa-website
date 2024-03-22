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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $studentName = $_POST['studentName'];
        $class = $_POST['class'];
        $roll = $_POST['roll'];
        $fatherName = $_POST['fatherName'];
        $motherName = $_POST['motherName'];
        $phoneNo = $_POST['phoneNo'];
        $address = $_POST['address'];
        $picture = file_get_contents($_FILES["Image"]["tmp_name"]);
        // status => 1 (resident), 0 (non resident)
        $stmt = $pdo->prepare("INSERT INTO students (studentName, class, roll,fatherName,motherName,phoneNo,address,picture,status) VALUES (:studentName, :class, :roll,:fatherName,:motherName,:phoneNo,:address,:picture,1) ");
        $stmt->bindParam(':studentName', $studentName);
        $stmt->bindParam(':class', $class);
        $stmt->bindParam(':roll', $roll);
        $stmt->bindParam(':fatherName', $fatherName);
        $stmt->bindParam(':motherName', $motherName);
        $stmt->bindParam(':phoneNo', $phoneNo);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':picture', $picture, PDO::PARAM_LOB);
        $success = $stmt->execute();
        if ($success) {
            $msg = "Student information sucessfully inserted.";
            // echo "New record created successfully";
        } else {
            $msg = "Student information insertion unsuccessfull.";
            echo "Failed";
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
    <?php
    if ($msg != '-1') {
        echo '<div class="alert alert-success alert-dismissible fade show w-75 mx-auto" role="alert">
       ' . $msg . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    ?>

    <section>
        <form class="row g-3 w-75 mx-auto border border-success p-2 m-2" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <div class="col-md-12">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="studentName" class="form-control" id="name">
            </div>
            <div class="col-md-6">

                <label for="inputState" class="form-label">Class</label>
                <select id="inputState" name="class" class="form-select">
                    <option selected value="0">Choose...</option>
                    <option value="1">Class 1</option>
                    <option value="2">Class 2</option>
                    <option value="3">Class 3</option>
                </select>

            </div>
            <div class="col-md-6">
                <label for="roll" class="form-label">Roll No</label>
                <input type="text" name="roll" class="form-control" id="roll">
            </div>
            <div class="col-md-6">
                <label for="fatherName" class="form-label">Father Name</label>
                <input type="text" name="fatherName" class="form-control" id="fatherName">
            </div>

            <div class="col-md-6">
                <label for="motherName" class="form-label">Mother Name</label>
                <input type="text" name="motherName" class="form-control" id="motherName">
            </div>
            <div class="col-md-12">
                <label for="phoneNo" class="form-label">Phone No</label>
                <input type="text" name="phoneNo" class="form-control" id="phoneNo">
            </div>

            <div class="col-12">
                <label for="inputAddress" class="form-label">Address</label>
                <input type="text" name="address" class="form-control" id="inputAddress" placeholder="1234 Main St">
            </div>
            <div class="col-12">
                <label for="Image" class="form-label">Picture</label>
                <input type="file" name="Image" class="form-control" id="Image">
            </div>
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary">Registration</button>
            </div>
        </form>
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
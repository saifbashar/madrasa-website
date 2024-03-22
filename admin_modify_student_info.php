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
$queryId = $_GET["id"];
if (isset($_GET["id"])) {
    try {

        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        $stmt = $pdo->prepare("SELECT * FROM students where id = :id");
        $stmt->bindParam(":id", $_GET["id"]);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
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
        <form class="row g-3 w-75 mx-auto border border-success p-2 m-2" action="admin_modify_student_info_copy.php" method="post" enctype="multipart/form-data">
            <div class="text-center">
                <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($data[0]['picture']) . '" style="height:200px;width:200px" class="rounded" /> ' ?>
            </div>
            <input type="hidden" name="id" value=<?php echo $data[0]["id"] ?> class="form-control" id="id">
            <div class="col-md-12">
                <label for="id1" class="form-label">ID</label>
                <input type="text" name="id1" value=<?php echo $data[0]["id"] ?> class="form-control" id="id1" disabled>
            </div>
            <div class="col-md-12">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="studentName" value=<?php echo $data[0]["studentName"] ?> class="form-control" id="name">
            </div>
            <div class="col-md-6">

                <label for="class" class="form-label">Class</label>
                <select id="class" name="class" class="form-select">
                    <?php
                    if ($data[0]["class"] == 0) {
                        echo '<option value="0" selected>Choose...</option>
                        <option value="1" >Class 1</option>
                        <option value="2">Class 2</option>
                        <option value="3">Class 3</option>';
                    }
                    if ($data[0]["class"] == 1) {
                        echo '<option value="0">Choose...</option>
                        <option value="1" selected>Class 1</option>
                        <option value="2">Class 2</option>
                        <option value="3">Class 3</option>';
                    } else if ($data[0]['class'] == 2) {
                        echo '<option value="0">Choose...</option>
                        <option value="1" >Class 1</option>
                        <option value="2" selected>Class 2</option>
                        <option value="3">Class 3</option>';
                    } else if ($data[0]['class'] == 3) {
                        echo '<option value="0">Choose...</option>
                        <option value="1" >Class 1</option>
                        <option value="2" >Class 2</option>
                        <option value="3" selected>Class 3</option>';
                    }
                    ?>

                </select>

            </div>
            <div class="col-md-6">
                <label for="roll" class="form-label">Roll No</label>
                <input type="text" name="roll" value=<?php echo $data[0]["roll"] ?> class="form-control" id="roll">
            </div>
            <div class="col-md-6">
                <label for="fatherName" class="form-label">Father Name</label>
                <input type="text" name="fatherName" value=<?php echo $data[0]["fatherName"] ?> class="form-control" id="fatherName">
            </div>

            <div class="col-md-6">
                <label for="motherName" class="form-label">Mother Name</label>
                <input type="text" name="motherName" value=<?php echo $data[0]["motherName"] ?> class="form-control" id="motherName">
            </div>
            <div class="col-md-12">
                <label for="phoneNo" class="form-label">Phone No</label>
                <input type="text" value=<?php echo $data[0]["phoneNo"] ?> name="phoneNo" class="form-control" id="phoneNo">
            </div>

            <div class="col-12">
                <label for="inputAddress" class="form-label">Address</label>
                <input type="text" name="address" value=<?php echo $data[0]["address"] ?> class="form-control" id="inputAddress" placeholder="1234 Main St">
            </div>
            <div class="col-12">
                <label for="status" class="form-label">Status</label>
                <select id="status" name="status" class="form-select">
                    <?php
                    if ($data[0]["status"] == 1) {
                        echo '<option value="1" selected>Resident</option>
                            <option value="0">non-resident</option>';
                    } else {
                        echo '<option value="1" >Resident</option>
                            <option value="0" selected>non-resident</option>';
                    }
                    ?>

                </select>

            </div>
            <div class="col-12">
                <label for="Image" class="form-label">Picture</label>
                <input type="file" name="Image" class="form-control" id="Image">
            </div>
            <div class="col-12 text-center">
                <button type="submit" name="btnUpdate" value="update" class="btn btn-primary">Update</button>
                <button type="submit" name="btnDelete" value="delete" class="btn btn-danger">Delete</button>
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
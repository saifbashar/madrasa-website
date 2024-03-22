<?php include 'connection_db.php'; ?>
<?php
$msg = "";
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


    $stmt = $pdo->prepare("SELECT * FROM students");
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
            <a href="./admin_add_student.php" class="btn btn-success mx-3">Add Students</a>
            <a href="./admin_modify_student.php" class="btn btn-success mx-3 active">Modify Students</a>
        </div>
    </section>


    <section class="w-75 mx-auto">
        <div class="card my-2">
            <div class="card-header">
                General Notice
            </div>
            <div class="p-2">
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th class="bg-info">Serial No</th>
                            <th class="bg-info">Image</th>
                            <th class="bg-info">Student Id</th>
                            <th class="bg-info">Class</th>

                            <th class="bg-info">Student Name</th>
                            <th class="bg-info">Father Name</th>
                            <th class="bg-info">Mother Name</th>
                            <th class="bg-info">Phone No</th>
                            <th class="bg-info">Address</th>
                            <th class="bg-info">Status</th>
                            <th class="bg-info">Modify/Update</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $id = 0;
                        foreach ($data as $row) {
                            echo "<tr>";
                            $id += 1;
                            echo "<td>" . $id . "</td>";
                            echo '<td><img src="data:image/jpeg;base64,' . base64_encode($row['picture']) . '" style="height:100px;width:100px" /></td>';
                            echo "<td>" . $row['roll'] . "</td>";
                            echo "<td>" . $row['class'] . "</td>";
                            echo "<td>" . $row['studentName'] . "</td>";
                            echo "<td>" . $row['fatherName'] . "</td>";
                            echo "<td>" . $row['motherName'] . "</td>";
                            echo "<td>" . $row['phoneNo'] . "</td>";
                            echo "<td>" . $row['address'] . "</td>";
                            if ($row['status'] == '1') {
                                echo "<td>Resident Student</td>";
                            } else {
                                echo "<td>Non-resident Student</td>";
                            }
                            echo "<td><button class='btn btn-primary' id='btn-complain' onclick='process_info(" . $row['id'] . ")' value=" . $row['id']  . ">Update </button></td>";
                            // echo "<td>Length of blob image data: " . strlen($row['picture']) . "</td>";
                            // echo "<td><button class='btn btn-primary'>" . $row['status'] . "</button></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>


                </table>
            </div>
        </div>
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
        $(document).ready(function() {
            $('#example').DataTable();
        });

        function process_info(msg) {
            window.location.href = "admin_modify_student_info.php?id=" + msg;
        }
    </script>
</body>

</html>
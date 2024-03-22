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


    $stmt = $pdo->prepare("SELECT * FROM complain");
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
    <title>Complain</title>
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
            <a href="./admin_complain.php" class="btn mx-3 btn-primary active">Complain</a>
            <a href="./admin_student.php" class="btn mx-3 btn-primary">Student Information</a>

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
                            <th class="bg-info">SI No</th>
                            <th class="bg-info">Date</th>
                            <th class="bg-info">Email</th>
                            <th class="bg-info">Complain</th>
                            <th class="bg-info">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $id = 0;
                        foreach ($data as $row) {
                            echo "<tr>";
                            $id += 1;
                            echo "<td>" . $id . "</td>";
                            echo "<td>" . $row['date'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['complain'] . "</td>";
                            if ($row['status'] == 'solved') {
                                echo "<td><button class='btn btn-primary' id='btn-complain' disabled value=" . $row['serial'] . ">" . $row['status'] . "</button></td>";
                            } else {
                                echo "<td><button class='btn btn-primary' id='btn-complain' value=" . $row['serial'] . ">" . $row['status'] . "</button></td>";
                            }

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
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <script>
        $(document).ready(function() {
            $('textarea').autoResize();

        });
        $(document).ready(function() {
            $('#example').DataTable();
        });



        $(document).ready(function() {

            $("#btn-complain").click(function() {
                var actionValue = $(this).val();
                $.ajax({
                    url: 'admin_complain_php.php',
                    type: 'POST',
                    data: {
                        action: actionValue
                    },
                    success: function(response) {
                        console.log(response);
                        alert('Action performed successfully!');
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert('An error occurred while performing the action.');
                    }
                });
            });
        });
    </script>

</body>

</html>
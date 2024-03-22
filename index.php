<?php include 'connection_db.php'; ?>
<?php
session_start();
?>


<?php
try {

    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $stmt = $pdo->prepare("SELECT * FROM notice");
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>

<?php
$msg_cmp = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cmpemail = $_POST["complainEmail"];
    $complain = $_POST["complain"];


    try {

        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        // echo $email;
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        $stmt = $pdo->prepare("INSERT INTO complain(email,complain, status) VALUES (:email, :complain,'unsolved')");
        $stmt->bindParam(':email', $cmpemail);
        $stmt->bindParam(':complain', $complain);




        $success = $stmt->execute();


        if ($success) {
            $msg_cmp = "Complain Successfully submitted.";
        } else {
            $msg_cmp = "Complain failed.";
        }
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
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./extra/css/dataTables.bootstrap5.css">
</head>

<body>
    <?php include 'header_top.php' ?>
    <section id="notice" class="w-50  mx-auto">
        <marquee behavior="" direction="">

            <?php
            foreach ($data as $row) {
                echo "<b><a href='" . $row['gdrive'] . "' class='text-danger'>" . $row['notice'] . "</a></b> ";
                echo "&nbsp;&nbsp;&nbsp";
            }
            ?>
        </marquee>
    </section>
    <section class=" my-5">
        <img src="https://www.safeeracademy.org/assets/img/Safeer-Logo.png" class="img-fluid  mx-auto d-block w-50" alt="...">
    </section>
    <?php include 'header.php' ?>


    <section class="">
        <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="./images/img1.jpg" height="500px" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="./images/img2.jpeg" height="500px" class="d-block w-100" alt="...">
                </div>

            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>
    <section class="my-5 mx-4">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
                <div class="card h-100">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body text-center">
                        <h5 class="card-title">Apply Online</h5>
                        <p class="card-text">Applicaton for Admission</p>
                    </div>
                    <a href="#" class="stretched-link"></a>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body text-center">
                        <h5 class="card-title">Madrasa Times</h5>
                        <p class="card-text">Madrasa times play an important role.</p>
                        <a href="#" class="stretched-link"></a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body text-center">
                        <h5 class="card-title">Library</h5>
                        <p class="card-text">Integreated Library Systemw</p>
                        <a href="#" class="stretched-link"></a>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section class="mx-5 my-5">

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
                            <th class="bg-info">Title of notice</th>
                            <th class="bg-info">Download</th>
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
                            echo "<td>" . $row['notice'] . "</td>";

                            echo "<td><a href='." . $row['gdrive'] . "'>Download</a></td>";



                            echo "</tr>";
                        }
                        ?>
                    </tbody>


                </table>
            </div>
        </div>

    </section>


    <section class="my-5 mx-4">
        <h1 class="text-center">Madrasa Management</h1>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
                <div class="card h-100">
                    <img src="./images/mgt/ad1.jpg" class="card-img-top" alt="...">
                    <div class="card-body text-center">
                        <h5 class="card-title">MD. HABIBULLAH BAHAR</h5>
                        <p class="card-text text-danger">CHAIRMAN</p>
                    </div>
                    <a href="#" class="stretched-link"></a>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img src="./images/mgt/ad1.jpg" class="card-img-top" alt="...">
                    <div class="card-body text-center">
                        <h5 class="card-title">MD. HABIBULLAH BAHAR</h5>
                        <p class="card-text text-danger">CHAIRMAN</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img src="./images/mgt/ad1.jpg" class="card-img-top" alt="...">
                    <div class="card-body text-center">

                        <h5 class="card-title">MD. HABIBULLAH BAHAR</h5>
                        <p class="card-text text-danger">CHAIRMAN</p>
                    </div>
                </div>
            </div>

        </div>
    </section>


    <section class="my-5 mx-4">
        <h1 class="text-center">Madrasa Management</h1>
        <div class="row g-4">
            <div class="col-12 ">
                <div class="card mb-3 mx-auto" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="..." class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card mb-3 mx-auto">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="..." class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card mb-3 mx-auto">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="..." class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <section id="complain" class=" w-50 mx-auto my-5">

        <h3 class="text-center">Complaints? Lets us know!</h3>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="complainForm">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" name="complainEmail" placeholder="name@example.com">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Complain</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" name="complain" rows="3"></textarea>
            </div>
            <button type="submit" id="submit-btn" class="btn btn-primary">Submit</button>
        </form>
        <div class="modal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Modal body text goes here.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <?php include 'footer.php' ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="./extra/jquery/jquery-3.7.1.js"></script>
    <script src="./extra/jquery/dataTables.js"></script>
    <script src="./extra/jquery/dataTables.bootstrap5.js"></script>
    <script src="https://kit.fontawesome.com/95862cd6da.js" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
</body>

</html>
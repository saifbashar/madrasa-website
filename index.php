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
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./extra/css/dataTables.bootstrap5.css">
</head>

<body>


    <?php include 'header.php' ?>
    <section class=" my-5">
        <img src="https://www.safeeracademy.org/assets/img/Safeer-Logo.png" class="img-fluid  mx-auto d-block w-50" alt="...">
    </section>

    <section class="my-5">
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
    <?php include 'footer.php' ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="./extra/jquery/jquery-3.7.1.js"></script>
    <script src="./extra/jquery/dataTables.js"></script>
    <script src="./extra/jquery/dataTables.bootstrap5.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
</body>

</html>
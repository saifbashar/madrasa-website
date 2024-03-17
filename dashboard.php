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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $notice = $_POST['notice'];
    $gdrive = $_POST['gdrive'];
    // echo $notice;
    // echo $gdrive;
    try {

        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        // echo $email;
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        $stmt = $pdo->prepare("INSERT INTO notice (notice, gdrive) VALUES (:dbnotice, :dbgdrive)");
        $stmt->bindParam(':dbnotice', $notice);
        $stmt->bindParam(':dbgdrive', $gdrive);




        $success = $stmt->execute();


        if ($success) {
            $msg = "Notice sucessfully inserted.";
        } else {
            $msg = "Insertion unsuccessfull.";
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
    <title>Bootstrap demo</title>
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



    <section class="w-75 mx-auto">

        <form class=" row g-3" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="col-12">
                <label for="inputAddress" class="form-label">Titile of notice:</label>
                <textarea type="textarea" class="form-control" id="inputAddress" name="notice"></textarea>
            </div>
            <div class="col-12">
                <label for="inputAddress" class="form-label">Google Drive Link:</label>
                <textarea type="textarea" class="form-control" id="inputAddress" name="gdrive"></textarea>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">Submit Notice</button>
            </div>
        </form>
        <?php if ($msg != "") {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>' . $msg . '</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
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
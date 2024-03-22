<?php include 'connection_db.php'; ?>

<?php
session_start();
if (isset($_SESSION['email'])) {
    header('location: dashboard.php');
} else {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['useremail'];
        $userpass = $_POST['userpassword'];
        try {

            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            // echo $email;
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            $stmt = $pdo->prepare("SELECT email, password FROM admin WHERE email = :email");
            $stmt->bindParam(':email', $email);


            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);


            if ($result) {
                $storedEmail = $result['email'];
                $storedPassword = $result['password'];
                echo "Username: $storedEmail, Password: $storedPassword";
                if ($storedEmail == $email && $storedPassword == $userpass) {
                    session_start();
                    $_SESSION["email"] = $storedEmail;
                    header("location: dashboard.php");
                }
            } else {
                echo "No user found with that username.";
            }
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}


?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href=".css/style.css">
</head>

<body>

    <?php include 'header.php' ?>

    <div>
        <section class="vh-90" style="background-color: #9A616D;">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col col-xl-10">
                        <div class="card" style="border-radius: 1rem;">
                            <div class="row g-0">
                                <div class="col-md-6 col-lg-5 d-none d-md-block">
                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/img1.webp" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                                </div>
                                <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                    <div class="card-body p-4 p-lg-5 text-black">

                                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                                            <div class="d-flex align-items-center mb-3 pb-1">
                                                <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                                                <span class="h1 fw-bold mb-0">Logo</span>
                                            </div>

                                            <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>

                                            <div class="form-outline mb-4">
                                                <input type="email" id="form2Example17 " name="useremail" class="form-control form-control-lg" />
                                                <label class="form-label" for="form2Example17">Email address</label>
                                            </div>

                                            <div class="form-outline mb-4">
                                                <input type="password" id="form2Example27" name="userpassword" class="form-control form-control-lg" />
                                                <label class="form-label" for="form2Example27">Password</label>
                                            </div>

                                            <div class="pt-1 mb-4">
                                                <button class="btn btn-dark btn-lg btn-block" id="login-submit" type="submit">Login</button>
                                            </div>



                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


    <?php include 'footer.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>
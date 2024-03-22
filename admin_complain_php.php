<?php include 'connection_db.php'; ?>
<?php
// Handle the action based on the data sent from the client
if (isset($_POST['action'])) {
    // echo '<script>alert(' . $_POST['action'] . ');</script>';


    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->prepare("UPDATE complain SET status = 'solved' WHERE serial = :serial");

    $stmt->bindParam(':serial', $_POST['action']); // You need to define $id according to your table structure
    $success = $stmt->execute();
    if ($success) {
        echo '<script>alert("success")</script>';
    } else {
        echo '<script>alert("failed")</script>';
    }
} else {
    echo 'No action specified.';
}

<?php

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the file input field is set in $_FILES array
    if (isset($_FILES["Image"])) {
        echo 'hello';
        // Process image upload
        $picture = file_get_contents($_FILES["Image"]["tmp_name"]);

        // Insert student information into database
        $student_id = $_POST['student_id'];
        $father_name = $_POST['father_name'];

        // Prepare SQL statement
        $stmt = $conn->prepare("INSERT INTO students (student_id, father_name, picture) VALUES (:student_id, :father_name, :picture)");
        $stmt->bindParam(':student_id', $student_id);
        $stmt->bindParam(':father_name', $father_name);
        $stmt->bindParam(':picture', $picture, PDO::PARAM_LOB); // Bind the picture data as a BLOB

        // Execute the statement
        $stmt->execute();

        echo "New record created successfully";
    } else {
        // Handle case where no file was uploaded
        echo "No file uploaded";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        Student ID: <input type="text" name="student_id"><br><br>
        Father's Name: <input type="text" name="father_name"><br><br>
        Picture: <input type="file" name="Image" id="Image"><br><br>
        <input type="submit" value="Submit">
    </form>

</body>

</html>
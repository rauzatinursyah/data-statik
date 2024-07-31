<?php
$targetDir = "uploads/";
$targetFile = $targetDir . basename($_FILES["file"]["name"]);
$uploadOk = 1;

if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
    $conn = new mysqli("file_upload.sql");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO files (filename, filepath) VALUES (?, ?)");
    $stmt->bind_param("ss", $_FILES["file"]["name"], $targetFile);

    if ($stmt->execute()) {
        echo "The file " . basename($_FILES["file"]["name"]) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Sorry, there was an error uploading your file.";
}
?>

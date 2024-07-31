<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload and Download</title>
</head>
<body>
    <h1>Upload a File</h1>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="file">
        <button type="submit">Upload</button>
    </form>

    <h1>Download Files</h1>
    <ul>
        <?php
        $conn = new mysqli("localhost", "root", "", "file_upload");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $result = $conn->query("SELECT * FROM files");
        while ($row = $result->fetch_assoc()) {
            echo '<li><a href="download.php?file=' . $row['filepath'] . '">' . $row['filename'] . '</a></li>';
        }

        $conn->close();
        ?>
    </ul>
</body>
</html>

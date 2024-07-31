<?php
if (isset($_GET['file'])) {
    // Menggunakan realpath untuk mendapatkan jalur absolut
    $file = basename($_GET['file']); // basename digunakan untuk memastikan hanya nama file yang diterima
    $filepath = realpath('uploads/' . $file);

    // Pastikan file berada dalam direktori 'uploads'
    if ($filepath && strpos($filepath, realpath('uploads')) === 0 && file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));
        flush();
        readfile($filepath);
        exit;
    } else {
        echo "File not found.";
    }
} else {
    echo "No file specified.";
}
?>

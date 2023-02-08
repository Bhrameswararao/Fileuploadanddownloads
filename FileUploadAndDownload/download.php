<?php

//new code
// Get the file name from the query string
$fileName = $_GET["fileName"];

// Make sure the file name is safe
$fileName = preg_replace("/[^A-Za-z0-9_\-\.]/", "", $fileName);

// Make sure the file exists
$uploadDirectory = "uploads/";
$filePath = $uploadDirectory . $fileName;
if (!file_exists($filePath)) {
    // File not found
    die("Error: File not found.");
}

// Get the file size
$fileSize = filesize($filePath);

// Send the file to the browser
header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=" . $fileName);
header("Content-Length: " . $fileSize);
readfile($filePath);

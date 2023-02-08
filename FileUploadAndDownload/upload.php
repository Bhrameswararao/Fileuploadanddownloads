<?php

// Check if the file was uploaded
if (isset($_FILES["file"]) && $_FILES["file"]["error"] === UPLOAD_ERR_OK) {
    $fileName = $_FILES["file"]["name"];
    $fileType = $_FILES["file"]["type"];
    $fileTempName = $_FILES["file"]["tmp_name"];
    $fileSize = $_FILES["file"]["size"];
    $filenameOnly = array_pop(array_reverse(explode(".", $fileName)));
    // Allow certain file formats
    $allowedFileTypes = array("image/jpeg", "image/png", "application/pdf");
    if (!in_array($fileType, $allowedFileTypes)) {
        // File type is not allowed
        echo json_encode(array("success" => false, "message" => "File type not allowed"));
        exit;
    }

    // Set a maximum file size
    $maxFileSize = 5000000; // 5MB
    if ($fileSize > $maxFileSize) {
        // File size is too large
        echo json_encode(array("success" => false, "message" => "File size too large"));
        exit;
    }

    // Choose a unique name for the file
    $ext = pathinfo($fileName, PATHINFO_EXTENSION);
    $fileName = $filenameOnly.".".$ext;
    // Save the file to the uploads directory
    $uploadDirectory = "uploads/";
    $uploadFile = $uploadDirectory . $fileName;
    if (move_uploaded_file($fileTempName, $uploadFile)) {
        // File was successfully uploaded
        //echo json_encode(array("success" => true, "fileName" => $fileName));
        echo "<script>alert('File uploaded successfully');
    window.location = ('http://localhost/FileUploadAndDownload/Index.php');
    </script>";
    } else {
        // There was an error uploading the file
        echo json_encode(array("success" => false, "message" => "Error uploading file"));
    }
} else {
    // No file was uploaded
    echo json_encode(array("success" => false, "message" => "No file was uploaded"));
}

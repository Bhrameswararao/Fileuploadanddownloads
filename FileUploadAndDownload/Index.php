<!DOCTYPE html>
<html>
<head>
  <title>File Upload's and Download's</title>
  <h1><i>File Upload's and Download's</i></h1>
  <link rel="stylesheet" type="text/css" href="style.css">
  <script src="script.js"></script>
</head>
<body>
  <h2>File Upload</h2>
  <form action="upload.php" method="post" enctype="multipart/form-data">
    <input type="file" name="file" id="file">
    <input type="submit" value="Upload File">
  </form>

  <h2>File Download</h2>
  <table>
    <thead>
      <tr>
        <th>File Name</th>
        <th>Download</th>
      </tr>
    </thead>
    <tbody>
      <!-- PHP code to display list of uploaded files goes here -->
      <?php 
        $uploadDirectory = "uploads/";
        $files = scandir($uploadDirectory);
        foreach($files as $file) {
            if($file === '.' || $file === '..') continue;
                echo '<tr>';
                echo '<td>'. $file .'</td>';
                echo '<td><a href="download.php?fileName='.$file.'">Download</a></td>';
                echo '</tr>';
            }
        ?>

    </tbody>
  </table>

</body>
</html>

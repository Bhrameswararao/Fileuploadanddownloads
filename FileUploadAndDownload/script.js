// Listen for file input change
document.getElementById("file-input").addEventListener("change", uploadFile);

// Listen for form submission
document.getElementById("upload-form").addEventListener("submit", uploadFile);

// Handle file upload
function uploadFile(event) {
  event.preventDefault();

  // Get the selected file
  var file = document.getElementById("file-input").files[0];

  // Create a new FormData object
  var formData = new FormData();

  // Add the file to the form data
  formData.append("file", file);

  // Send a POST request to the server with the form data
  fetch("upload.php", {
    method: "POST",
    body: formData
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      // File was successfully uploaded
      // Add a new row to the table with the file name and a download link
      var table = document.getElementById("files-table");
      var row = table.insertRow(-1);
      var fileNameCell = row.insertCell(0);
      var downloadCell = row.insertCell(1);
      fileNameCell.innerHTML = data.fileName;
      downloadCell.innerHTML = "<a href='download.php?fileName=" + data.fileName + "'>Download</a>";
      table.style.display = "block";
    } else {
      // There was an error uploading the file
      alert("Error uploading file");
    }
  });
}
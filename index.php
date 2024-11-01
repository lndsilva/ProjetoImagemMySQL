<!DOCTYPE html>
<html>

<head>
  <title>PHP - Upload image to database - Example</title>
  <link href="style.css" rel="stylesheet" type="text/css" />
  <link href="form.css" rel="stylesheet" type="text/css" />
</head>

<body>
  <div class="phppot-container">
    <h1>Upload image to database:</h1>
    <form action="upload.php" method="post" enctype="multipart/form-data">
      <div class="row">
        <input type="file" name="image" accept="image/*">
        <input type="submit" value="Upload">
      </div>
    </form>

    <h2>Uploaded Image (Displayed from the database)</h2>
    <?php
    // Retrieve the uploaded image from the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bdimages";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $result = $conn->query("SELECT image FROM images ORDER BY id DESC LIMIT 1");

    if (!empty($result) && $result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $imageData = $row['image'];
      echo '<img src="data:image/JPG;base64,' . base64_encode($imageData) . '" alt="Uploaded Image" style="max-width: 500px;">';
    } else {
      echo 'No image uploaded yet.';
    }

    $conn->close();
    ?>
  </div>
</body>

</html>
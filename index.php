<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>php</title>
</head>
<?php
$servername = "localhost";
$username = "root";
$password = "root";

try {
  $conn = new PDO("mysql:host=$servername;dbname=comments", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>

<body>
  <form action="#" method="post">
    <input type="text" name="name" placeholder="Name"><br>
    <textarea name="comment" placeholder="Comment"></textarea><br>
    <input type="submit" name="submit" value="Submit">
  </form>
</body>
<?php
if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $comment = $_POST['comment'];
  $sql = "INSERT INTO comments (username, comment) VALUES ('$name', '$comment')";
  $conn->exec($sql);
}
// Get comments from database
$stmt = $conn->prepare("SELECT * FROM comments");
$stmt->execute();
$comments = $stmt->fetchAll();
foreach ($comments as $comment) {
  echo "<p><strong>{$comment['username']}</strong>: {$comment['comment']}</p>";
}
?>

</html>
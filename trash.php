<?php 
    // PDO connection
    $conn = new PDO("mysql:host=localhost;dbname=elphpant", "root", "");
    // Check if form is submitted
    if (isset($_POST['name']) && isset($_POST['comment'])) {
        // Insert data into database
        $stmt = $conn->prepare("INSERT INTO comments (name, comment) VALUES (:name, :comment)");
        $stmt->bindParam(':name', $_POST['name']);
        $stmt->bindParam(':comment', $_POST['comment']);
        $stmt->execute();
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elphpant videos</title>
</head>
<body>
    <h1>Elphpant videos</h1>
    <!-- Comment submission form -->
    <form action="#" method="post" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="" required>
        <br>
        <label for="comment">Comment:</label>
        <textarea id="comment" name="comment" rows="4" cols="50" required></textarea>
        <br>
        <input type="submit" value="Submit">
    </form>

    <!-- Comments -->
    <h2>Comments</h2>
    <?php 
        // Get comments from database
        $stmt = $conn->prepare("SELECT * FROM comments");
        $stmt->execute();
        $comments = $stmt->fetchAll();
        foreach ($comments as $comment) {
            echo "<p><strong>{$comment['name']}</strong>: {$comment['comment']}</p>";
        }
    ?>
</body>
</html>
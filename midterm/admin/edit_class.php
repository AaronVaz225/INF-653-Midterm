
<?php

require '../model/database.php';

// Check if the form is submitted
if (isset($_POST['submit'])) {
    
    $class = $_POST['class'];

   
    $sql = "INSERT INTO classes (class) VALUES (:class)";
    $stmt = $db->prepare($sql);
    $stmt->execute(array(':class' => $class));

    
    header("Location: admin.php");
    exit();
}


if (isset($_GET['delete'])) {
    
    $class_id = $_GET['delete'];

    
    $sql = "DELETE FROM classes WHERE id = :class_id";
    $stmt = $db->prepare($sql);
    $stmt->execute(array(':class_id' => $class_id));

    
    header("Location: edit_class.php");
    exit();
}


$existing_classes = $db->query("SELECT * FROM classes")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Class</title>
    <link rel="stylesheet" href="../view/style_a3.css">
</head>
<body>
    
    <h2>Add New Class</h2>

    <!-- Display existing classes -->
    <h3>Existing Classes:</h3>
    <ul>
        <?php foreach ($existing_classes as $class) : ?>
            <li>
                <?php echo $class['class']; ?>
                <a href="edit_class.php?delete=<?php echo $class['id']; ?>" onclick="return confirm('Are you sure you want to delete this class?')">Delete</a>
            </li>
        <?php endforeach; ?>
    </ul>

    <!-- Form to add a new class -->
    <form action="edit_class.php" method="POST">
        <label for="class">Class:</label>
        <input type="text" name="class" required><br><br>
        <button type="submit" name="submit">Add Class</button>
    </form>
</body>
</html>
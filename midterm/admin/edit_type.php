
<?php

require '../model/database.php';

// Check if the form is submitted
if (isset($_POST['submit'])) {
    
    $type = $_POST['type'];

    
    $sql = "INSERT INTO types (type) VALUES (:type)";
    $stmt = $db->prepare($sql);
    $stmt->execute(array(':type' => $type));

    
    header("Location: admin.php");
    exit();
}

// Check if delete request is made
if (isset($_GET['delete'])) {
    
    $type_id = $_GET['delete'];

    
    $sql = "DELETE FROM types WHERE id = :type_id";
    $stmt = $db->prepare($sql);
    $stmt->execute(array(':type_id' => $type_id));

    
    header("Location: edit_type.php");
    exit();
}

// Fetch existing types from the database
$existing_types = $db->query("SELECT * FROM types")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../view/style_a3.css">
    <title>Add Type</title>
</head>
<body>
    <h2>Add New Type</h2>

    <!-- Display existing types with delete option -->
    <h3>Existing Types:</h3>
    <ul>
        <?php foreach ($existing_types as $type) : ?>
            <li>
                <?php echo $type['type']; ?>
                <a href="edit_type.php?delete=<?php echo $type['id']; ?>" onclick="return confirm('Are you sure you want to delete this type?')">Delete</a>
            </li>
        <?php endforeach; ?>
    </ul>

    <!-- Form to add a new type -->
    <form action="edit_type.php" method="POST">
        <label for="type">Type:</label>
        <input type="text" name="type" required><br><br>
        <button type="submit" name="submit">Add Type</button>
    </form>
</body>
</html>
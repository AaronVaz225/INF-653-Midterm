
<?php

require '../model/database.php';

// Check if the form is submitted
if (isset($_POST['submit'])) {
    
    $make = $_POST['make'];

    
    $sql = "INSERT INTO makes (make) VALUES (:make)";
    $stmt = $db->prepare($sql);
    $stmt->execute(array(':make' => $make));

    
    header("Location: admin.php");
    exit();
}

// Check if delete request is made
if (isset($_GET['delete'])) {
    
    $make_id = $_GET['delete'];

   
    $sql = "DELETE FROM makes WHERE id = :make_id";
    $stmt = $db->prepare($sql);
    $stmt->execute(array(':make_id' => $make_id));

    
    header("Location: edit_make.php");
    exit();
}


$existing_makes = $db->query("SELECT * FROM makes")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Make</title>
    <link rel="stylesheet" href="../view/style_a3.css">
</head>
<body>
    <h2>Add New Make</h2>

    <!-- Display existing makes with delete option -->
    <h3>Existing Makes:</h3>
    <ul>
        <?php foreach ($existing_makes as $make) : ?>
            <li>
                <?php echo $make['make']; ?>
                <a href="edit_make.php?delete=<?php echo $make['id']; ?>" onclick="return confirm('Are you sure you want to delete this make?')">Delete</a>
            </li>
        <?php endforeach; ?>
    </ul>

    <!-- Form to add a new make -->
    <form action="edit_make.php" method="POST">
        <label for="make">Make:</label>
        <input type="text" name="make" required><br><br>
        <button type="submit" name="submit">Add Make</button>
    </form>
</body>
</html>
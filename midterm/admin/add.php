
<?php
require '../model/database.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Vehicle</title>
    <link rel="stylesheet" href="../view/style_a2.css">
</head>
<body>
    <h2>Add New Vehicle</h2>
    <form action="add.php" method="POST">
        <label for="make">Make:</label>
        <select name="make" required>
            <option value="">Select Make</option>
            <?php
            
            $makes = $db->query("SELECT make FROM makes")->fetchAll(PDO::FETCH_COLUMN);
            foreach ($makes as $make) {
                echo "<option value='$make'>$make</option>";
            }
            ?>
        </select><br><br>

        <label for="type">Type:</label>
        <select name="type" required>
            <option value="">Select Type</option>
            <?php
            
            $types = $db->query("SELECT type FROM types")->fetchAll(PDO::FETCH_COLUMN);
            foreach ($types as $type) {
                echo "<option value='$type'>$type</option>";
            }
            ?>
        </select><br><br>

        <label for="class">Class:</label>
        <select name="class" required>
            <option value="">Select Class</option>
            <?php
            
            $classes = $db->query("SELECT class FROM classes")->fetchAll(PDO::FETCH_COLUMN);
            foreach ($classes as $class) {
                echo "<option value='$class'>$class</option>";
            }
            ?>
        </select><br><br>

        <label for="year">Year:</label>
        <input type="number" name="year" required><br><br>

        <label for="model">Model:</label>
        <input type="text" name="model" required><br><br>

        <label for="price">Price:</label>
        <input type="number" name="price" step="0.01" required><br><br>

        <button type="submit" name="submit">Add Vehicle</button>
    </form>

    <?php
    if (isset($_POST['submit'])) {
        
        $make = $_POST['make'];
        $type = $_POST['type'];
        $class = $_POST['class'];
        $year = $_POST['year'];
        $model = $_POST['model'];
        $price = $_POST['price'];

        // Insert into the database
        $sql = "INSERT INTO vehicles (make_id, type_id, class_id, year, model, price) 
                VALUES (
                    (SELECT id FROM makes WHERE make = :make),
                    (SELECT id FROM types WHERE type = :type),
                    (SELECT id FROM classes WHERE class = :class),
                    :year,
                    :model,
                    :price
                )";

        // Prepare and execute the sql statement
        $stmt = $db->prepare($sql);
        $stmt->execute(array(
            ':make' => $make,
            ':type' => $type,
            ':class' => $class,
            ':year' => $year,
            ':model' => $model,
            ':price' => $price
        ));

        echo "Vehicle added successfully!";
    }
    ?>
</body>
</html>
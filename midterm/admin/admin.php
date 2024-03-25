<?php

require '../model/database.php';

require 'view_admin.php';

$makes = $db->query("SELECT DISTINCT make FROM makes")->fetchAll(PDO::FETCH_COLUMN);
$types = $db->query("SELECT DISTINCT type FROM types")->fetchAll(PDO::FETCH_COLUMN);
$classes = $db->query("SELECT DISTINCT class FROM classes")->fetchAll(PDO::FETCH_COLUMN);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory List</title>
    <link rel="stylesheet" href="../view/style_admin.css">
</head>
<body>
    <h2>Zippy Used Autos Admin Page</h2>
    <hr>

    <form class="filters" action="" method="GET">
        <label for="make">Make:</label>
        <select name="make" id="make">
            <option value="">All</option>
            <?php foreach ($makes as $make) : ?>
                <option value="<?php echo $make; ?>"><?php echo $make; ?></option>
            <?php endforeach; ?>
        </select>

        <label for="type">Type:</label>
        <select name="type" id="type">
            <option value="">All</option>
            <?php foreach ($types as $type) : ?>
                <option value="<?php echo $type; ?>"><?php echo $type; ?></option>
            <?php endforeach; ?>
        </select>

        <label for="class">Class:</label>
        <select name="class" id="class">
            <option value="">All</option>
            <?php foreach ($classes as $class) : ?>
                <option value="<?php echo $class; ?>"><?php echo $class; ?></option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Apply Filters</button>
    </form>

    <hr>
    
    <form class="sort" action="" method="GET">
    <label><input type="radio" name="sort" value="price_desc"> Price (Highest to Lowest)</label>
    <br>
    <label><input type="radio" name="sort" value="year_desc"> Year (Newest to Oldest)</label>
    <br>
    <button type="submit">Sort</button>
</form>


    <hr>
    <table>
        <tr>
            <th>Year</th>
            <th>Model</th>
            <th>Type</th>
            <th>Make</th>
            <th>Class</th>
            <th>Price</th>
           
        </tr>
        <?php
        if ($result->rowCount() > 0) {
            // Output data of each row 
            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>
                        <td>".$row["year"]."</td>
                        <td>".$row["model"]."</td>
                        <td>".$row["type"]."</td>
                        <td>".$row["make"]."</td>
                        <td>".$row["class"]."</td>
                        <td>".$row["price"]."</td>
                        <td><a href='delete_vehicle.php?id=".$row["id"]."' style='color:red;'>X</a></td> <!-- Link to delete_vehicle.php -->
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>0 results</td></tr>";
        }
        require 'admin_footer.php';
        ?>



<?php
require 'database.php';

// set default sorting order
$sort_order = "vehicles.price DESC"; //  (highest to lowest)


if(isset($_GET['sort'])) {
    //use get
    $selected_sort = $_GET['sort'];
    
    
    if($selected_sort == "year_desc") {
        $sort_order = "vehicles.year DESC";
    }
}


$sql = "SELECT vehicles.year, vehicles.model, vehicles.price, types.type, classes.class, makes.make
        FROM vehicles
        INNER JOIN types ON vehicles.type_id = types.id
        INNER JOIN classes ON vehicles.class_id = classes.id
        INNER JOIN makes ON vehicles.make_id = makes.id";


$conditions = array();


if(isset($_GET['make']) && !empty($_GET['make'])) {
    $make = $_GET['make'];
    $conditions[] = "makes.make = '$make'";
}


if(isset($_GET['type']) && !empty($_GET['type'])) {
    $type = $_GET['type'];
    $conditions[] = "types.type = '$type'";
}


if(isset($_GET['class']) && !empty($_GET['class'])) {
    $class = $_GET['class'];
    $conditions[] = "classes.class = '$class'";
}


if (!empty($conditions)) {
    $sql .= " WHERE " . implode(" AND ", $conditions);
}


$sql .= " ORDER BY $sort_order";


$result = $db->query($sql);

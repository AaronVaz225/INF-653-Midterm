<?php

require '../model/database.php';


if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    
    $id = $_GET['id'];

   
    $stmt = $db->prepare("DELETE FROM vehicles WHERE id = ?");
    $stmt->execute([$id]);

    // Redirect back to admin page after deletion
    header("Location: admin.php");
    exit();
} else {
    // Redirect to admin page if ID is not provided or invalid
    header("Location: admin.php");
    exit();
}

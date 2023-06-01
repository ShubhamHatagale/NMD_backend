<?php

require_once 'Main.php';

$Main = new Main();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Fetch all news records
    $data = $Main->getAll("news");
    echo json_encode($data);
}
// Handle other CRUD operations accordingly

<?php

require_once 'Main.php';

$Main = new Main();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Fetch all blog records
    $data = $Main->getAll("about_us");
    echo json_encode($data);
}
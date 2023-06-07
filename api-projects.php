<?php

require_once 'Main.php';

$Main = new Main();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Fetch all blog records
    $data = $Main->getBy_where_condition("projects","where `show`='yes'");
    echo json_encode($data);
}

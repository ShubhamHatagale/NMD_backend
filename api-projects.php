<?php

require_once 'Main.php';

$Main = new Main();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['function'])) {
        $function = $_GET['function'];
        switch ($function) {
            case 'data':
                $data = $Main->getBy_where_condition("projects", "where `show`='yes'");
                echo json_encode($data);
                break;
            case 'latest_data':
                $data = $Main->getBy_latest_where_condition("projects", "where `show`='yes' ORDER BY id DESC");
                echo json_encode($data);
                break;
            default:
                echo json_encode(array('error' => 'Invalid function specified'));
        }
    } else {
        echo json_encode(array('error' => 'Function parameter not provided'));
    }
}

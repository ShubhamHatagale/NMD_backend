<?php

require_once 'Main.php';

$Main = new Main();

// if ($_SERVER['REQUEST_METHOD'] === 'GET') {
//     // Fetch all blog records
//     $data = $Main->chatgpt("pages");
//     echo json_encode($data);
// }


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = $_POST['message'] ?? '';
    // $response = chatgpt($message);
    $response = $Main->chatgpt("hello");

    echo json_encode(['response' => $response]);
} else {
    echo 'Invalid request';
}


// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $message = $_POST['message'] ?? '';
//     $response = chatgpt($message);

//     echo json_encode(['response' => $response]);
// } else {
//     echo 'Invalid request';
// }
<?php

// API endpoint and user message
$apiEndpoint = 'http://localhost/NMD_backend/chat_api.php';
$userMessage = 'Hello, ChatGPT!';

// Prepare the API request URL
$requestURL = $apiEndpoint . '?message=' . urlencode($userMessage);

// Make the API request using file_get_contents()
$response = file_get_contents($requestURL);

// Display the API response
echo $response;

?>

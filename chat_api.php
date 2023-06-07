<?php

// Define the API endpoint
$endpoint = 'https://api.openai.com/v1/engines/davinci/completions';

// Define your OpenAI API key
$apiKey = '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';

// Get the user's message from the request
$userMessage = "explain react js ?";

// Prepare the data to be sent to the API
$data = array(
    'prompt' => $userMessage,
    'max_tokens' => 50, // Maximum number of tokens in the response
);

// Set the HTTP headers
$headers = array(
    'Content-Type: application/json',
    'Authorization: Bearer ' . $apiKey,
);

// Initialize a cURL session
$ch = curl_init();

// Set the cURL options
curl_setopt($ch, CURLOPT_URL, $endpoint);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute the API request
$response = curl_exec($ch);

// Check for cURL errors
if (curl_errno($ch)) {
    $error = 'Error:' . curl_error($ch);
    // Handle the error accordingly
} else {
    // Parse the API response
    $responseData = json_decode($response, true);

    print_r($responseData);

    // Check if 'choices' key is present in the response
    if (isset($responseData['choices'])) {
        $choices = $responseData['choices'];

        // Check if choices array is not empty
        if (!empty($choices)) {
            $chatResponse = $choices;
        } else {
            $error = 'Empty choices array in the response.';
            // Handle the error accordingly
        }
    } else {
        $error = 'Missing choices key in the response.';
        // Handle the error accordingly
    }

    // Send the response back to the client or display the error message
    if (isset($chatResponse)) {
        // echo $chatResponse;
        print_r($chatResponse);

    } else {
        echo $error;
    }
}

// Close the cURL session
curl_close($ch);
?>

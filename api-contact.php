<?php
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");


require_once 'Main.php';

// ... Rest of your PHP code ...

$Main = new Main();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the values from the request body
    
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    // echo json_encode($data);
    // echo $data['contact']
    // Access the value and echo it
    $name = $data['name'];
    $contact = $data['contact'];
    $email = $data['email'];
    $message = $data['message'];

    // echo $message;
    
    // Insert the data into the database
    $data = $Main->insertData("contact", $name, $contact, $email, $message);
    // echo json_encode($data);
    if ($data['status']==200){
        $to = 'niraj@nmdinteriors.com';
        $subject = 'Hello from PHP';
        $message = 'This is a test email sent from PHP.';
        $headers = 'From: info@nmdinteriors.com' . "\r\n" .
        'Reply-To: info@nmdinteriors.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

        // Send the email
        $mailSent = mail($to, $subject, $message, $headers);

        if ($mailSent) {
            // echo 'Email sent successfully.';
            // $arr = array('data' => $data, 'status' => 200,'message'=>'Email sent successfully.');
            echo json_encode($data);
        } else {
            echo 'Failed to send email.';
        }
    }
}

// Handle other CRUD operations accordingly

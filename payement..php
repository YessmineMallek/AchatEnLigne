<?php
$name = $_POST["name"];
$email = $_POST["email"];
$address = $_POST["address"];
$city = $_POST["city"];
$phone = $_POST["phone"];
$code_postale = $_POST["code_postale"];

// Function to verify form inputs
function verifyInputs($name, $email, $address, $city, $state, $code_postale, $card_pay, $credit_card_number) {
    $errors = array();

    // Verify name input
    if (empty($name)) {
        $errors[] = "Name is required";
    }

    // Verify email input
    if (empty($email)) {
        $errors[] = "Email is required";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    // Verify address input
    if (empty($address)) {
        $errors[] = "Address is required";
    }

    // Verify city input
    if (empty($city)) {
        $errors[] = "City is required";
    }

    // Verify state input
    if (empty($state)) {
        $errors[] = "State is required";
    }

    // Verify code postale input
    if (empty($code_postale)) {
        $errors[] = "Code postale is required";
    } else if (!preg_match("/^\d{3}\s?\d{3}$/", $code_postale)) {
        $errors[] = "Invalid code postale format";
    }

    // Verify card pay input
    if (empty($card_pay)) {
        $errors[] = "Card pay is required";
    }

    // Verify credit card number input
    if (empty($credit_card_number)) {
        $errors[] = "Credit card number is required";
    } else if (!preg_match("/^\d{4}-\d{4}-\d{4}-\d{4}$/", $credit_card_number)) {
        $errors[] = "Invalid credit card number format";
    }

    return $errors;
}

// Function to send email
function sendEmail($to, $name, $email, $address, $city, $state, $code_postale, $card_pay, $credit_card_number) {
    $subject = "New checkout operation";
    $message = "A new checkout operation has been submitted with the following information:\n\n";
    $message .= "Name: " . $name . "\n";
    $message .= "Email: " . $email . "\n";
    $message .= "Address: " . $address . "\n";
    $message .= "City: " . $city . "\n";
    $message .= "State: " . $state . "\n";
    $message .= "Code postale: " . $code_postale . "\n";
    $message .= "Card pay: " . $card_pay . "\n";
    $message .= "Credit card number: " . $credit_card_number . "\n";

    $headers = "From: your_email@example.com" . "\r\n" .
        "Reply-To: your_email@example.com" . "\r\n" .
        "X-Mailer: PHP/" . phpversion();

    // Send email
    mail($to, $subject, $message, $headers);
}

// Verify inputs and send email
$errors = verifyInputs($name, $email, $address, $city, $state, $code_postale, $card_pay, $credit_card_number);

if (empty($errors)) {
    $to = "your_email@example.com"; // Set the recipient email address
    sendEmail($to, $name, $email, $address, $city, $state, $code_postale, $card_pay, $credit_card_number);
    echo "Email sent successfully.";
} else {
    // Display errors
    foreach ($errors as $error) {
        echo $error . "<br>";
    }
}
?>
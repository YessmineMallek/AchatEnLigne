<?php
$name = $_POST["name"];
$email = $_POST["email"];
$address = $_POST["address"];
$city = $_POST["city"];
$phone = $_POST["phone"];
$code_postale = $_POST["code_postale"];

// Function to verify form inputs
function verifyInputs($name, $email, $address, $city, $phone, $code_postale) {
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

    if (empty($phone)) {
        $errors[] = "Le numéro de téléphone est requis";
    } else if (!is_numeric($phone)) {
        $errors[] = "Le numéro de téléphone doit être un nombre";
    }


    // Verify code postale input
    if (empty($code_postale)) {
        $errors[] = "Code postale is required";
    }else if (!is_numeric($code_postale)) {
        $errors[] = "Le code postale doit être un nombre";
    }
    
    return $errors;
}

// Function to send email
function sendEmail($to, $name, $email, $address, $city, $phone, $code_postale) {
    $subject = "New checkout operation";
    $message = "A new checkout operation has been submitted with the following information:\n\n"
        . "Name: " . $name . "\n"."Email: " . $email . "\n" . "Address: " . $address . "\n". "City: " . $city . "\n". "phone number: " . $phone . "Code postale: " . $code_postale . "\n". "From:jessamine@ensi-uma.tn" . "\r\n" . "Reply-To: ".$email . "\r\n". phpversion();

    // Send email
    mail($to, $subject, $message, $headers);
}

// Verify inputs and send email
$errors = verifyInputs($name, $email, $address, $city, $phone, $code_postale);

if (empty($errors)) {
    $to = "maroua.bakri@ensi-uma.tn"; // Set the recipient email address
    sendEmail($to, $name, $email, $address, $city, $phone, $code_postale);
    echo "Email sent successfully.";
} else {
    // Display errors
    foreach ($errors as $error) {
        echo $error . "<br>";
    }
}
?>
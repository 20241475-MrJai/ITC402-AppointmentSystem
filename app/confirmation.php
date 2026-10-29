<?php
session_start();

// Only accept form submissions using POST.
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}

$errors = [];

// Read and validate the submitted fields.
$fullname = trim($_POST["fullname"] ?? "");
$email = trim($_POST["email"] ?? "");
$phone = trim($_POST["phone"] ?? "");
$service = $_POST["service"] ?? "";
$date = $_POST["date"] ?? "";
$time = $_POST["time"] ?? "";
$notes = trim($_POST["notes"] ?? "");

$allowedServices = [
    "Consultation",
    "Medical Checkup",
    "Follow-up",
    "Other"
];

$allowedTimes = [
    "09:00", "10:00", "11:00",
    "13:00", "14:00", "15:00"
];

// Validate name.
if ($fullname === "" || strlen($fullname) > 100) {
    $errors[] = "Please enter a name (maximum 100 characters).";
}

// Validate email.
if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 254) {
    $errors[] = "Please enter a valid email address.";
}

// Validate phone.
if (!preg_match('/^[0-9+\s()\-]{7,20}$/', $phone)) {
    $errors[] = "Please enter a valid phone number.";
}

// Validate appointment type.
if (!in_array($service, $allowedServices, true)) {
    $errors[] = "Please select a valid appointment type.";
}

// Validate date format and ensure the date is not in the past.
$dateObject = DateTime::createFromFormat('!Y-m-d', $date);

if (
    !$dateObject ||
    $dateObject->format('Y-m-d') !== $date ||
    $date < date('Y-m-d')
) {
    $errors[] = "Please select a valid appointment date that is today or later.";
}

// Validate appointment time.
if (!in_array($time, $allowedTimes, true)) {
    $errors[] = "Please select a valid appointment time.";
}

// Validate optional notes.
if (strlen($notes) > 500) {
    $errors[] = "Additional notes cannot exceed 500 characters.";
}

// Store the booking in a PHP session only if validation succeeds.
if (empty($errors)) {
    if (!isset($_SESSION["appointments"])) {
        $_SESSION["appointments"] = [];
    }

    $appointment = [
        "id" => bin2hex(random_bytes(4)),
        "fullname" => $fullname,
        "email" => $email,
        "phone" => $phone,
        "service" => $service,
        "date" => $date,
        "time" => $time,
        "notes" => $notes
    ];

    $_SESSION["appointments"][] = $appointment;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Confirmation</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <header>
        <h1>Appointment Booking System</h1>
        <p>Booking submission status</p>
    </header>

    <nav>
        <a href="index.php">Book Appointment</a>
        <a href="appointments.php">View Appointments</a>
    </nav>

    <main>
        <?php if (!empty($errors)): ?>
            <h2>Booking Unsuccessful</h2>

            <div class="message error">
                <p><strong>Please correct the following:</strong></p>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <p><a href="index.php">Return to the booking form</a></p>

        <?php else: ?>
            <h2>Appointment Confirmed!</h2>

            <div class="message success">
                Your appointment has been submitted successfully.
            </div>

            <div class="appointment-card">
                <p><strong>Booking Reference:</strong>
                    <?= htmlspecialchars($appointment["id"], ENT_QUOTES, 'UTF-8') ?></p>
                <p><strong>Name:</strong>
                    <?= htmlspecialchars($appointment["fullname"], ENT_QUOTES, 'UTF-8') ?></p>
                <p><strong>Email:</strong>
                    <?= htmlspecialchars($appointment["email"], ENT_QUOTES, 'UTF-8') ?></p>
                <p><strong>Phone:</strong>
                    <?= htmlspecialchars($appointment["phone"], ENT_QUOTES, 'UTF-8') ?></p>
                <p><strong>Appointment Type:</strong>
                    <?= htmlspecialchars($appointment["service"], ENT_QUOTES, 'UTF-8') ?></p>
                <p><strong>Date:</strong>
                    <?= htmlspecialchars($appointment["date"], ENT_QUOTES, 'UTF-8') ?></p>
                <p><strong>Time:</strong>
                    <?= htmlspecialchars($appointment["time"], ENT_QUOTES, 'UTF-8') ?></p>
                <p><strong>Notes:</strong>
                    <?= htmlspecialchars($appointment["notes"] ?: "None", ENT_QUOTES, 'UTF-8') ?></p>
            </div>

            <p><a href="index.php">Book another appointment</a></p>
            <p><a href="appointments.php">View all appointments</a></p>
        <?php endif; ?>
    </main>

    <footer>
        <p>ITC402 Major Assignment | Appointment Booking System</p>
    </footer>
</div>
</body>
</html>
<?php
session_start();

$appointments = $_SESSION["appointments"] ?? [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Appointments</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <header>
        <h1>Appointment Booking System</h1>
        <p>Manage your appointment bookings</p>
    </header>

    <nav>
        <a href="index.php">Book Appointment</a>
        <a href="appointments.php">View Appointments</a>
    </nav>

    <main>
        <h2>All Appointments</h2>

        <?php if (empty($appointments)): ?>
            <div class="message">
                No appointments have been booked yet.
            </div>

            <p>Use the booking form to create your first appointment.</p>
            <p><a href="index.php">Book an Appointment</a></p>

        <?php else: ?>
            <p>Total appointments:
                <strong><?= count($appointments) ?></strong>
            </p>

            <?php foreach ($appointments as $booking): ?>
                <div class="appointment-card">
                    <h3>
                        <?= htmlspecialchars($booking["fullname"], ENT_QUOTES, 'UTF-8') ?>
                    </h3>

                    <p><strong>Booking Reference:</strong>
                        <?= htmlspecialchars($booking["id"], ENT_QUOTES, 'UTF-8') ?></p>

                    <p><strong>Email:</strong>
                        <?= htmlspecialchars($booking["email"], ENT_QUOTES, 'UTF-8') ?></p>

                    <p><strong>Phone:</strong>
                        <?= htmlspecialchars($booking["phone"], ENT_QUOTES, 'UTF-8') ?></p>

                    <p><strong>Appointment Type:</strong>
                        <?= htmlspecialchars($booking["service"], ENT_QUOTES, 'UTF-8') ?></p>

                    <p><strong>Date:</strong>
                        <?= htmlspecialchars($booking["date"], ENT_QUOTES, 'UTF-8') ?></p>

                    <p><strong>Time:</strong>
                        <?= htmlspecialchars($booking["time"], ENT_QUOTES, 'UTF-8') ?></p>

                    <p><strong>Notes:</strong>
                        <?= htmlspecialchars($booking["notes"] ?: "None", ENT_QUOTES, 'UTF-8') ?></p>
                </div>
            <?php endforeach; ?>

            <p><a href="index.php">Book Another Appointment</a></p>
        <?php endif; ?>
    </main>

    <footer>
        <p>ITC402 Major Assignment | Appointment Booking System</p>
    </footer>
</div>
</body>
</html>

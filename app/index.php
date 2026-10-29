 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Booking System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Appointment Booking System</h1>
            <p>Book your appointment quickly and easily.</p>
        </header>

        <nav>
            <a href="index.php">Book Appointment</a>
            <a href="appointments.php">View Appointments</a>
        </nav>

        <main>
            <h2>Book an Appointment</h2>

            <form action="confirmation.php" method="POST">
                <label for="fullname">Full Name</label>
                <input type="text" id="fullname" name="fullname"
                       placeholder="Enter your full name"
                       maxlength="100" required>

                <label for="email">Email Address</label>
                <input type="email" id="email" name="email"
                       placeholder="Enter your email"
                       maxlength="254" required>

                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone"
                       placeholder="Enter your phone number"
                       maxlength="20" required>

                <label for="service">Appointment Type</label>
                <select id="service" name="service" required>
                    <option value="">-- Select a service --</option>
                    <option value="Consultation">Consultation</option>
                    <option value="Medical Checkup">Medical Checkup</option>
                    <option value="Follow-up">Follow-up</option>
                    <option value="Other">Other</option>
                </select>

                <label for="date">Appointment Date</label>
                <input type="date" id="date" name="date"
                       min="<?= date('Y-m-d') ?>" required>

                <label for="time">Appointment Time</label>
                <select id="time" name="time" required>
                    <option value="">-- Select a time --</option>
                    <option value="09:00">9:00 AM</option>
                    <option value="10:00">10:00 AM</option>
                    <option value="11:00">11:00 AM</option>
                    <option value="13:00">1:00 PM</option>
                    <option value="14:00">2:00 PM</option>
                    <option value="15:00">3:00 PM</option>
                </select>

                <label for="notes">Additional Notes (Optional)</label>
                <textarea id="notes" name="notes"
                          rows="3" maxlength="500"
                          placeholder="Enter any additional information"></textarea>

                <button type="submit">Book Appointment</button>
            </form>
        </main>

        <footer>
            <p>ITC402 Major Assignment | Appointment Booking System</p>
        </footer>
    </div>
</body>
</html>

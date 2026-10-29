\# Appointment Booking System



\## Project Overview

The Appointment Booking System is a PHP web application developed for the ITC402 Major Assignment. It allows users to submit appointment requests, view a confirmation page, and view appointments stored during their current session.



\## Technologies Used

\- PHP 8.4

\- HTML5

\- CSS3

\- Python

\- Selenium WebDriver

\- Git and GitHub



\## Features

\- Appointment booking form

\- Client-side required-field validation

\- Server-side form validation

\- Appointment confirmation page

\- Appointment listing page

\- Session-based appointment storage

\- Automated browser testing with Selenium



\## Project Structure

```text

ITC402-AppointmentSystem/

├── app/

│   ├── index.php

│   ├── confirmation.php

│   ├── appointments.php

│   └── style.css

├── tests/

│   ├── test\_appointments.py

│   └── test\_results.txt

├── .gitignore

└── README.md

```



\## Requirements

\- PHP 8.4 or a compatible PHP version

\- Python installed

\- Selenium Python package

\- A supported browser and compatible WebDriver



\## How to Run the Application

1\. Open Command Prompt.

2\. Navigate to the application folder:

&#x20;  `cd C:\\ITC402-AppointmentSystem\\app`

3\. Start the PHP development server:

&#x20;  `php -S localhost:8000`

4\. Open a browser and visit:

&#x20;  `http://localhost:8000`



\## How to Run the Automated Tests

1\. Start the PHP server and keep its terminal open.

2\. Open another Command Prompt window.

3\. Navigate to the tests folder:

&#x20;  `cd C:\\ITC402-AppointmentSystem\\tests`

4\. Run the test script:

&#x20;  `py test\_appointments.py`



The Selenium test suite checks page loading, successful appointment submission, invalid email handling, missing required fields, and viewing appointments.



\## Test Evidence

The `tests/test\_results.txt` file contains the recorded output from the automated test run.



\## Automated Test Cases



The Selenium test suite contains five automated test cases:



1. Page loads: Verifies that the appointment booking page opens successfully.

2. Valid appointment submission: Checks that a valid appointment can be submitted and a confirmation is displayed.

3. Invalid email: Checks the application's handling of an invalid email address.

4. Missing required fields: Verifies that required fields prevent incomplete submissions.

5. View appointments: Checks that the appointments listing page displays appointment records.



These tests help verify the main application workflow and basic form validation.



\## Data Storage and Limitations

Appointments are stored in PHP sessions rather than a database. The application is intended for educational demonstration and does not provide permanent storage or production-level appointment management.



\##Version Control

Git was used to track project changes, and GitHub hosts the source code.

Main branch: main

Feature branch: feature/project-documentation

Total meaningful commits: 3 before final submission updates

Repository: https://github.com/20241475-MrJai/ITC402-AppointmentSystem

The feature branch was merged into the main branch, and both branches were published to GitHub.




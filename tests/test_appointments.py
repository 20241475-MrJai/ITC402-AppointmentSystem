
import unittest
from datetime import date

from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import Select, WebDriverWait
from selenium.webdriver.support import expected_conditions as EC


class AppointmentBookingTests(unittest.TestCase):

    @classmethod
    def setUpClass(cls):
        options = webdriver.ChromeOptions()
        cls.driver = webdriver.Chrome(options=options)
        cls.wait = WebDriverWait(cls.driver, 10)
        cls.base_url = "http://localhost:8000"

    def setUp(self):
        self.driver.get(self.base_url + "/index.php")

    def fill_valid_form(self):
        self.driver.find_element(By.ID, "fullname").send_keys(
            "Selenium Test User"
        )
        self.driver.find_element(By.ID, "email").send_keys(
            "selenium@example.com"
        )
        self.driver.find_element(By.ID, "phone").send_keys("29912345")

        Select(self.driver.find_element(By.ID, "service")).select_by_visible_text(
            "Consultation"
        )

        date_field = self.driver.find_element(By.ID, "date")
        date_field.send_keys(date.today().strftime("%d%m%Y"))

        Select(self.driver.find_element(By.ID, "time")).select_by_visible_text(
            "10:00 AM"
        )

        self.driver.find_element(By.ID, "notes").send_keys(
            "Created by Selenium automated testing"
        )

    def test_01_page_loads(self):
        self.assertIn("Appointment Booking System", self.driver.page_source)
        self.assertTrue(
            self.driver.find_element(By.ID, "fullname").is_displayed()
        )

    def test_02_valid_appointment_submission(self):
        self.fill_valid_form()

        self.driver.find_element(
            By.CSS_SELECTOR, "button[type='submit']"
        ).click()

        confirmation = self.wait.until(
            EC.visibility_of_element_located((By.CLASS_NAME, "success"))
        )

        self.assertIn("submitted successfully", confirmation.text)

    def test_03_invalid_email(self):
        self.fill_valid_form()

        email_field = self.driver.find_element(By.ID, "email")
        email_field.clear()
        email_field.send_keys("invalid-email")

        self.driver.find_element(
            By.CSS_SELECTOR, "button[type='submit']"
        ).click()

        self.assertIn("/index.php", self.driver.current_url)
        self.assertTrue(email_field.is_displayed())

    def test_04_missing_required_fields(self):
        self.driver.find_element(
            By.CSS_SELECTOR, "button[type='submit']"
        ).click()

        self.assertIn("/index.php", self.driver.current_url)
        self.assertTrue(
            self.driver.find_element(By.ID, "fullname").is_displayed()
        )

    def test_05_view_appointments(self):
        self.driver.find_element(By.LINK_TEXT, "View Appointments").click()

        heading = self.wait.until(
            EC.visibility_of_element_located((By.TAG_NAME, "h2"))
        )

        self.assertEqual(heading.text, "All Appointments")

    @classmethod
    def tearDownClass(cls):
        if hasattr(cls, "driver"):
            cls.driver.quit()


if __name__ == "__main__":
    unittest.main(verbosity=2)
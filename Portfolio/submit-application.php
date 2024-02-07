<?php
$formdata = [];

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve form data
  $formdata = [
    "first_name" => $_POST["first_name"],
    "second_name" => $_POST["second_name"],
    "third_name" => $_POST["third_name"],
    "gender" => isset($_POST["gender"]) ? implode(", ", (array)$_POST["gender"]) : "",
    "date_of_birth" => $_POST["date_of_birth"],
    "email" => $_POST["email"],
    "phone" => $_POST["phone"],
    "address" => $_POST["address"],
    "city" => $_POST["city"],
    "state" => $_POST["state"],
    "zip_code" => $_POST["zip_code"],
    "religion" => $_POST["Religion"],
    "parent_name" => $_POST["parent_name"],
    "marital_status" => isset($_POST["marital_status"]) ? implode(", ", (array)$_POST["marital_status"]) : "",
    "accommodation" => isset($_POST["accommodation"]) ? $_POST["accommodation"] : "",
    "nrc" => $_POST["nrc"],
    "course" => $_POST["course"],
    "previous_course" => $_POST["previous_course"],
    "previous_course_date" => $_POST["previous_course_date"],
    "additional_info" => $_POST["additional_info"],
    "benefit_society" => $_POST["benefit_society"],
  ];

  // Create a new mysqli connection
  $conn = new mysqli('localhost', 'root', '', 'registration'); // Use 'registration' as the database name

  // Check connection
  if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
  } else {
    // Prepare the SQL statement, using the updated table name 'application_form'
    $stmt = $conn->prepare("INSERT INTO application_form (first_name, second_name, third_name, gender, date_of_birth, email, phone, address, city, state, zip_code, religion, parent_name, marital_status, accommodation, nrc, course, previous_course, previous_course_date, additional_info, benefit_society) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Check if the statement is prepared successfully
    if ($stmt) {
      // Bind parameters
      $stmt->bind_param(
        "sssssssssssssssssssss",
        $formdata["first_name"],
        $formdata["second_name"],
        $formdata["third_name"],
        $formdata["gender"],
        $formdata["date_of_birth"],
        $formdata["email"],
        $formdata["phone"],
        $formdata["address"],
        $formdata["city"],
        $formdata["state"],
        $formdata["zip_code"],
        $formdata["religion"],
        $formdata["parent_name"],
        $formdata["marital_status"],
        $formdata["accommodation"],
        $formdata["nrc"],
        $formdata["course"],
        $formdata["previous_course"],
        $formdata["previous_course_date"],
        $formdata["additional_info"],
        $formdata["benefit_society"],
      );

      // Execute the statement
      if ($stmt->execute()) {
        // Data inserted successfully

        // Redirect to a thank you page or confirmation message
        header("Location: Thank-you.html");
        exit(); // Ensure that no further code is executed after the redirect
      } else {
        // Error handling
        echo "Error executing statement: " . $stmt->error;
      }

      // Close the statement
      $stmt->close();
    } else {
      // Error handling
      echo "Error preparing statement: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
  }
}
?>

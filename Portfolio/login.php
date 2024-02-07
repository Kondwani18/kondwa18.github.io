<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $role = $_POST["role"];

    // Check the selected role and set the appropriate credentials
    if ($role == "admin") {
        $id = $_POST["admin_id"];
        $password = $_POST["password"];

        // Hardcoded admin credentials
        $adminId = "admin";
        $adminPassword = "12345";

        // Check if the entered credentials match admin credentials
        if ($id == $adminId && $password == $adminPassword) {
            // Redirect to the admin panel (change the URL accordingly)
            header("Location: adminhome.html");
            exit();
        }
    } elseif ($role == "student") {
        $id = $_POST["student_id"];
        $password = $_POST["password"];

        // Hardcoded student credentials
        $studentId = "student";
        $studentPassword = "12345";

        // Check if the entered credentials match student credentials
        if ($id == $studentId && $password == $studentPassword) {
            // Redirect to the student panel (change the URL accordingly)
            header("Location: student.html");
            exit();
        }
    }

    // Incorrect credentials, show an error message
    $loginError = "Invalid username or password. Please try again.";
}
?>

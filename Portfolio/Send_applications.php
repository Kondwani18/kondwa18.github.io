<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registration";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from the registration table
$sql = "SELECT first_name, second_name, nrc, email FROM accepted_applicants  ";
$result = $conn->query($sql);

if (!$result) {
    die("Error executing query: " . $conn->error);
}

if ($result->num_rows > 0) {
    // Loop through each accepted applicant
    while ($row = $result->fetch_assoc()) {
        // Generate a 5-digit student ID
        $studentId = sprintf("%05d", rand(1, 99999));

        // Create an application letter
        $applicationLetter = "Dear " . $row['first_name'] . " " . $row['second_name'] . ",\n";
        $applicationLetter .= "Congratulations! You have been accepted into our program.\n";
        $applicationLetter .= "Your Student ID is: " . $studentId . "\n";
        $applicationLetter .= "We look forward to having you on campus.\n\n";
        
        // Save the application letter to a file (customize this part based on your needs)
        $fileName = "application_letters/" . $row['first_name'] . "_" . $row['second_name'] . "_letter.txt";
        file_put_contents($fileName, $applicationLetter);

        // Update the student ID in the registration table
        $updateSql = "UPDATE registration SET student_id = '$studentId' WHERE id = " . $row['id'];
        $updateResult = $conn->query($updateSql);

        if (!$updateResult) {
            die("Error updating student ID: " . $conn->error);
        }

        echo "Application letter generated and Student ID updated for " . $row['first_name'] . " " . $row['second_name'] . "<br>";
    }
} else {
    echo "No accepted applicants found.";
}

// Close the database connection
$conn->close();
?>

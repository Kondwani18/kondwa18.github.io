<?php

// Connect to the database
$db = new mysqli('localhost', 'root', '', 'registration'); // Adjust username and password accordingly

// Check connection
if ($db->connect_error) {
    die('Connection failed: ' . $db->connect_error);
}

// Prepare and execute the query
$sql = "SELECT first_name, second_name, third_name, gender, date_of_birth, email, phone, address, city, state, zip_code, religion, parent_name, marital_status, accommodation, nrc, course, previous_course, previous_course_date, additional_info, benefit_society FROM application_form";
$stmt = $db->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

// Create the table header
echo "<table>";
echo "<tr>";
echo "<th>First Name</th>";
echo "<th>Second Name</th>";
echo "<th>Third Name</th>";
echo "<th>Gender</th>";
echo "<th>Date of Birth</th>";
echo "<th>Email</th>";
echo "<th>Phone</th>";
echo "<th>Address</th>";
echo "<th>City</th>";
echo "<th>State</th>";
echo "<th>Zip Code</th>";
echo "<th>Religion</th>";
echo "<th>Parent Name</th>";
echo "<th>Marital Status</th>";
echo "<th>Accommodation</th>";
echo "<th>NRC</th>";
echo "<th>Course</th>";
echo "<th>Previous Course</th>";
echo "<th>Previous Course Date</th>";
echo "<th>Additional Information</th>";
echo "<th>Benefit Society</th>";
echo "</tr>";

// Fetch and display each application record
while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['first_name'] . "</td>";
    echo "<td>" . $row['second_name'] . "</td>";
    echo "<td>" . $row['third_name'] . "</td>";
    echo "<td>" . $row['gender'] . "</td>";
    echo "<td>" . $row['date_of_birth'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo "<td>" . $row['phone'] . "</td>";
    echo "<td>" . $row['address'] . "</td>";
    echo "<td>" . $row['city'] . "</td>";
    echo "<td>" . $row['state'] . "</td>";
    echo "<td>" . $row['zip_code'] . "</td>";
    echo "<td>" . $row['religion'] . "</td>";
    echo "<td>" . $row['parent_name'] . "</td>";
    echo "<td>" . $row['marital_status'] . "</td>";
    echo "<td>" . $row['accommodation'] . "</td>";
    echo "<td>" . $row['nrc'] . "</td>";
    echo "<td>" . $row['course'] . "</td>";
    echo "<td>" . $row['previous_course'] . "</td>";
    echo "<td>" . $row['previous_course_date'] . "</td>";
    echo "<td>" . $row['additional_info'] . "</td>";
    echo "<td>" . $row['benefit_society'] . "</td>";
    echo "</tr>";
}

echo "</table>";

// Close the database connection
$stmt->close();
$db->close();

?>

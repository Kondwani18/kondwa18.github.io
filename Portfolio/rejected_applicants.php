<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Admin.css">
    <title>Rejected Applicants</title>
</head>
<body>

    <h2>Rejected Applicants</h2>

    <?php
        // Connect to the database
        $db = new mysqli('localhost', 'root', '', 'registration'); // Adjust username and password accordingly

        // Check connection
        if ($db->connect_error) {
            die('Connection failed: ' . $db->connect_error);
        }

        // Get the rejected applicants from the database
        $result = $db->query("SELECT * FROM rejected_applicants");

        // Check if there are any rows in the result
        if ($result->num_rows > 0) {
            echo '<table border="1">';
            echo '<tr><th>NRC</th><th>First Name</th><th>Second Name</th></tr>';

            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['nrc']) . '</td>';
                echo '<td>' . htmlspecialchars($row['first_name']) . '</td>';
                echo '<td>' . htmlspecialchars($row['second_name']) . '</td>';
                echo '</tr>';
            }

            echo '</table>';
        } else {
            echo '<p>No rejected applicants found.</p>';
        }

        // Close the database connection
        $db->close();
    ?>

</body>
</html>

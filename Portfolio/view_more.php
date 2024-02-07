<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Admin.css">
    <title>Applicant Details</title>
</head>
<body>

    <h2>Applicant Details</h2>

    <?php
        // Connect to the database
        $db = new mysqli('localhost', 'root', '', 'registration'); // Adjust username and password accordingly

        // Check connection
        if ($db->connect_error) {
            die('Connection failed: ' . $db->connect_error);
        }

        // Get the nrc parameter from the URL
        $nrc = isset($_GET['nrc']) ? $_GET['nrc'] : '';

        // Prepare and execute the query
        $sql = "SELECT * FROM application_form WHERE nrc = ?";
        $stmt = $db->prepare($sql);

        if (!$stmt) {
            die('Error in preparing the statement: ' . $db->error);
        }

        // Bind the parameter and execute the statement
        $stmt->bind_param('s', $nrc);
        if (!$stmt->execute()) {
            die('Error executing the statement: ' . $stmt->error);
        }

        $result = $stmt->get_result();

        // Check if any results were found
        if ($result->num_rows > 0) {
            // Display detailed information
            echo "<table>";
            while ($row = $result->fetch_assoc()) {
                foreach ($row as $key => $value) {
                    echo "<tr>";
                    echo "<td><strong>{$key}</strong></td>";
                    echo "<td>{$value}</td>";
                    echo "</tr>";
                }
            }
            echo "</table>";
        } else {
            echo "No information found for the applicant.";
        }

        // Close the database connection
        $stmt->close();
        $db->close();
    ?>

</body>
</html>

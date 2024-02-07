<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Admin.css">
    
    <title>Application Form Data</title>
</head>
<body>

    <h2>Application Form Data</h2>

    <?php
        // Connect to the database
        $db = new mysqli('localhost', 'root', '', 'registration'); // Adjust username and password accordingly

        // Check connection
        if ($db->connect_error) {
            die('Connection failed: ' . $db->connect_error);
        }

        // Function to accept or reject an application
        function processApplication($db, $nrc, $first_name, $second_name, $status) {
            // Use prepared statements to prevent SQL injection
            $stmt = $db->prepare("INSERT INTO " . $status . "_applicants (nrc, first_name, second_name) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $nrc, $first_name, $second_name);
            $stmt->execute();
            $stmt->close();
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["nrc"], $_POST["first_name"], $_POST["second_name"])) {
                $nrc = $_POST["nrc"];
                $first_name = $_POST["first_name"];
                $second_name = $_POST["second_name"];

                if (isset($_POST["accept"])) {
                    processApplication($db, $nrc, $first_name, $second_name, "accepted");
                } elseif (isset($_POST["reject"])) {
                    processApplication($db, $nrc, $first_name, $second_name, "rejected");
                }
            }
        }

        // Prepare and execute the query
        $sql = "SELECT nrc, first_name, second_name FROM application_form WHERE nrc NOT IN (SELECT nrc FROM accepted_applicants UNION SELECT nrc FROM rejected_applicants)";
        $stmt = $db->prepare($sql);

        if (!$stmt) {
            die('Error in preparing the statement: ' . $db->error);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        // Check if any results were found
        if ($result->num_rows > 0) {
            // Create the form and table
            echo "<form method='post'>";
            echo "<table>";
            echo "<tr>";
            echo "<th>First Name</th>";
            echo "<th>Second Name</th>";
            echo "<th>Action</th>"; // New column for buttons
            echo "</tr>";

            // Fetch and display each application record
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['first_name'] . "</td>";
                echo "<td>" . $row['second_name'] . "</td>";

                // Add buttons with links and onclick events
                echo "<td>";
                echo "<a href='view_more.php?nrc=" . $row['nrc'] . "'>View More</a> | ";
                echo "<button type='submit' name='accept' value='accept'>Accept</button> | ";
                echo "<button type='submit' name='reject' value='reject'>Reject</button>";
                echo "<input type='hidden' name='nrc' value='" . $row['nrc'] . "'>";
                echo "<input type='hidden' name='first_name' value='" . $row['first_name'] . "'>";
                echo "<input type='hidden' name='second_name' value='" . $row['second_name'] . "'>";
                echo "</td>";
                echo "</tr>";
            }

            echo "</table>";
            echo "</form>";
            
            // Button to go back to the admin home
            echo "<a href='Admin.php'>Go Back to Admin Home</a>";
        } else {
            echo "No applications found.";
        }

        // Close the database connection
        $stmt->close();
        $db->close();
    ?>

</body>
</html>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registration";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Prepare the SQL statement
$sql = "CREATE TABLE formdata (
    first_name VARCHAR(255) NOT NULL,
    second_name VARCHAR(255) NOT NULL,
    third_name VARCHAR(255) NOT NULL,
    gender VARCHAR(255) NOT NULL,
    date_of_birth DATE NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(255) NOT NULL,
    address VARCHAR(255) NOT NULL,
    city VARCHAR(255) NOT NULL,
    state VARCHAR(255) NOT NULL,
    zip_code VARCHAR(255) NOT NULL,
    religion VARCHAR(255) NOT NULL,
    parent_name VARCHAR(255) NOT NULL,
    marital_status VARCHAR(255) NOT NULL,
    accommodation VARCHAR(255) NOT NULL,
    nrc VARCHAR(255) NOT NULL,
    course VARCHAR(255) NOT NULL,
    previous_course VARCHAR(255) NOT NULL,
    previous_course_date DATE NOT NULL,
    additional_info VARCHAR(255) NOT NULL,
    benefit_society VARCHAR(255) NOT NULL,
    PRIMARY KEY (nrc)
    )";
    
    // Execute the SQL statement
    if ($conn->query($sql) === TRUE) {
      echo "Table formdata created successfully";
    } else {
      echo "Error creating table: " . $conn->error;
    }
 
    

    // Close connection
$conn->close();






























?>
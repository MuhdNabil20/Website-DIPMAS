<?php
$servername = "localhost";
$username = "root";     // change if needed
$password = "";         // your MySQL password
$dbname = "parking_system";

// Create connection
$conn = new mysqli($localhost, $root, $password, $parking_system);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get data from ESP32
$booking_id  = $_POST['booking_id'];
$slot_id     = $_POST['slot_id'];
$slot_number = $_POST['slot_number'];
$contact     = $_POST['contact'];
$contact_type = $_POST['contact_type'];
$entry_time  = $_POST['entry_time'];
$exit_time   = $_POST['exit_time'];
$duration    = $_POST['duration'];
$RM          = $_POST['RM'];

// Insert data
$sql = "INSERT INTO bookings (booking_id, slot_id, slot_number, contact, contact_type, entry_time, exit_time, duration, RM)
        VALUES ('$booking_id', '$slot_id', '$slot_number', '$contact', '$contact_type', '$entry_time', '$exit_time', '$duration', '$RM')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

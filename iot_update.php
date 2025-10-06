<?php
require_once 'db.php';

$slot_id = $_POST['slot_id'] ?? '';
$occupied = $_POST['occupied'] ?? '';

if ($slot_id === '' || $occupied === '') {
    die("Missing parameters");
}

// Update slot status
$stmt = $conn->prepare("UPDATE slots SET is_available = ? WHERE slot_id = ?");
$available = $occupied ? 0 : 1;
$stmt->bind_param("is", $available, $slot_id);
$stmt->execute();

// Optional: Log to bookings table
if ($occupied) {
    $stmt = $conn->prepare("INSERT INTO bookings (plate_number, slot_id, status) VALUES ('Unknown', ?, 'Parked')");
    $stmt->bind_param("s", $slot_id);
    $stmt->execute();
}

echo "OK";

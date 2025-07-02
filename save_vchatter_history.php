<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$data = json_decode(file_get_contents('php://input'), true);
$chatContent = $data['chat'];
$userID = $data['userID'];
$timestamp = date('Y-m-d_H-i-s', strtotime($data['timestamp'])); // Format timestamp

// Create the filename based on the structure
$filename = "./history/chatter_{$userID}_{$timestamp}.txt";
$fileContent = $chatContent; // Content to save

// Write content to the file
file_put_contents($filename, $fileContent);

echo json_encode(["status" => "success"]);
}
?>

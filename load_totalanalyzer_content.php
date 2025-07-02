<?php
session_start();

// Ensure user ID exists in the session
if (!isset($_SESSION['user']['Id'])) {
http_response_code(403); // Forbidden
echo "User not authenticated.";
exit;
}

// Check if the filename is provided
if (isset($_GET['file'])) {
$filename = basename($_GET['file']); // Use basename to avoid directory traversal
$filePath = "./history/" . $filename;

// Check if the file exists
if (file_exists($filePath)) {
// Read the contents of the file
header('Content-Type: text/plain'); // Tell the browser that it's plain text
readfile($filePath); // Output the file contents
} else {
http_response_code(404); // Not Found
echo "File not found.";
}
} else {
http_response_code(400); // Bad Request
echo "No file specified.";
}
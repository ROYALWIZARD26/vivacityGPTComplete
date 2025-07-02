<?php
session_start();

// Ensure user ID exists in the session
if (!isset($_SESSION['user']['Id'])) {
echo json_encode([]);
exit;
}

$userID = $_SESSION['user']['Id']; // Fetch the user ID from the session
$historyFolder = './history';
$files = array_diff(scandir($historyFolder), array('..', '.')); // Exclude '.' and '..'

// Filter files to include only those starting with "chatter_{$userID}"
$filteredFiles = array_filter($files, function($file) use ($userID) {
return strpos($file, "chatter_$userID") === 0; // Only files starting with "chatter_{$userID}"
});

// Return the filtered list of files as a JSON response
echo json_encode(array_values($filteredFiles));
?>
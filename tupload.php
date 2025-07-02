<?php
function uploadFile() {
$targetDir = "./upload/";
$fileType = strtolower(pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION));
$originalFileName = basename($_FILES["file"]["name"]);
$targetFile = $targetDir . $originalFileName;
$uploadOk = 1;
$type = $_POST['type'];

// Verifica il tipo di file in base alla selezione
if ($type == "txt") {
if ($fileType != "txt") {
echo json_encode(["status" => "error", "message" => "Only TXT files are allowed."]);
$uploadOk = 0;
}
} elseif ($type == "img") {
if ($fileType != "jpg" && $fileType != "png") {
echo json_encode(["status" => "error", "message" => "Only JPG and PNG files are allowed."]);
$uploadOk = 0;
}
} elseif ($type == "audio") {
// Consenti qualsiasi tipo di file audio (per scopi dimostrativi)
if (!preg_match("/audio\/.*/", $_FILES["file"]["type"])) {
echo json_encode(["status" => "error", "message" => "Only audio files are allowed."]);
$uploadOk = 0;
}
}

// Controlla se ci sono stati problemi di caricamento
if ($uploadOk == 0) {
echo json_encode(["status" => "error", "message" => "Your file was NOT uploaded due to an error."]);
} else {
if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
echo json_encode([
"status" => "success",
"message" => "Your file was successfully uploaded.",
"url" => $targetFile // Assicurati di restituire l'URL corretto
]);
} else {
echo json_encode(["status" => "error", "message" => "An error occurred during the upload."]);
}
}
}

uploadFile();
?>
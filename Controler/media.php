<?php


$fileinfo = finfo_open();
    $mime_type = finfo_buffer($fileinfo, base64_decode($jsonBody['file']), FILEINFO_MIME_TYPE);

    $lastId = json_decode($responseInsertMedia, true);
    $file_name = $lastId['last_id'] . "_" . $jsonBody['description'];
    $fileInfo = explode("/", $mime_type);
    $path = "uploads/" . $file_name . "." . $fileInfo[1];
    $status = file_put_contents($path, base64_decode($jsonBody['file']));

    if (!$status) {
        echo "Upload failed";
    }

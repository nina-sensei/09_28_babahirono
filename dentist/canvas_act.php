<?php
// var_dump($_POST);
// exit();

$upload = $_POST['upload'];
// var_dump($upload);
// exit();

// $_POST の値をJSONにして返す
header('Content-Type: application/json; charset=utf-8');
echo json_encode(['upload' => $_POST['upload']]);




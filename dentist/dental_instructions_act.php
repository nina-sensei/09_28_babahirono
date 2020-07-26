<?php
// var_dump($_POST);
// exit();

// 関数ファイル読み込み
include('functions.php');

// データ受け取り
$dentist_id = $_POST["dentist_id"];
$laboratory = $_POST["laboratory"];
$product = $_POST["product"];
$delivery_date = $_POST["delivery_date"];
$name = $_POST["name"];
$kana = $_POST["kana"];
$sex = $_POST["sex"];
$birthday = $_POST["birthday"];
if (isset($_POST['material']) && is_array($_POST['material'])) {
   $material = implode("、", $_POST["material"]);
}
// $material = $_POST["material"];

// 値が存在しないor空で送信されてきた場合はNGにする
if (
   !isset($laboratory) || $laboratory == "" ||
   !isset($product) || $product == "" ||
   !isset($delivery_date) || $delivery_date == "" ||
   !isset($name) || $name == "" ||
   !isset($kana) || $kana == "" ||
   !isset($sex) || $sex == "" ||
   !isset($birthday) || $birthday == "" ||
   !isset($material) || $material == ""
) {
   exit("ParamError");
}

// DB接続関数
$pdo = connect_to_db();

$sql = 'INSERT INTO instructions_form(id, dentist_id, laboratory, product, delivery_date, name, kana, sex, birthday, material, created_at) 
                              VALUES(NULL, :dentist_id, :laboratory, :product, :delivery_date, :name, :kana, :sex, :birthday, :material, sysdate())';

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':dentist_id', $dentist_id, PDO::PARAM_STR);
$stmt->bindValue(':laboratory', $laboratory, PDO::PARAM_STR);
$stmt->bindValue(':product', $product, PDO::PARAM_STR);
$stmt->bindValue(':delivery_date', $delivery_date, PDO::PARAM_STR);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':kana', $kana, PDO::PARAM_STR);
$stmt->bindValue(':sex', $sex, PDO::PARAM_STR);
$stmt->bindValue(':birthday', $birthday, PDO::PARAM_STR);
$stmt->bindValue(':material', $material, PDO::PARAM_STR);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
   // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
   $error = $stmt->errorInfo();
   echo json_encode(["error_msg" => "{$error[2]}"]);
   exit();
} else {
   // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
   header("Location:dentist_top.php");
   exit();
}


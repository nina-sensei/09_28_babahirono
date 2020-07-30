<?php
// var_dump($_POST);
// exit();

// 関数ファイル読み込み
session_start();
include('../functions.php');
check_session_id();

// データ受け取り
$dentist_id = $_POST["id"];
$lab_name = $_POST["lab_name"];
$lab_boss = $_POST["lab_boss"];
$lab_address = $_POST["lab_address"];
$lab_mail = $_POST["lab_mail"];

// 値が存在しないor空で送信されてきた場合はNGにする
if (
   !isset($lab_name) || $lab_name == "" ||
   !isset($lab_boss) || $lab_boss == "" ||
   !isset($lab_address) || $lab_address == "" ||
   !isset($lab_mail) || $lab_mail == "" 
) {
   exit("ParamError");
}

// DB接続関数
$pdo = connect_to_db();

// ユーザ存在有無確認
$sql = 'SELECT COUNT(*) FROM laboratory_table WHERE lab_mail=:lab_mail';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':lab_mail', $lab_mail, PDO::PARAM_STR);
$status = $stmt->execute();

if ($status == false) {
   // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
   $error = $stmt->errorInfo();
   echo json_encode(["error_msg" => "{$error[2]}"]);
   exit();
}

if ($stmt->fetchColumn() > 0) {
   // user_idが1件以上該当した場合はエラーを表示して元のページに戻る
   // $count = $stmt->fetchColumn();
   echo "<p>すでに登録されている技工所です．</p>";
   echo '<a href="dentist_top.php">もどる</a>';
   exit();
}

$sql = 'INSERT INTO laboratory_table(id, dentist_id, lab_name, lab_boss, lab_address, lab_mail, created_at, updated_at, is_deleted) 
                           VALUES(NULL, :dentist_id, :lab_name, :lab_boss, :lab_address, :lab_mail, sysdate(), sysdate(), 0)';

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':dentist_id', $dentist_id, PDO::PARAM_STR);
$stmt->bindValue(':lab_name', $lab_name, PDO::PARAM_STR);
$stmt->bindValue(':lab_boss', $lab_boss, PDO::PARAM_STR);
$stmt->bindValue(':lab_address', $lab_address, PDO::PARAM_STR);
$stmt->bindValue(':lab_mail', $lab_mail, PDO::PARAM_STR);
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


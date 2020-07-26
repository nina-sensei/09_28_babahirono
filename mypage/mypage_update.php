<?php

// 送信データのチェック
// var_dump($_POST);
// exit();
session_start();
include("functions.php");
check_session_id();

// 送信データ受け取り
$name = $_POST["name"];
$kana = $_POST["kana"];
// $sex = $_POST["sex"];
$birthday = $_POST["birthday"];
$username = $_POST["username"];
$password = $_POST["password"];
$id = $_POST["id"];

// DB接続
$pdo = connect_to_db();

// UPDATE文を作成&実行
$sql = 'UPDATE users_table 
            SET name=:name, kana=:kana, birthday=:birthday, username=:username, password=:password, updated_at=sysdate() 
            WHERE id=:id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':kana', $kana, PDO::PARAM_STR);
// $stmt->bindValue(':sex', $sex, PDO::PARAM_STR);
$stmt->bindValue(':birthday', $birthday, PDO::PARAM_STR);
$stmt->bindValue(':username', $username, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);

$status = $stmt->execute();

// echo $stmt->rowCount($status);

// データ登録処理後
if ($status == false) {
   // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
   $error = $stmt->errorInfo();
   echo json_encode(["error_msg" => "{$error[2]}"]);
   exit();
} else {
   // session_write_close();
// うまくいったらデータ（1レコード）を取得
// $val = $stmt->fetch(PDO::FETCH_ASSOC);

// if (!$val) {
//    echo "<p>変更はありません</p>";
//    echo '<a href="mypage.php">My page</a>';
//    exit();
// } else {
   //セッションに新しく代入
//    $_SESSION = array(); // セッション変数を空にする 
//    $_SESSION["session_id"] = session_id();
//    $_SESSION["name"] = $val["name"];
//    $_SESSION["kana"] = $val["kana"];
//    // $_SESSION["sex"] = $val["sex"];
//    $_SESSION["birthday"] = $val["birthday"];
//    $_SESSION["username"] = $val["username"];
//    $_SESSION["password"] = $val["password"];
//    $_SESSION["is_dentist"] = $val["is_dentist"];
//    $_SESSION["is_technician"] = $val["is_technician"];
//    $_SESSION["is_admin"] = $val["is_admin"];
//    $_SESSION["is_deleted"] = $val["is_deleted"];

//    // 正常にSQLが実行された場合は一覧ページファイルに移動し，一覧ページの処理を実行する
   header("Location:mypage.php");
   exit();
// }

}
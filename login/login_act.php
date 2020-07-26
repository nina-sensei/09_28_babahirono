<?php
// var_dump($_POST);
// exit();
session_start();

//外部ファイル読み込み
include("functions.php");

//DB接続
$pdo = connect_to_db();

//データ受け取り
$username = $_POST["username"];
$password = $_POST["password"];

// データ取得SQL作成&実行
$sql = 'SELECT * FROM users_table 
                  WHERE username=:username 
                  AND password=:password
                  AND is_deleted=0';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':username', $username, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
// $stmt->bindValue(':is_dentist', $is_dentist, PDO::PARAM_STR);
// $stmt->bindValue(':is_technician', $is_technician, PDO::PARAM_STR);
$status = $stmt->execute();

// SQL実行時にエラーがある場合はエラーを表示して終了
if ($status == false) {
   // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
   $error = $stmt->errorInfo();
   echo json_encode(["error_msg" => "{$error[2]}"]);
   exit();
}

// うまくいったらデータ（1レコード）を取得
$val = $stmt->fetch(PDO::FETCH_ASSOC);

// ユーザ情報が取得できない場合はメッセージを表示
if (!$val) {
   echo "<p>ログイン情報に誤りがあります．</p>";
   echo '<a href="login.php">login</a>';
   exit();
} else {
   // ログインできたら情報をsession領域に保存して一覧ページへ移動
   $_SESSION = array(); // セッション変数を空にする 
   $_SESSION["session_id"] = session_id();
   $_SESSION["id"] = $val["id"];
   $_SESSION["name"] = $val["name"];
   $_SESSION["kana"] = $val["kana"];
   $_SESSION["sex"] = $val["sex"];
   $_SESSION["birthday"] = $val["birthday"];
   $_SESSION["username"] = $val["username"];
   $_SESSION["password"] = $val["password"];
   $_SESSION["is_dentist"] = $val["is_dentist"];
   $_SESSION["is_technician"] = $val["is_technician"];
   $_SESSION["is_admin"] = $val["is_admin"];
   $_SESSION["is_deleted"] = $val["is_deleted"];   

   if($val["is_dentist"] == 1){
      header("Location:dentist_top.php");
   } else {
      header("Location:technician_top.php");
   }
   exit();
   
}




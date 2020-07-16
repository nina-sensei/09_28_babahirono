<?php
// var_dump($_POST);
// exit();

// 関数ファイル読み込み
include('functions.php');

// データ受け取り
$name = $_POST["name"];
$kana = $_POST["kana"];
$sex = $_POST["sex"];
$birthday = $_POST["birthday"];
$username = $_POST["username"];
$password = $_POST["password"];
$job = $_POST["job"];

// 値が存在しないor空で送信されてきた場合はNGにする
if (
   !isset($name) || $name == "" ||
   !isset($kana) || $kana == "" ||
   !isset($sex) || $sex == "" ||
   !isset($birthday) || $birthday == "" ||
   !isset($username) || $username == "" ||
   !isset($password) || $password == "" ||
   !isset($job) || $job == ""
) {
   exit("ParamError");
}

// $dentist = isset($_POST["dentist"]) ? $_POST["dentist"] : 0;
// $technician = isset($_POST["technician"]) ? $_POST["technician"] : 0;

// DB接続関数
$pdo = connect_to_db();

// ユーザ存在有無確認
$sql = 'SELECT COUNT(*) FROM users_table WHERE username=:username';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':username', $username, PDO::PARAM_STR);
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
   echo "<p>すでに登録されているユーザです．</p>";
   echo '<a href="login.php">ログインはこちら</a>';
   exit();
}

// ユーザ登録SQL作成
// `created_at`と`updated_at`には実行時の`sysdate()`関数を用いて実行時の日時を入力する
/////////条件分岐//////////

if($job == 0){
   $sql = 'INSERT INTO users_table(id, name, kana, sex, birthday, username, password, is_dentist, is_technician, is_admin, is_deleted, created_at, updated_at) 
                        VALUES(NULL, :name, :kana, :sex, :birthday, :username, :password, 1, 0, 0, 0, sysdate(), sysdate())';
} else {
   $sql = 'INSERT INTO users_table(id, name, kana, sex, birthday, username, password, is_dentist, is_technician, is_admin, is_deleted, created_at, updated_at) 
                        VALUES(NULL, :name, :kana, :sex, :birthday, :username, :password,  0, 1, 0, 0, sysdate(), sysdate())';
}


// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':kana', $kana, PDO::PARAM_STR);
$stmt->bindValue(':sex', $sex, PDO::PARAM_STR);
$stmt->bindValue(':birthday', $birthday, PDO::PARAM_STR);
$stmt->bindValue(':username', $username, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
   // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
   $error = $stmt->errorInfo();
   echo json_encode(["error_msg" => "{$error[2]}"]);
   exit();
} else {
   // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
   header("Location:login.php");
   exit();
}

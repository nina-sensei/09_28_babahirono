<?php
session_start();
include("../functions.php");
check_session_id();

$id = $_SESSION["id"];

$pdo = connect_to_db();

$sql = "SELECT T1.id, T2.patient_name, T2.patient_kana, T2.patient_sex, T2.patient_birthday, T2.product, T2.laboratory
         FROM users_table AS T1
         JOIN instructions_form AS T2
         ON T1.id = T2.dentist_id
         AND T1.id = :id
         ";
         

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
   // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
   $error = $stmt->errorInfo();
   echo json_encode(["error_msg" => "{$error[2]}"]);
   exit();
} else {
   // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
   // fetchAll()関数でSQLで取得したレコードを配列で取得できる
   $result = $stmt->fetchAll(PDO::FETCH_ASSOC);  // データの出力用変数（初期値は空文字）を設定
   $output = "";

   foreach ($result as $record) {
      $output .= "<p>{$record["patient_name"]}</p>";
      $output .= "<p>{$record["patient_kana"]}</p>";
      if ($record['patient_sex'] == 0) {
         $output .= "<p>男</p>";
      } else {
         $output .= "<p>女</p>";
      }
      $output .= "<p>{$record["patient_birthday"]}</p>";
      $output .= "<p>{$record["product"]}</p>";
      $output .= "<p>{$record["laboratory"]}</p>";
   }
   // $valueの参照を解除する．解除しないと，再度foreachした場合に最初からループしない
   // 今回は以降foreachしないので影響なし
   unset($value);
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>歯科医師top</title>
</head>

<body>
   <div class="left-box">
      <div class="icon">

      </div>
      <nav>
         <h1>歯科医師top</h1>
         <p>こんにちは！<?= $_SESSION["name"] ?>さん</p>
         <a href="../mypage/mypage.php">My page</a>
         <a href="../login/logout.php">Sign out</a>
         <a href="dental_instructions.php">技工指示書</a>
      </nav>
   </div>

   <div class="right-box">
      <div class="histoy">

      </div>
      <div class="history-box">
         <?= $output ?>
      </div>
   </div>

   <style>
      body {
         display: flex;
      }

   </style>


</body>

</html>
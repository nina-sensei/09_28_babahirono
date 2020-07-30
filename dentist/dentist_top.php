<?php
session_start();
include("../functions.php");
check_session_id();

$id = $_SESSION["id"];

$pdo = connect_to_db();

$sql = "SELECT T1.id, T2.patient_name, T2.patient_kana, T2.patient_sex, T2.patient_birthday, T2.product, T2.laboratory, T2.order_date, T2.delivery_date
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
      $output .= "<div class='one-record'>";
      $output .= "<p>患者名：{$record["patient_name"]}</p>";
      $output .= "<p>カナ：{$record["patient_kana"]}</p>";
      if ($record['patient_sex'] == 0) {
         $output .= "<p>性別：男</p>";
      } else {
         $output .= "<p>性別：女</p>";
      }
      $output .= "<p>生年月日：{$record["patient_birthday"]}</p>";
      $output .= "<p>技工物：{$record["product"]}</p>";
      $output .= "<p>技工所：{$record["laboratory"]}技工所</p>";
      $output .= "<p>注文日：{$record["order_date"]}  納期：{$record["delivery_date"]}</p>";
      $output .= "</div>";
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
         <a href="lab_resister.php">技工所登録</a>
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
         font-size: 15px;
         line-height: 2em;
         width: 85%;
         margin: 0 auto;
         color: #4D648D;
         background-color: #fcfdfd;
      }

      a {
         display: block;
      }

      .history-box {
         padding: 10px;
         margin-left: 100px;
      }

      .one-record {
         padding: 0.5em 5em;
         margin: 2em 0;
         color: #5d627b;
         background: white;
         border-left: solid 5px #F18D9E;
         box-shadow: 0 3px 5px rgba(0, 0, 0, 0.22);
         line-height: 1em;
      }
   </style>


</body>

</html>
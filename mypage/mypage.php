<?php
session_start();
include("functions.php");
check_session_id();

$id = $_SESSION["id"];

// DB接続
$pdo = connect_to_db();

// データ取得SQL作成
$sql = 'SELECT * FROM users_table WHERE id=:id';

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
   $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
   $output = "";
   // <tr><td>deadline</td><td>todo</td><tr>の形になるようにforeachで順番に$outputへデータを追加
   // `.=`は後ろに文字列を追加する，の意味
   foreach ($result as $record) {
      $output .= "<div>{$record["name"]}</div>";
      $output .= "<div>{$record["kana"]}</div>";
      if ($record['sex'] == 0) {
         $output .= "<div>男</div>";
      } else {
         $output .= "<div>女</div>";
      }
      $output .= "<div>{$record["birthday"]}</div>";
      $output .= "<div>{$record["username"]}</div>";
      $output .= "<div>{$record["password"]}</div>";
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
   <title>マイページ</title>
</head>
<body>
   <fieldset>
         <h1>My page</h1>
         <?php
         if ($_SESSION["is_dentist"] == 1) {
            echo '<a href="dentist_top.php">歯科医師top</a>';
         } else {
            echo '<a href="technician_top.php">技工士top</a>';
         }
         ?>
         <a href="logout.php">Sign out</a>
         <div class="mypage">
            <div class="left-box">
               <div class="box-item">お名前</div>
               <div class="box-item">カナ</div>
               <div class="box-item">性別</div>
               <div class="box-item">生年月日</div>
               <div class="box-item">ユーザー名</div>
               <div class="box-item">パスワード</div>
            </div>
            <div class="right-box">
               <?= $output ?>
            </div>
         </div>
         <a href="mypage_edit.php">編集</a>
      </fieldset>
      <style>
         @import url(https://fonts.googleapis.com/css?family=Open+Sans:400);

         body {
            background: #d4dde1;
            color: #5e5e5e;
            font: 400 87.5%/1.5em 'Open Sans', sans-serif;
            line-height: 3em;
            font-size: 1.2em;
         }

         fieldset {
            background: #fafafa;
            border: none;
            text-align: center;
         }

         a {
            color: #f16272;
            padding: 0 30px;
         }

         .mypage {
            display: flex;
            justify-content: center;
         }

         .right-box {
            margin-left: 40px;
         }
      </style>
</body>
</html>


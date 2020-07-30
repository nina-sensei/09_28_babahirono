<?php
session_start();
include("../functions.php");
check_session_id();

//セッションを変数に置き換え
$id = $_SESSION["id"];

// DB接続関数
$pdo = connect_to_db();

// データ取得SQL作成
$sql = 'SELECT * FROM laboratory_table where dentist_id=:dentist_id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':dentist_id', $id, PDO::PARAM_STR);
$status = $stmt->execute();

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
      $output .= "<option>{$record["lab_name"]}</option>";
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
   <title>技工指示書</title>
</head>

<body>
   <div class="instruction-box">
      <form action="dental_instructions_act.php" method="POST" enctype="multipart/form-data">
         <h1>技工指示書</h1>
         <div class="form-item">
            <p>①技工所を選択してください</p>
            <select name="laboratory">
               <option value="none">--- 技工所を選択してください ---</option>
               <?= $output ?>
            </select>
         </div>
         <div class="form-item">
            <p>②患者情報を入力してください</p>
            <label for="">患者氏名</label>
            <input type="text" name="patient_name">
         </div>
         <div class="form-item">
            <label for="">カナ</label>
            <input type="text" name="patient_kana">
         </div>
         <div class="radio-box">
            性別<laber><input type="radio" name="patient_sex" value="0">男</laber>
            <laber><input type="radio" name="patient_sex" value="1">女</laber>
         </div>
         <div class="form-item">
            <label for="">生年月日</label>
            <input type="date" name="patient_birthday">
         </div>
         <div class="radio-box">
            <p>③保険を選択してください</p>
            <laber><input type="radio" name="insurance" value="0">保険</laber>
            <laber><input type="radio" name="insurance" value="1">自費</laber>
         </div>
         <div class="form-item">
            <p>④納品日を入力してください</p>
            <input type="date" name="delivery_date">
         </div>
         <div class="form-item">
            <p>⑤技工物を選択してください</p>
            <select name="product">
               <option value="none">--- 技工物を選択してください ---</option>
               <option value="インレー">インレー</option>
               <option value="クラウン">クラウン</option>
               <option value="ブリッジ">ブリッジ</option>
               <option value="全部床義歯">全部床義歯</option>
               <option value="部分床義歯">部分床義歯</option>
               <option value="義歯修理">義歯修理</option>
               <option value="その他">その他</option>
            </select>
         </div>
         <div class="checkbox">
            <p>⑥材料を選択してください</p>
            <laber><input type="checkbox" name="material[]" value="0">レジン</laber>
            <laber><input type="checkbox" name="material[]" value="1">CR</laber>
            <laber><input type="checkbox" name="material[]" value="2">陶材</laber>
            <laber><input type="checkbox" name="material[]" value="3">床用レジン</laber>
            <laber><input type="checkbox" name="material[]" value="4">金属</laber>
            <laber><input type="checkbox" name="material[]" value="5">ワイヤー</laber>
            <laber><input type="checkbox" name="material[]" value="6">その他</laber>
         </div>
         <div class="dental_fomula">
            <div class="ur_teeth">

            </div>
            <div class="ul_teeth">

            </div>
            <div class="lr_teeth">

            </div>
            <div class="ll_teeth">

            </div>
         </div>
         <div class="picture">
            <input type="file" name="upfile" accept="image/*" capture="camera">
         </div>
         <div><input type="hidden" name="dentist_id" value="<?= $id ?>"></div>
         <div>
            <button id="submit">登録</button>
         </div>
      </form>
      <div class="design">
         <canvas id="canvas" width="480" height="430" style="border: solid 1px #000;"></canvas>
      </div>
      <a href="dentist_top.php">もどる</a>
   </div>

   <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/fabric.js/1.5.0/fabric.min.js"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
   <script>
      let canvas = new fabric.Canvas('canvas');
      // 画像
      fabric.Image.fromURL('../img/dental-formula_black.png', function(oImg) {
         oImg.scale(0.85);
         canvas.add(oImg);
      });

      canvas.isDrawingMode = true; // お絵かきモードの有効化
      canvas.freeDrawingBrush.color = "#000000"; // 描画する線の色
      canvas.freeDrawingBrush.width = 2; // 描画する線の太さ


      // let base64 = this.canvas.toDataURL();
      // console.log(base64);

      // const fd = new FormData();
      // fd.append("upload", base64);
      // const BASE_URL = "dental_instructions_act.php";

      // //ajax送信
      // $('#submit').on('click', function() {

      //    axios.post(BASE_URL, fd)
      //       .then(function(response) {
      //          console.log("response", response);
      //       })
      //       .catch(function(error) {
      //          console.log(error);
      //       });
      // });

      //キャンバスは別フォルダでテスト
   </script>


   <style>
      body {
         font-size: 15px;
         line-height: 2em;
         width: 85%;
         margin: 0 auto;
         color: #4D648D;
         background-color: #fcfdfd;
      }
   </style>
</body>

</html>
<?php
// session_start();
// include("../functions.php");
// check_session_id();

// //セッションを変数に置き換え
// $id = $_SESSION["id"];

?>


<!DOCTYPE html>
<html lang="ja">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>canvas</title>
</head>

<body>
   <!-- <div class="resister-box">
      <h1>技工指示書</h1> -->
   <!-- <form action="dental_instructions_act.php" method="POST" enctype="multipart/form-data">
         <div><input type="hidden" name="dentist_id" value="<?= $id ?>"></div>
         <div class="form-item">
            <p>①技工所を選択してください</p>
            <select name="laboratory">
               <option value="none">--- 技工所を選択してください ---</option>
               <option value="A">A技工所</option>
               <option value="B">B技工所</option>
               <option value="C">C技工所</option>
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
            <div class="lr_teeth"> -->

   <!-- </div>
            <div class="ll_teeth">

            </div>
         </div>
         <div class="picture">
            <input type="file" name="upfile" accept="image/*" capture="camera">
         </div> -->
   <!-- <div>
            <button id="submit">登録</button>
         </div>
      </form>
      <div class="design">
         <canvas id="canvas" width="480" height="430" style="border: solid 1px #000;"></canvas>
      </div>
      <a href="dentist_top.php">もどる</a> -->
   <canvas id="canvas" width="360" height="240"></canvas>


   <div>
      <img id="newImg">
   </div>

   <form>
      <input type="button" value="画像に変換" onclick="chgImg()">
      <button type="button" id="submit">submit</button>
   </form>



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


      function chgImg() {
         var png = canvas.toDataURL();
         document.getElementById("newImg").src = png;
         // return png;
      }



      // let base64 = this.canvas.toDataURL();
      // console.log(base64);

      const fd = new FormData(); 
      fd.append("upload", fd);
      const BASE_URL = "canvas_act.php";

      // //ajax送信
      $('#submit').on('click', function() {

         axios.post(BASE_URL, fd)
            .then(function(response) {
               console.log("response", response);
            })
            .catch(function(error) {
               console.log(error);
            });
      });
   </script>
</body>

</html>
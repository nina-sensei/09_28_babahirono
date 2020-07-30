<?php
session_start();
include("../functions.php");
check_session_id();

$id = $_SESSION["id"];

?>

<!DOCTYPE html>
<html lang="ja">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>技工所登録</title>
</head>

<body>
   <form action="lab_resister_act.php" method="POST">
      <fieldset>
         <h1>技工所登録</h1>
         <a href="dentist_top.php">戻る</a>
         <input type="hidden" name="id" value="<?= $id ?>">
         <div class="form-item">
            <label for="">技工所名</label>
            <input type="text" name="lab_name" value="">
         </div>
         <div class="form-item">
            <label for="">技工所長名</label>
            <input type="text" name="lab_boss" value="">
         </div>
         <div class="form-item">
            <label for="">住所</label>
            <input type="text" name="lab_address" value="">
         </div>
         <div class=" form-item">
            <label for="">メールアドレス</label>
            <input type="email" name="lab_mail" value="">
         </div>
         <div>
            <button>登録</button>
         </div>
      </fieldset>
   </form>
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

      .form-item {
         margin-bottom: 0.75em;
         width: 100%;
      }

      .form-item input {
         background: #fafafa;
         border: none;
         border-bottom: 2px solid #e9e9e9;
         color: #666;
         font-family: 'Open Sans', sans-serif;
         font-size: 1em;
         height: 50px;
         transition: border-color 0.3s;
      }

      .form-item input:focus {
         border-bottom: 2px solid #c0c0c0;
         outline: none;
      }

      input {
         padding-left: 150px;
      }

      button {
         background: #f16272;
         border: none;
         color: #fff;
         cursor: pointer;
         height: 50px;
         font-family: 'Open Sans', sans-serif;
         font-size: 1.2em;
         letter-spacing: 0.05em;
         text-align: center;
         text-transform: uppercase;
         transition: background 0.3s ease-in-out;
         width: 25%;
         margin-bottom: 20px;
      }

      button:hover {
         background: #ee3e52;
      }
   </style>
</body>

</html>
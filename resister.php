<!DOCTYPE html>
<html lang="ja">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>新規登録</title>
</head>

<body>
   <div class="resister-box">
      <h1>Sign Up</h1>
      <form action="resister_act.php" method="POST">
         <div class="form-item">
            <label for="">お名前</label>
            <input type="text" name="name">
         </div>
         <div class="form-item">
            <label for="">カナ</label>
            <input type="text" name="kana">
         </div>
         <div class="radio-box">
            性別<laber><input type="radio" name="sex" value="0">男</laber>
            <laber><input type="radio" name="sex" value="1">女</laber>
         </div>
         <div class="form-item">
            <label for="">生年月日</label>
            <input type="date" name="birthday">
         </div>
         <div class="form-item">
            <label for="">メールアドレス（ユーザーID）</label>
            <input type="email" name="username">
         </div>
         <div class="form-item">
            <label for="">パスワード</label>
            <input type="password" name="password">
         </div>
         <div class="radio-box">
            選択してください<laber><input type="radio" name="job" value="0">歯科医師</laber>
            <laber><input type="radio" name="job" value="1">技工士</laber>
         </div>
         <div>
            <button>登録</button>
         </div>
      </form>
      <div class="atag">
         <a href="login.php" class="login">ログインはこちら</a>
      </div>
   </div>

   <style>
      @import url(https://fonts.googleapis.com/css?family=Open+Sans:400);

      body {
         display: flex;
         justify-content: center;
         align-items: center;
         height: 900px;
         background: #d4dde1;
         color: #5e5e5e;
         font: 400 87.5%/1.5em 'Open Sans', sans-serif;
      }

      h1 {
         text-align: center;
         padding: 1em 0;
      }

      .resister-box {
         width: 400px;
         height: 800px;
         background: #fafafa;
         margin: 3em auto;
         padding: 0 1em;
         max-width: 370px;
      }

      .form {
         display: flex;
         flex-direction: column;
         justify-content: space-between;
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
         height: 40px;
         transition: border-color 0.3s;
         width: 100%;
      }

      .form-item input:focus {
         border-bottom: 2px solid #c0c0c0;
         outline: none;
      }

      .radio-box {
         height: 60px;
         padding-top: 20px;
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
         width: 100%;
         margin-bottom: 20px;
      }

      button:hover {
         background: #ee3e52;
      }

      .atag {
         text-align: center;
      }

      .login {
         color: #8c8c8c;
         text-decoration: none;
         transition: border-color 0.3s;
      }

      .login:hover {
         border-bottom: 1px dotted #8c8c8c;
      }
   </style>
</body>

</html>
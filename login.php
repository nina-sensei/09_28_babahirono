<!DOCTYPE html>
<html lang="ja">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Sign In</title>
</head>

<body>
   <div class="signin-box">
      <h1>Sign In</h1>
      <form action="login_act.php" method="POST" class="form">
         <div class="form-item">
            <label>ユーザーID（メールアドレス）</label>
            <input type="email" name="username">
         </div>
         <div class="form-item">
            <label>パスワード</label>
            <input type="password" name="password" placeholder="6文字">
         </div>
         <div>
            <button>Sign In</button>
         </div>
      </form>
      <div class="atag">
         <a href="resister.php" class="resister">新規登録はこちら</a>
      </div>
   </div>
   <style>
      @import url(https://fonts.googleapis.com/css?family=Open+Sans:400);

      body {
         display: flex;
         justify-content: center;
         align-items: center;
         height: 700px;
         background: #d4dde1;
         color: #5e5e5e;
         font: 400 87.5%/1.5em 'Open Sans', sans-serif;
      }

      h1 {
         text-align: center;
         padding: 1em 0;
      }

      .signin-box {
         width: 400px;
         height: 400px;

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
         height: 50px;
         transition: border-color 0.3s;
         width: 100%;
      }

      .form-item input:focus {
         border-bottom: 2px solid #c0c0c0;
         outline: none;
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

      .resister {
         color: #8c8c8c;
         text-decoration: none;
         transition: border-color 0.3s;
      }

      .resister:hover {
         border-bottom: 1px dotted #8c8c8c;
      }
   </style>

</body>

</html>
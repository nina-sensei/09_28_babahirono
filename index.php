<!DOCTYPE html>
<html lang="ja">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="product.css">
   <title>Document</title>
</head>

<body>
   <header>
      <nav>
         <a href="">HOME</a>
         <a href="">ABOUT</a>
         <a href="">SERVICE</a>
         <a href="">NEWS</a>
         <a href="">HELP</a>
         <a href="">CONTACT</a>
         <a href="login.php">SIGN IN</a>
      </nav>
   </header>

   <main>
      <div class="top-img">
         <img src="sp_bnr_img001.png" alt="" width="600px">
      </div>
      <h1>キャッチコピー募集</h1>

      <div class="about">

      </div>

      <div class="service">

      </div>

      <div class="news">

      </div>

      <div class="help">

      </div>

      <div class="contact">
         <div class="contact-text">
            <h2 class="text black" id="contact">CONTACT</h2>
            <p>お問い合わせ</p>
         </div>
         <form class="form" action="" method="POST">
            <div class="item">
               <label for="name">名前</label>
               <input id="name" type="text" name="name" value="">
            </div>
            <div class="item">
               <label for="kana">カナ</label>
               <input id="kana" type="text" name="kana" value="">
            </div>
            <div class="item">
               <label for="mail">メールアドレス</label>
               <input id="mail" type="text" name="mail" value="">
            </div>
            <div class="item">
               <p>志望動機</p>
               <div class="item-doki">
                  <div>
                     <input id="doki" type="checkbox" name="doki" value="起業">
                     <label for="doki">起業をしたい</label>
                  </div>
                  <div>
                     <input id="doki" type="checkbox" name="doki" value="就職">
                     <label for="doki"> チーズ系企業に就職・転職したい</label>
                  </div>
                  <div>
                     <input id="doki" type="checkbox" name="doki" value="仕事">
                     <label for="doki">チーズと関わる仕事をしており、仕事に生かしたい</label>
                  </div>
                  <div>
                     <input id="doki" type="checkbox" name="doki" value="教養">
                     <label for="doki">チーズの教養を身につけたい</label>
                  </div>
               </div>
            </div>
            <div class="item">
               <label for="detail">詳細</label>
               <textarea name="detail" id="detail" rows="" cols=""></textarea>
            </div>
            <div class="item-btn">
               <button>送信</button>
            </div>
         </form>
      </div>
   </main>

   <footer>
      <p>08kadai Hirono Baba</p>
   </footer>
</body>

</html>
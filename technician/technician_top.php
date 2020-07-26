<?php
session_start();
include("functions.php");
check_session_id();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>技工士top</title>
</head>

<body>
   <h1>技工士top</h1>
   <p>こんにちは！<?= $_SESSION["name"] ?>さん</p>
   <a href="mypage.php">My page</a>
   <a href="logout.php">Sign out</a>
</body>

</html>
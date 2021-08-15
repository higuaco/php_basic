<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>PHP基礎</title>
  <link rel="icon" href="favicon.ico">
  <meta name="viewport"
    content="width=device-width,initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <?php
  // データベースに接続
  $dsn = 'mysql:dbname=phpkiso;host=localhost';
  $user = 'root';
  $password = 'root';
  $dbh = new PDO($dsn,$user,$password);
  $dbh -> query('SET NAMES UTF-8');

  $nickname=$_POST['nickname'];
  $email=$_POST['email'];
  $goiken=$_POST['goiken'];

  $nickname=htmlspecialchars($nickname);
  $email=htmlspecialchars($email);
  $goiken=htmlspecialchars($goiken);

  echo $nickname;
  echo '様<br />';
  echo 'ご意見ありがとうございました<br />';
  echo '頂いたご意見『';
  echo $goiken;
  echo '』<br />';
  echo $email;
  echo 'にメールを送りましたのでご確認ください。';

  $mail_sub='アンケート受け付けました';
  $mail_body=$nickname."様へ/nアンケートご協力ありがとうございました。";
  $mail_body=html_entity_decode($mail_body,ENT_QUOTES,"UTF-8");
  $mail_head='From: xxx@xxx.co.jp';
  mb_language('Japanese');
  mb_internal_encoding("UTF-8");
  mb_send_mail($email,$mail_sub,$mail_body,$mail_head);
// データベースに指令を出す
  $sql = 'INSERT INTO anketo (nickname,email,goiken) VALUES ("'.$nickname.'","'.$email.'","'.$goiken.'")';
  $stmt = $dbh->prepare($sql);
  $stmt -> execute();
// データベース切断
  $dbh = null;


  ?>
  <br />
  <input type="button" onclick="location.href='../php_basic/index.html' " value="入力画面に戻る">

</body>

</html>
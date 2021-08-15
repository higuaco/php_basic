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
  <!-- 接続 -->
  <?php
    $dsn = 'mysql:dbname=phpkiso;host=localhost';
    $user = 'root';
    $password = 'root';
    $dbh = new PDO ($dsn,$user,$password);
    $dbh ->query('SET NAMES UTF-8');

    // 指令
    $sql = 'SELECT*FROM anketo WHERE 1';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    while(1){
      $rec=$stmt->fetch(PDO::FETCH_ASSOC);
      if($rec==false){
        break;
      }
      echo $rec['code'];
      echo $rec['nickname'];
      echo $rec['email'];
      echo $rec['goiken'];
      echo '<br />';
    }

    // 切断
    $dbh = null;

  ?>

  <br />
  <a href="menu.html">メニューに戻る</a>
</body>

</html>
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

  try{


    $code=$_POST['code'];

    $dsn = 'mysql:dbname=phpkiso;host=localhost';
    $user = 'root';
    $password = 'root';
    $dbh = new PDO ($dsn,$user,$password);
    $dbh ->query('SET NAMES UTF-8');

    // 指令
    $sql = 'SELECT*FROM anketo WHERE code=?';
    $stmt = $dbh->prepare($sql);
    $data[]=$code;
    $stmt->execute($data);

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
  }catch(Exception $e){
    echo 'ただいま障害により大変ご迷惑をお掛けしております。';

  }

  ?>
  <br />
  <a href="kensaku.html">検索画面に戻る</a>

</body>

</html>
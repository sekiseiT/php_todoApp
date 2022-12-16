<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8" >
  <title>TODOリスト</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
 
<?php
 
  mb_internal_encoding("UTF-8");
 
  session_start();
 
  include "db_connect.php";
  doDB();
 
  $name = htmlspecialchars($_SESSION["name"], ENT_QUOTES, "UTF-8");
  $message = htmlspecialchars($_SESSION["message"], ENT_QUOTES, "UTF-8");
  $period = htmlspecialchars($_SESSION["period"], ENT_QUOTES, "UTF-8");
  $thread = $_SESSION["thread"];
  $priority = $_SESSION["priority"];
 
  $sql = "insert into discussion (name, message, period, thread, priority)
            values ('$name', '$message', '$period', '$thread', '$priority')";
  $query = mysqli_query($mysqli, $sql) or die("fail");
 
  $_SESSION = array();
  session_destroy();
 
  mysqli_close($mysqli);
 
?>
 
<p>追加完了画面</p>
<table border="1">
  <tr>
    <td>スケジュール番号</td>
    <td><?php echo $thread; ?></td>
  </tr>
  <tr>
    <td>名前</td>
    <td><?php echo $name; ?></td>
  </tr>
  <tr>
    <td>内容</td>
    <td><?php echo nl2br($message); ?></td>
  </tr>
  <tr>
    <td>期限</td>
    <td><?php echo $period; ?></td>
  </tr>
</table>
<p><a href="enter.php?thread=<?php echo $thread ?>">タスク入力欄へ</a></p>
<p><a href="top.php">トップページへ</a></p>
</body>
</html>
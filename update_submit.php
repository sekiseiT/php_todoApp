<!DOCUTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>TODOリスト</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>



<?php
	mb_internal_encoding("UTF-8");
    session_start();
    include "db_connect.php";
    doDB();
    
    $id = $_SESSION["id"];
    $name = htmlspecialchars($_SESSION["name"], ENT_QUOTES,"UTF-8");
    $period = htmlspecialchars($_SESSION["period"], ENT_QUOTES,"UTF-8");
	$message = htmlspecialchars($_SESSION["message"], ENT_QUOTES, "UTF-8");
    $sql = "update discussion set name='$name', message='$message', period='$period' where (id='$id')";
    $query = mysqli_query($mysqli,$sql) or die("fail update");
    
    $sql = "select * from discussion where (id='$id')";
    $query = mysqli_query($mysqli,$sql) or die("fail 1");
    $data = mysqli_fetch_array($query) or die("fail array");
    
    $_SESSION = array();
    session_destroy();
    mysqli_close($mysqli);
    
?>
    
<p>変更完了画面</p>
<table border="1">
  <tr>
    <td>タスク名</td>
    <td><?php echo $name; ?></td>
  </tr>
  <tr>
      <td>期限</td>
      <td><?php echo $data["period"]; ?></td>
  </tr>
  <tr>
    <td>更新日時</td>
    <td><?php echo $data["modified"]; ?></td>
  </tr>
  <tr>
    <td>メッセージ</td>
    <td><?php echo nl2br($message); ?></td>
  </tr>
</table>
<p><a href="top.php">トップページへ</a></p>
</body>
</html>
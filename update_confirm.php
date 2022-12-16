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
    $name = htmlspecialchars(str_replace(" ", "", $_POST["name"]), ENT_QUOTES,"UTF-8");
	$message = htmlspecialchars($_POST["message"], ENT_QUOTES, "UTF-8");
	$period = htmlspecialchars($_POST["period"], ENT_QUOTES, "UTF-8");
    include "db_connect.php";
    doDB();
    $id = $_SESSION["id"];
    
    $sql = "select * from discussion where(id='$id')";
    $query = mysqli_query($mysqli,$sql) or die("fail 1");
    $data = mysqli_fetch_array($query);
    
    $_SESSION["name"] = $name;
    $_SESSION["message"] = $message;
    $_SESSION["period"] = $period;

    mysqli_close($mysqli);
?>
<p>変更確認画面</p>
<form method="POST" action="update_submit.php">
  <h3>変更後</h3>
  <table border="1">
    <tr>
      <td>タスク名</td>
      <td><?php echo $name; ?></td>
    </tr>
    <tr>
      <td>期限</td>
      <td><?php echo $period; ?></td>
    </tr>
    <tr>
      <td>メッセージ</td>
      <td><?php echo nl2br($message); ?></td>
    </tr>
    <tr>
      <td colspan="2">
      <input type="submit" value="変更する">
      </td>
    </tr>
  </table>
  <h3>変更前</h3>
  <table border="1">
    <tr>
      <td>タスク名</td>
      <td><?php echo $data["name"]; ?></td>
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
      <td><?php echo $data["message"]; ?></td>
    </tr>
    
  </table>
</form>
</body>
</html>
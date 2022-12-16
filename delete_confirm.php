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
    $id = $_SESSION["id"];
    
    include "db_connect.php";
    doDB();
    
    
    $sql = "select * from discussion where(id='$id')";
    $query = mysqli_query($mysqli,$sql) or die("fail 1");
    $data = mysqli_fetch_array($query);
    
    mysqli_close($mysqli);
?>
<h1>以下のタスクを消去します。間違いのないように確認をしたうえで削除してください。</h1>
<p>削除確認画面</p>
<form method="POST" action="delete_submit.php">
  <table border="1">
    <tr>
      <td>名前</td>
      <td><?php echo $data["name"]; ?></td>
    </tr>
    <tr>
      <td>メッセージ</td>
      <td><?php echo nl2br($data["message"]); ?></td>
    </tr>
    <tr>
      <td>期限</td>
      <td><?php echo $data["period"]; ?></td>
    </tr>
    <tr>
      <td colspan="2">
        <input type="submit" value="削除する">
      </td>
    </tr>
  </table>
</form>
</body>
</html>
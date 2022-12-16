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
    $thread = $_SESSION["thread"];
    
    include "db_connect.php";
    doDB();
    
    
    $sql = "select * from agenda where(thread='$thread')";
    $query = mysqli_query($mysqli,$sql) or die("fail 1");
    $data = mysqli_fetch_array($query);
    
    mysqli_close($mysqli);
?>
<p style="color: red;">本当に削除しますか</p>
<form method="POST" action="delplan_submit.php">
  <table border="1">
    <tr>
      <td>thread</td>
      <td><?php echo $data["thread"]; ?></td>
    </tr>
    <tr>
      <td>title</td>
      <td><?php echo nl2br($data["title"]); ?></td>
    </tr>
    <tr>
    <tr>
      <td>created</td>
      <td><?php echo nl2br($data["created"]); ?></td>
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
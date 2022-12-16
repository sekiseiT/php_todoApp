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
    if(isset($_GET["id"])){
        $id=$_GET["id"];
        $_SESSION["id"] = $id;
    }else{
        exit;
    }
    //ファイルの読み込み
    include "db_connect.php";
    doDB();
    $sql = "select * from discussion where(id='$id')";
    $query = mysqli_query($mysqli,$sql) or die("fail");
    $data = mysqli_fetch_array($query);
?>
<p>編集画面</p>
<form method="POST" action="update_confirm.php">
  <table border="1">
    <tr>
      <td>タスク名</td>
      <td><input type="text" name="name" size="30"
                  value="<?php echo $data["name"]; ?>">
      </td>
    </tr>
    <tr>
      <td>期限</td>
      <td><input type="date" name="period"></td>
    </tr>
    <tr>
      <td>メッセージ</td>
      <td><textarea rows="8" cols="40"
                    name="message"><?php echo $data["message"]; ?></textarea>
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <input type="submit" value="確認する">
      </td>
    </tr>
  </table>
</form>
</body>
</html>
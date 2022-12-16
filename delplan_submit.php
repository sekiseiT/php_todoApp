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
    $thread = $_SESSION["thread"];
    
    $sql = "delete from agenda where thread='$thread'";
    $query = mysqli_query($mysqli,$sql) or die("$idデータを削除できませんでした");
    $sql = "delete from discussion where thread='$thread'";
    $query = mysqli_query($mysqli,$sql) or die("$idデータを削除できませんでした");
    $message = "スケジュールとタスクを削除しました<br>";
    
    $_SESSION = array();
    session_destroy();
    mysqli_close($mysqli);
    
?>
    
<p>削除完了画面</p>
<p><?php echo $message; ?></p>
<p><a href="top.php">トップページへ</a></p>
</body>
</html>
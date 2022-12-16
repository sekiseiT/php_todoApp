<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8" >
  <title>TODOリスト</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
<h1>TODOリスト作成</h1>


スケジュールの題名<br>
  
</header>
  <h2>タイトル作成</h2>
<div class="input-form">
    
  <form method="GET" action="top.php">
    新しいタイトルを入力してください<br>
    <input type="text" name="title" size="50">
    <br><br>
    <input type="submit" value="スケジュール作成" >
  </form>
</div>

<h2>スケジュール一覧</h2>

<div class="plan title">

<?php
 
  mb_internal_encoding("UTF-8");
 
  include "db_connect.php";
  doDB();
 
  if(isset($_GET["title"])){
    $title= htmlspecialchars($_GET["title"], ENT_QUOTES, "UTF-8");
  }

  if(isset($_POST["done"])){
    $thread = $_POST["done"];
    $query = mysqli_query($mysqli, "update agenda set done=0 where thread=$thread ")
              or die("完了の変更に失敗しました");
  }
  if(isset($_POST["yet"])){
    $thread = $_POST["yet"];
    $query = mysqli_query($mysqli, "update agenda set done=1 where thread=$thread ")
              or die("未完了の変更に失敗しました");
  }


 
  $query = mysqli_query($mysqli, "select * from agenda")
             or die("検索に失敗しました");
  $flag = 0;
  while($data =mysqli_fetch_array($query)){
    if(!empty($title) and strcmp($data["title"], $title) == 0){
      echo "すでにスレッド番号" . $data["thread"] .
        "で同名のタイトルが存在します。<br>同名のスレッドは作成できません。";
      $flag = 1;
    }
  }
  if($flag == 0 and !empty($title)){
    $query = mysqli_query($mysqli, "insert into agenda(title, created)
                                  values ('$title', now())")
              or die("スレッドの作成に失敗しました");
  }
 
  $query = mysqli_query($mysqli, "select * from agenda where done=1 order by thread desc")
  or die("検索に失敗しました");
  while($data = mysqli_fetch_array($query)){
    echo "<div class=\"container"."\">";
      echo "<a href=\"enter.php?thread=" . $data["thread"] . "\"> ";
      echo $data["thread"] . ":" . $data["title"] . "</a>";
      echo "(" . date("Y/m/d H:i", strtotime($data["created"])) . "作成)" ;
      echo "<a href=\"delplan.php?thread=" .$data["thread"]. "\">削除</a> ";

      echo "<form method=\"POST"."\" action= \"top.php"."\" >";
    
      echo  "<button type=\"submit"."\" value=" .$data["thread"]. "  name=\"done" . "\" >完了にする</button>";
      echo "</form>";
    echo "</div>";
  }


  echo "</div>";

  echo "<h2>終了した項目</h2>";
  
  echo "<div class=\"plan title" ."\">";
 

  $query = mysqli_query($mysqli, "select * from agenda where done=0 order by thread desc")
  or die("検索に失敗しました");
  while($data = mysqli_fetch_array($query)){
    echo "<div class=\"container"."\">"; 
    echo "<a href=\"enter.php?thread=" . $data["thread"] . "\"> ";
    echo $data["thread"] . ":" . $data["title"] . "</a>";
    echo "(" . date("Y/m/d H:i", strtotime($data["created"])) . "作成)" ;
    echo "<a href=\"delplan.php?thread=" .$data["thread"]. "\">削除</a> ";

    echo "<form method=\"POST"."\" action= \"top.php"."\" >";
    echo  "<button type=\"submit"."\" value=" .$data["thread"]. "  name=\"yet" . "\" >未完了にする</button>";
    echo "</form>";
    echo "</div>";
  }
  
  mysqli_close($mysqli);
  
  echo "</div>";
?>
 


</body>
</html>
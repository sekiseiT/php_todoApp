<!DOCTYPE html>
<html lang="ja">
<head>
  <title>TODOリスト</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <h1>
      <?php 
        mb_internal_encoding("UTF-8");
        session_start();
        $thread = $_GET["thread"];
        
        echo $thread . ":" ; 
      ?>
      タスク一覧
    </h1>
    <a href="top.php">タイトル入力ページへ戻る</a>
  </header>
<hr>
<b>日程、メモ、スケジュール詳細等を記入してください</b><br>
<form method="POST" action="enter_confirm.php">
  <table border="1">
    <tr>
      <td>タスク名</td>
      <td><input type="text" name="name" size="30"></td>
    </tr>
    <tr>
      <td>内容</td>
      <td>
      <textarea rows="8" cols="40" name="message"></textarea>
      </td>
    </tr>
    <tr>
      <td>期限</td>
      <td><input type="date" name="period"></td>
    </tr>
    <!-- <tr>
      <td>パスワード</td>
      <td><input type="text" name="passwd" size="4"></td>
    </tr> -->
    <tr>
      <td>優先度</td>
      <td>
        <form method="$_POST">
          <select name="priority">
            <option value="5">最高</option>
            <option value="4">高</option>
            <option value="3">中</option>
            <option value="2">低</option>
            <option value="1">後回し</option>
          </select>
        </form>
      </td>
    </tr>
    <tr>
      <td colspan="2">
      <input type="submit" value="確認する">
      </td>
    </tr>
  </table>
</form>

<div>
    <form method="POST" action="" >
      <select name="sort">
        <option value="modified desc">登録日 降順</option>
        <option value="modified asc">登録日 昇順</option>
        <option value="period desc">期限 降順</option>
        <option value="period asc">期限 昇順</option>
        <option value="priority desc">重要度 降順</option>
        <option value="priority asc">重要度 昇順</option>
      </select>
      <input type="submit" value="並び順を変更">
    </form>
</div>



<table>
  <p>終わったタスクのリスト</p>
</table>
<?php
  	// mb_internal_encoding("UTF-8");
    // session_start();
    // $thread = $_GET["thread"];
    
    if(isset($_POST["sort"])){
      $sort= htmlspecialchars($_POST["sort"], ENT_QUOTES, "UTF-8");
    }
    else {
      $sort= 'priority desc';
    }

    echo "sorted by : " .$sort;
    
    $_SESSION["sort"]=$sort;
    $_SESSION["thread"]=$thread;
    include "db_connect.php";
    doDB();

    
    $query = mysqli_query($mysqli, "select * from discussion where thread='$thread' order by $sort")
    or die("検索に失敗しました。 ");

    while($data = mysqli_fetch_array($query)){
        echo "<br><hr>{$data["id"]} : ";
        echo $data["name"];
        echo "  期限:" .date("Y/m/d", strtotime($data["period"])). "";
        echo "  (作成日:" .date("Y/m/d H:i", strtotime($data["modified"])). ")";

        switch($data["priority"]) {
          case 5:
            echo "  重要度: Top";
            break;
          case 4:
            echo "  重要度: high";
            break;
          case 3:
            echo "  重要度: middle";
            break;
          case 2:
            echo "  重要度: low";
            break;
          case 1:
            echo "  重要度: later";
            break;

        }
        
        if(mb_strlen($data["message"]) >= 40){
            echo "<p>" .nl2br(mb_substr($data["message"],0,40))
                .'<font color="blue">・・・続きは[詳細]をクリック</font>'
                ."</p>";
            
        }else {
            echo "<p>" .nl2br(mb_substr($data["message"],0,40))."<p>";
        }
        
        echo "<a href=\"update.php?id=" .$data["id"]. "\">編集</a> ";
        echo "<a href=\"delete.php?id=" .$data["id"]. "\">削除</a> ";
        echo "<a href=\"detail.php?id=" .$data["id"]. "\">詳細</a> ";
    }
    mysqli_close($mysqli);
?>
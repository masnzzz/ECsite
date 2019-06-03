<?php

//共通変数・関数ファイルを読み込み
require('function.php');

debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debug('「　退会ページ　');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debugLogStart();

//ログイン認証
require('auth.php');

//================================
// 画面処理
//================================
// post送信されていた場合
if(!empty($_POST)){
    debug('POST送信があります');
    //例外処理
    try{
        //DB接続
        $dbh = dbConnect();
        //SQL文作成
        $sql1 = 'UPDATE users SET delete_flg = 1 WHERE id = :us_id';
        $sql2 = 'UPDATE product SET delete_flg = 1 WHERE user_id = :us_id';
        $sql3 = 'UPDATE "like" SET delete_flg = 1 WHERE user_id = :us_id';
        //データ流し込み
        $data = array(':us_id' => $_SESSION['user_id']);
        //クエリ実行
        $stmt1 = queryPost($dbh, $sql1, $data);
        $stmt2 = queryPost($dbh, $sql2, $data);
        $stmt3 = queryPost($dbh, $sql3, $data);

        //クエリ実行成功の場合
        if($stmt1){
            //セッション削除
            session_destroy();
            debug('セッション変数の中身：'.print_r($_SESSION,true));
            debug('トップページへ遷移します');
            header("Location:index.php");
        }else{
            debug('クエリが失敗しました');
            $err_msg['common'] = MSG07;
        }

    }catch(Exception $e){
        error_log('エラー発生：' . $e->getMessage());
        $err_msg['common'] = MSG07;
    }
}
debug('画面表示処理終了 <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<');

?>

<?php
$title = '退会';
require('head.php');
?>

<body class="page-withdraw page-1colum">

    <style>
      .form .btn{
        float: none;
      }
      .form{
        text-align: center;
      }
    </style>

<!-- メニュー -->
<?php
require('header.php'); 
?>

<!-- メインコンテンツ -->
<div id="contents" class="site-width">
    <!-- Main -->
    <section id="main">
        <div class="form-container">
            <form action="" class="form" method="post">
                <h2 class="title"><?php echo $title ?></h2>
                <div class="area-msg">
                    <?php if(!empty($err_msg['common'])) echo $err_msg['common']; ?>
                </div>
                <div class="btn-container">
                    <input type="submit" class="btn btn-mid" name="submit" value="退会する">
                </div>
            </form>
        </div>
        <a href="mypage.php">&lt; マイページへ戻る</a>
    </section>
</div>


<!-- footer -->
<?php
require('footer.php'); 
?>
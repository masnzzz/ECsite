<?php
//共通変更・関数ファイルを読み込み
require('function.php');

debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debug('「　ログアウトページ　');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debugLogStart();

debug('ログアウトします');
//セッションを削除（ログアウトする）
session_destroy();
debug('ログインページへ遷移します');
//ログインページへ
header("Location:login.php");
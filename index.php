<?php
    session_name('isAuth');
    session_start();
    define('JQUERY',1);
    require_once "lib/functions.php";
    require_once "lib/gb.php";

    $gb=new GB();

    $action=trim($_SERVER['QUERY_STRING'], '/');

    if($action==!''&&isset($_POST)){
       if (method_exists($gb, $action)) {
           $gb->load($_POST);
           $gb->$action();
           $gb->view();
           die;
       }
       else{
                throw new \Exception("Метод <b>Gb::$action</b> не найден", 404);
       }
    }
?>
<!doctype html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GuestBook</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
    <link rel="stylesheet" type="text/css" href="css/toggle-buttons.css">
    <link rel="stylesheet" type="text/css" href="css/gb.css">
</head>
<?php if(JQUERY):?>
    <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous">

    </script>
<?php endif?>
<body>
<div class="wrap">
    <div class="mode">
        <div class="mode-header">Режим</div>
        <div class="toggle-btn" id="_2nd-toggle-btn">
            <input type="checkbox" class="mode-checkbox">
            <span></span>
        </div>
    </div>

<!--    <form id="formAdd" action="/add" method="POST">-->
    <form id="formAdd" action="/add">
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input" type="text" id="inputName"  required name="name">
            <label class="mdl-textfield__label" for="inputName">Name...</label>
        </div>

        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input"  type="text" id="inputMessage"  required name="message">
            <label class="mdl-textfield__label" for="inputMessage">Message...</label>
        </div>
        <button type="submit" class="mdl-button mdl-js-button mdl-button--primary" id="btn-add">Отправить</button>
    </form>

    <div id="errors">

    </div>

    <div id="wrap-message">
          <?php $gb->view();?>
    </div>
</div>

<script src="js/gb.js"></script>
    <?php if(JQUERY):?>
        <script src="js/ajax_jq.js"></script>
    <?php else: ?>
        <script src="js/ajax_js.js"></script>
    <?php endif?>

<script src="https://code.getmdl.io/1.3.0/material.min.js"></script>

</body>
</html>

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

<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="gb.css">

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
            <a href="/" class="mode_user">Режим пользователя</a>
            <a href="/" class="mode_admin">Режим администратора</a>
        </div>
        <form id="form-add" action="/add" method="POST">
            <div class="form-group">
                <label for="name">Имя</label>
                <input type="text" class="form-control" placeholder="Имя" id="name" name="name">
            </div>
            <div class="form-group">
                <label for="message">Сообщение</label>
                <input type="text" class="form-control" placeholder="Сообщение" id="messageAdd" name="message">
            </div>
            <button type="submit" class="btn" id="btn-add">Отправить</button>
        </form>

        <div id="errors">

        </div>

        <div id="view-message">
            <?php $gb->view();?>
        </div>
    </div>

    <script src="gb.js"></script>
    <?php if(JQUERY):?>
        <script src="ajax_jq.js"></script>
    <?php else: ?>
        <script src="ajax_js.js"></script>
    <?php endif?>

</body>
</html>










<?php
require_once 'Db.php';
class GB
{
    private $table='gb';
    private $db;
    private $attr=[
            'id'=>"",
            'name'=>"",
            'message'=>"",
            'answer'=>null,
    ];

    function __construct()
    {
        $this->db=new Db();
    }

    public function load($data)
    {
        foreach ($this->attr as $name=>$value){
            if(isset($data[$name])){
                $this->attr[$name]=$data[$name];
            }
        }
    }

    function add(){
        $this->db->setFields($this->attr,$this->table);
    }

    function addAnswer(){
        $this->db->updateById($this->attr,$this->table);
    }

    function del(){
        $this->db->delById($this->table,$this->attr['id']);
    }

    function view(){
        $records=$this->db->getAll($this->table,'DESC'); //ASC DESC
        foreach ($records as $record):
        ?>
            <div class="view-wrap">
                <?php if (session_id()=='true'):?>

                    <div class="view-id">id=<?=$record->id ?>
                    <?php if (session_id()=='true'):?>
                        <form  class="form-del " action="/del" method="POST" name="delete">
                            <input type="hidden" id="userId" name="id" value="<?=$record->id?>">
                            <button type="submit" class="btn-del">Удалить</button>
                        </form>
                    <?php endif;?>
                    </div>

                <?php endif;?>

                <div class="view-name"><?=$record->name ?></div>

                <div class="view-message"><?=$record->message ?></div>


                <?php if (session_id()=='true'):?>
                    <?php if (is_null($record->answer)):?>
                        <form class="form-answer" action="/addAnswer" method="POST">
                            <input type="hidden" id="userId" name="id" value="<?=$record->id?>">
                            <input type="text" class="form-control" placeholder="Ответ" id="messageAnswer" value="" name="answer">
                            <button type="submit" class="btn">Ответить</button>
                        </form>
                    <?php endif;?>

                <?php endif;?>

                <?php if (!is_null($record->answer)):?>
                    <div class="view-answer-wrap">
                        <div class="view-name">Админ</div>
                        <div class="view-message"><?=$record->answer ?> </div>
                    </div>
                <?php endif;?>
            </div>
        <?php endforeach;
    }
}
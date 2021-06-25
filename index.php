<?php
require_once 'engine.php';
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>  
    </head>
    <body>
        <?php 
            if(empty($_GET['userNum'])){
        ?>
            <div>
                Загадайте двухзначное число<br>
                <form action="/" method="GET">
                    <input type="submit" name="send" value="OK">
                </form>
            </div>
            <br>
        <?php
        if (!empty($_GET['send']) AND !empty($psychArr)) { //если пользователь нажал кнопку ок
                foreach($psychArr as $k=>$v){
                    ?>
                        <div> 3кстрасенс <?=$k?> предсказывает: <span><?= $v ?></span></div>
                        <br>    
                    <?php
                }
            ?>
            <hr>
            <div>
                Введите загаданное число чтобы усзнать уровень достоверности экстрасенсов:
                <form action="/" method="GET">
                    <input type="text" value='' name='userNum' palceholder='введите число' minlength="2" maxlength="2">
                    <input type="submit" name="sendUserNum" value="OK">
                </form>
            </div>
            <?php
        }
        ?>
            
        <?php
        }else{
            ?>
            <table border="1">
                    <thead>
                        <tr>
                            <th>Имя экстрасенса</th>
                            <th>Достоверность</th>
                            <th>История экстрасенса</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                foreach($_SESSION['psychics'] as $k=>$psych){
                                    ?>
                                    <tr>
                                        <td>Экстрасенс <?=$k?></td>
                                        <td><?=$psych['rating']?></td>
                                        <td>
                                            <?php
                                                foreach($psych['story'] as $k=>$v){
                                                    ?>
                                                     <?=$v?><br>
                                                    <?php
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            ?>
                        
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            <div>Ваши ранее загаданные цифры: <span><?php
                foreach($_SESSION['user']['userNumStory'] as $userNum){
                    ?>
                        <?=$userNum?>&nbsp;
                    <?php
                }
            ?></span></div>
            <br>
            <a href="/">Попробовать еще раз?</a>
            <?php
        }
    ?>
    </body>
</html> 

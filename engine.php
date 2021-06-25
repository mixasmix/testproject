<?php
   
   //стартуем сессию
   session_start();
   //session_destroy();
   
class Psychic{
    public $guess; //тут храним догадку
    public function __construct() {
        $this->guess();
    }
    //метод выводит "догадку"
    private function guess(){
        $this->guess=rand(10, 99);
    } 
} 


$maxPsychos=2;
$psychArr=[]; //пустой массив где будем хранить экстрасенсов
//если пользователь загадал число и нажал кнопку ОК генерируем предсказания
if(!empty($_GET['send'])){
    //количство экстрасенсов
    for($i=1; $i<=$maxPsychos; $i++){
       $psychic =new Psychic();
       $psychArr[$i]=$psychic->guess;
       //и сохраняем текущее предсказание в сессию
       $_SESSION['psychics'][$i]['this']=$psychic->guess;
       // и в историю
       $_SESSION['psychics'][$i]['story'][]=$psychic->guess;
    }
}
if(!empty($_GET['userNum'])){
    //записываем пользовательский ввод для истории
    $_SESSION['user']['userNumStory'][]=$_GET['userNum'];
    //пробегаемся по массиву экстрасенсов
   
    foreach($_SESSION['psychics'] as $k=>$psych){
        if(isset($_SESSION['psychics'][$k]['rating'])){
        //индусский код через тернарный оператор
        $_SESSION['psychics'][$k]['rating']=
                ($psych['this']==$_GET['userNum'])?            //если цифры совпали
                    $_SESSION['psychics'][$k]['rating']+1       //увеличиваем рейтинг
                        :
                    $_SESSION['psychics'][$k]['rating']-1;      //уменьшаем рейтинг
    
        }else{
            $_SESSION['psychics'][$k]['rating']=0;
        }
     }
}

<?php
// PHP7/HTML5, EDGE/CHROME                             *** DoorTryError.php ***
// ****************************************************************************
// * doortry.ru      Разобрать параметры запроса и вывести страницу с ошибкой *
// ****************************************************************************

//                                                   Автор:       Труфанов В.Е.
//                                                   Дата создания:  09.04.2019
// Copyright © 2019 tve                              Посл.изменение: 17.02.2020

// ------------------------------------------ Используемые регулярные выражения
// "префикс ошибки" с начала строки
define ("regPrefix",      "/^\[[A-Za-z_А-Яа-яЁё\s()]{1,}\]/u");

// ****************************************************************************
// *    Выбрать из строки подстроку, соответствующую регулярному выражению    *  
// ****************************************************************************
function findes($preg,$string,&$point=0)
{
   $findes='';
   $value=preg_match($preg,$string,$matches,PREG_OFFSET_CAPTURE);
   if ($value>0)
   {
      $findes=$matches[0][0];
      $point=$matches[0][1];
   }
   return $findes;
}
// ****************************************************************************
// *                     Вывести сообщение об ошибке/исключении               *
// ****************************************************************************
function DoorTryMessage($ierrstr,$errtype,$errline='',$errfile='',$errtrace='')
{
   $errstr=$ierrstr;
   // Добавляем префикс "PHP", если он отсутствует
   $Prefix=findes(regPrefix,$errstr,$point);
   if ($Prefix=='') $errstr='[PHP] '.$ierrstr;
   // Выводим сообщение об ошибке/исключении
   echo '<div style="border-style:inset; border-width:2">';
   echo "<pre>";
   echo "<b>".$errstr."</b><br><br>";
   echo "File: ".$errfile."<br>";
   echo "Line: ".$errline."<br><br>";
   echo $errtype."<br>";
   if (!($errtrace=='')) {echo $errtrace."<br>";}
   echo "</pre>";
   echo "</div>";
}

$errstr='';    
if (IsSet($_GET['estr'])) 
{
   $errstr=urldecode($_GET['estr']);
}
$errtype='';    
if (IsSet($_GET['etype'])) 
{
   $errtype=urldecode($_GET['etype']);
}
$errline='';    
if (IsSet($_GET['eline'])) 
{
   $errline=urldecode($_GET['eline']);
}
$errfile='';    
if (IsSet($_GET['efile'])) 
{
   $errfile=urldecode($_GET['efile']);
}
$errtrace='';    
if (IsSet($_GET['etrace'])) 
{
   $errtrace=urldecode($_GET['etrace']);
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
   <title>Обработчик ошибок и исключений</title>
   <meta charset="utf-8">
   <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
   <meta name="viewport" content="width=device-width"> 
   <meta name="description" content="DoorTry - обработчик ошибок и исключений">
   <meta name="keywords" content="DoorTry - обработчик ошибок и исключений">
   <!-- 
   <link href="Styles/Styles.css" rel="stylesheet">
   -->
</head>
<body>
<?php
DoorTryMessage($errstr,$errtype,$errline,$errfile,$errtrace);
?>
</body> 
</html>
<?php
// ******************************************************* DoorTryError.php ***

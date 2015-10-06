<?php

if ($_GET['create']){

  $starBirth = "";
  $starBirth.= $_GET["x_cod"];
  $starBirth.= "_";
  $starBirth.= $_GET["y_cod"];
  $starBirth.= "_";
  $starBirth.= $_GET["starName"];

  $name = "";
  $name.= "/Users/Rudra/Sites/SkyNote/Stella/";
  $name.= $starBirth;
  $name.= ".txt";

  $starBirth.= ",";

  date_default_timezone_set("Europe/London");
  $date = date('d/m/Y_G:i:s');

  $ofile = fopen($name,"w") or die("Unable to open file!");
  fwrite($ofile,"$date");
  fclose($ofile);

  $ofile = fopen("/Users/Rudra/Sites/SkyNote/Stella/all_Stars.txt","a") or die("Unable to open file!");
  fwrite($ofile,$starBirth);
  fclose($ofile);


  $previousPage = $_SERVER["HTTP_REFERER"];
  header('Location: '.$previousPage);

}elseif ($_GET['remove']) {

  $starBirth = "";
  $starBirth.= $_GET["x_cod"];
  $starBirth.= "_";
  $starBirth.= $_GET["y_cod"];
  $starBirth.= "_";
  $starBirth.= $_GET["starName"];

  $name = "";
  $name.= "/Users/Rudra/Sites/SkyNote/Stella/";
  $name.= $starBirth;
  $name.= ".txt";

  $starBirth.= ",";

  unlink($name);

  $fread = fopen('/Users/Rudra/Sites/SkyNote/Stella/all_Stars.txt','r');
  $ex = str_replace($starBirth, '', fgets($fread));
  echo $ex;
  fclose($fread);

  $ofile = fopen('/Users/Rudra/Sites/SkyNote/Stella/all_Stars.txt','w');
  fwrite($ofile,$ex);
  fclose($ofile);

  $previousPage = $_SERVER["HTTP_REFERER"];
  header('Location: '.$previousPage);

}elseif ($_GET['save']){

    $starBirth = "";
    $starBirth.= $_GET["x_cod"];
    $starBirth.= "_";
    $starBirth.= $_GET["y_cod"];
    $starBirth.= "_";
    $starBirth.= $_GET["starName"];

    $name = "";
    $name.= "/Users/Rudra/Sites/SkyNote/Stella/";
    $name.= $starBirth;
    $name.= ".txt";

    $ofile = fopen($name,"w") or die("Unable to open file!");
    fwrite($ofile,$_GET["sData"]);
    fclose($ofile);

    $previousPage = $_SERVER["HTTP_REFERER"];
    header('Location: '.$previousPage);

}

/*
The first used for button tags
if(isset($_GET['runFunction']) && function_exists($_GET['runFunction']))
call_user_func($_GET['runFunction']);
else
echo "Function not found or wrong input";

function create(){
  $previousPage = $_SERVER["HTTP_REFERER"];
  header('Location: '.$previousPage);
}

function remove($input){
  //echo "$input[0] + $input[1]";
  $quantity = $_GET["name"];
  $test = $_GET["Lname"];
  echo "$quantity";
  echo "Rudra";

}
*/
?>

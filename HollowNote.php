<!DOCTYPE html>
<html>

<header>
  <link rel="stylesheet" type="text/css" href="Hollow.css" media="screen" />
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"/>
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script type="text/javascript">
  function point_it(event){
  //Get Cordiates
	pos_x = event.offsetX?(event.offsetX):event.pageX-document.getElementById("canves").offsetLeft;
	pos_y = event.offsetY?(event.offsetY):event.pageY-document.getElementById("canves").offsetTop;
	document.getElementById("canves").style.left = (pos_x-1) ;
	document.getElementById("canves").style.top = (pos_y-15) ;
	document.getElementById("canves").style.visibility = "visible" ;

  console.log("X:",pos_x, "|| Y:" ,pos_y);

  //Add new Div onclick
  var ok = true;

  if (ok === true) {
    var div = document.createElement('div');
    pos_x = pos_x - 5;
    pos_y = pos_y - 5;

    var mainCord = (pos_x +"_" + pos_y);
    //console.log(mainCord);

    div.className = "setBox";
    div.id = mainCord;
    div.style.left = pos_x + "px";
    div.style.top =  pos_y+"px";
    div.onclick = star;

    document.getElementById("holder").appendChild(div);

    //Set Data Menu
    //document.getElementById("x-cod").value = pos_x;
    //document.getElementById("y-cod").value = pos_y;
    //Set Data Menu
    document.getElementById("x-cod").value = pos_x;
    document.getElementById("y-cod").value = pos_y;
    var time = new Date();
    var mDate = (time.getDate()+"/"+(time.getMonth()+1)+"/"+time.getFullYear());
    document.getElementById("date").value = mDate;
    document.getElementById("time").value = (time.getHours()+":"+time.getMinutes());
    document.getElementById("starName").value = "Unnamed";
    document.getElementById("star_menu").style.visibility='visible'

    history.pushState("", "created", "http://127.0.0.1/~Rudra/SkyNote/HollowNote.php");

  }
}

function loading(){
  document.getElementById('singleStarHolder').style.visibility='hidden';

  var loaded = "<?php $fread = fopen('/Users/Rudra/Sites/SkyNote/Stella/all_Stars.txt','r'); $ex = fgets($fread); fclose($fread); echo $ex; ?>";
  //split data and can create div
  var splitD = loaded.split(",");
  var nData = splitD[0].split("_");

  //console.log(split[0]);
  for(var i = 0; i < splitD.length -1; i++){
    var nData = splitD[i].split("_");
    var opDiv = document.createElement('div');
    opDiv.className = "setBox";
    opDiv.id = splitD[i];
    opDiv.style.left = nData[0] + "px";
    opDiv.style.top =  nData[1] + "px";
    opDiv.onclick = star;

    document.getElementById("holder").appendChild(opDiv);

  }

  var fData = "<?php echo $_GET['loco']; ?>";
  var dataEX = fData.split("/");

  //console.log("inload");
  if (dataEX.length >= 5){
    console.log("Data Read Load");
    dataEX = dataEX[6].replace(".txt","");
    var mdata = dataEX.split("_");

    document.getElementById("x-cod").value = mdata[0];
    document.getElementById("y-cod").value = mdata[1];
    document.getElementById("starName").value = mdata[2];

    fData = "<?php $fread = fopen($_GET['loco'],'r'); $ex = fgets($fread); fclose($fread); $ex = trim(preg_replace('/\s\s+/', ' ', $ex)); echo $ex; ?>";
    fData = fData.split("_");
    document.getElementById("date").value = fData[0];
    document.getElementById("time").value = fData[1];

    var singleStarData = "<?php $str = file_get_contents($_GET['loco']); $str = trim(preg_replace('/\s\s+/', '%0D%0A', $str)); echo $str;?>";
    document.getElementById("singleStar").value = singleStarData.replace(/%0D%0A/g,"\n")

    history.pushState("", "created", "http://127.0.0.1/~Rudra/SkyNote/HollowNote.php");

  }

/* Identifier of url loco elements
  for (var i = 0; i < dataEX.length; i++){
    console.log(i);
    console.log(dataEX  dataEX = dataEX[][i]);
  }
*/

}

function star(){
  document.getElementById("star_menu").style.visibility='visible';
  var nCod = this.id;
  var nCodVals = nCod.split("_");
  nCod = nCod + ".txt";
  var myURL = "http://127.0.0.1/~Rudra/SkyNote/HollowNote.php"
  document.location = myURL + "?loco=/Users/Rudra/Sites/SkyNote/Stella/" + nCod;
}

function hideMenuD(){
  document.getElementById("star_menu").style.visibility='hidden';
}

function viewStella(){
  document.getElementById("singleStarHolder").style.visibility='visible';
}

$(function() {
    $( "#singleStarHolder" ).draggable();
  });

function closeSS(){
  document.getElementById('singleStar').value = "";
  document.getElementById('singleStarHolder').style.visibility='hidden';
}

  </script>

</header>
<body>
<div id="holder">
  <div id="star_menu">
    <form action="All_Methods.php" method="get" name="shareData">
    <p style="margin:5px;">Cordiates: <br/>
      X: <input id="x-cod" name="x_cod" style="width: 76px;" type="text"/> <br/>
      Y: <input id="y-cod" name="y_cod" style="width: 76px;" type="text"/> <br/>
      Date: <input id="date" name="date" style="width: 91px;" type="text"/> <br/>
      Time: <input id="time" name="time" style="width: 55px;" type="text"/> <br/>
      Name: <br/>
      <input id="starName" name="starName" style="width: 91px;" type="text"/>
      <input type="submit" name="create" style="margin-top: 5px;" value="Create"/>
      <input type="submit" name="remove" style="margin-top: 5px;" value="Remove"/>
      <button id="menuData" type="button" style="margin-top: 5px;" onclick="hideMenuD()">Hide</button>
      <button id="view" type="button" style="margin: 5px;" onclick="viewStella()">View</button>
    </p>

  </div>
<div id="singleStarHolder">
  <textarea name="sData" id="singleStar" rows="30" cols="70"></textarea>
  <br/>
  <input type="submit" name="save" style="margin-bottom:5px;margin-left:5px;" value="Save"/>
  <button type="button" name="close" onclick="closeSS()" style="float:right;margin-bottom:5px;margin-right:5px;">Close</button>

</div>
<img id="canves" ondblclick="point_it(event)" onload="loading()" src="Images/HollowStars.jpg" alt="blackboard"/>
</div>
</body>
<!--

-->


</html>

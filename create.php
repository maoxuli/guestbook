<?php

include ('config.php');
$id = $_GET['id'];

include('header.php');
echo "<div id=guestbook>";

echo "<h2>Leave a message</h2>";
echo "<form action='insert.php' method=post name=form1 onsubmit='return check()'>";
echo "<input type=hidden name=id value=".$id.">";
echo "<table class=submission>";
echo "<tr><td width=80px>".TEXT_MSG_TITLE."</td><td><input type=text name=title style='width:350px'>&nbsp;(Required)</td></tr>";
echo "<tr><td width=80px>".TEXT_MSG_AUTHOR."</td><td><input type=text name=author style='width:350px'>&nbsp;(Required)</td></tr>";
echo "<tr><td width=80px>".TEXT_MSG_EMAIL."</td><td><input type=text name=email style='width:350px'></td></tr>";
echo "<tr><td width=80px>".TEXT_MSG_WEB."</td><td><input type=text name=web style='width:350px'></td></tr>";
echo "<tr><td width-80px>".TEXT_MSG_CODE."</td><td><input type=text id=code style='width:350px'>
<input type=text onclick='createCode()' readonly=readonly id=checkCode style='width: 80px; border:none'></td></tr>"; 
echo "<tr><td width=80px>".TEXT_MSG_CONTENT."</td><td><textarea name=content cols='72' rows='10' style='max-width:540px'></textarea></td></tr>";
echo "<tr><td colspan=2><table><tr>";
echo "<td width=200px>".TEXT_MSG_ICON."</td>";
echo "<td><img src='images/1.gif'><br><input type='radio' name='icon' value='1' checked></td>";
echo "<td><img src='images/2.gif'><br><input type='radio' name='icon' value='2'></td>";
echo "<td width=200px>&nbsp;</td></tr></table></td></tr>";
echo "<tr><td width=120px><input type=submit value=".TEXT_SUBMIT_BUTTON." style='width:100px'></td>
          <td><a href='index.php'>Cancel</a></td></tr></table>";
echo "</form>";

echo "</div>";
include('footer.php');
?>

<SCRIPT language=javascript>

var code ; //check code
function createCode()  
{   
	code = "";  
	var codeLength = 6; 
	var checkCode = document.getElementById("checkCode");  
	var selectChar = new Array(0,1,2,3,4,5,6,7,8,9,'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'); 
     
	for(var i=0;i<codeLength;i++)  
	{   
  		var charIndex = Math.floor(Math.random()*36);  
  		code += selectChar[charIndex];  
  	}  
	//alert(code);
	  
	if(checkCode)  
	{  
    	checkCode.className="code";  
		checkCode.value = code;  
  	} 
}

function check()
{
    if (document.form1.title.value=="")
       {
            alert("Please enter title!");
            form1.title.focus();
            return false;
       }
    if (document.form1.author.value=="")
       {
            alert("Please enter author!");
            form1.author.focus();
            return false;
       }
    if (document.form1.content.value=="")
       {
            alert("Please enter content!");
            form1.content.focus();
            return false;
       }

	var inputCode = document.getElementById("code").value;  
    if(inputCode.length <= 0)  
       {  
           	alert("Please enter check code！"); 
 			form1.code.focus();
			return false;
       }  
    else if(inputCode != code )  
       {  
       		alert("You entered a wrong check code！");  
          	createCode(); 
			form1.code.focus();
 		  	return false;
       }  
}

createCode();

</SCRIPT>
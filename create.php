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
function check()
{
    if (document.form1.title.value=="")
       {
            alert("please enter title");
            form1.title.focus();
            return false;
       }
    if (document.form1.author.value=="")
       {
            alert("please enter author");
            form1.author.focus();
            return false;
       }
    if (document.form1.content.value=="")
       {
            alert("please enter content");
            form1.content.focus();
            return false;
       }
}
</SCRIPT>
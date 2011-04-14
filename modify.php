<?php

include ('constant.php');
$id = $_GET['id'];

include('header.php');
echo "<div id=guestbook>";

echo "<form action='update.php' method=post name=form1 onsubmit='return check()'>";
echo "<input type=hidden name=id value=".$id."><br>";
echo TEXT_MSG_TITLE."<input type=text name=title><br>";
echo TEXT_MSG_AUTHOR."<input type=text name=author><br>";
echo TEXT_MSG_CONTENT."<textarea name=content cols='40' rows='5'></textarea><br>";
echo "<input type=submit value=".TEXT_SUBMIT_BUTTON.">";
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
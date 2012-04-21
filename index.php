<?php

/////////////////////////////////////////////////////////////////////
//
//     this is the index page of guestbook
//     it display records on page and format them with HTML tags
//     last modify was on 2004-12-27
//
/////////////////////////////////////////////////////////////////////


include('xml.php');
include('config.php');

//creat a object of class xml_opration
$xml = new xml_opration;
$xml->xmlFormat();
$xml->page();

//display records for appointed count
$data = $xml->xmlPartFormat($page,$pagecount);

include('header.php');
echo "<div id=guestbook>";

echo "<table class=messages>";

//////////////////////////////////////////////////
//  traversal the array $data                   //
//  and get attributes or values of every node  //
//  at last display these data and format them  //
//////////////////////////////////////////////////

$i = 1;
foreach($data as $val){
    //print_r($val);
    if ($val['tag'] == 'messages' && $val['type'] == 'open')
      continue;
    if ($val['tag'] == 'messages' && $val['type'] == 'close')
      break;
    if ($val['tag'] == 'message' && $val['type'] == 'open') {
           $id = $val['attributes']['id'];
           continue;
    }
    if ($val['tag'] == 'title'){
           $title = $val['value'];
           continue;
    }
    if ($val['tag'] == 'author'){
           $author = $val['value'];
           continue;
    }
    if ($val['tag'] == 'web'){
           $web = $val['value'];
           continue;
    }  
    if ($val['tag'] == 'icon'){
           $icon = $val['value'];
           continue;
    }
    if ($val['tag'] == 'time'){
           $time = $val['value'];
           $n = strpos($time, ',');
           $time = substr($time, 0, $n - 0);
           continue;
    }
    if ($val['tag'] == 'content'){
           $content = $val['value'];
           continue;
    }

    if($val['tag'] == 'message' && $val['type'] == 'close') {
        // Only post new message at first page
        if ($i == 1) {
            if($page == 1) {
                echo "<tr class=welcome><td colspan=2><table><tr>
                        <td>".WELCOME_WORD."</td>
                        <td align=right class=minor><a href=create.php?id=".$id.">".NEW_LEAVE_WORD."</a></td>
                      </tr></table></td></tr>";
            }
            else {
                echo "<tr class=welcome><td colspan=2><table><tr>   
                        <td>".WELCOME_WORD."</td>
                        <td align=right class=minor><a href=index.php>".WANT_CEART_WORD."</a></td>
                      </tr></table></td></tr>";
            }
        }

        //format data with HTML tags
        echo "<tr class=header><td colspan=2></td></tr>";
        echo "<tr>
                 <td width=100px align=center><a href=".$web.">".$author."</a></td>
                 <td>".$title."</td>
             </tr>";
        echo "<tr>
                 <td align=center class=minor><img src='images/".$icon.".gif'><br>".$time."</td>
                 <td>".$content."</td>
             </tr>";
        $i++;
        continue;
    }
}
echo "</table>";

//Here is the pagenite system in depth of page
echo "<table class=pages>";
echo "<tr><td>".TOTAL_RECORD_FRONT.$pagecount.PAGE.$total.TOTAL_RECORD_BACK."</td>";
echo "<td align=right class=minor>".$pagestring."&nbsp;&nbsp;&nbsp;&nbsp;";
$select="<select onchange=\"location='?page='+this.options[this.selectedIndex].value\">";
    for ($i=1;$i<=$pagecount;$i++){
    $select.="<option value='$i'".(($i==$page)?' selected':'').">".$i."</option>";
    }
$select.="</select></td></tr>";
echo $select;

echo "</table>";

echo "</div>";
include('footer.php');
?>
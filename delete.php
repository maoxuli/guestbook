<?php

include('xml_class.php');
include('constant.php');

//creat a object og class xml_opration
$xml = new xml_opration;


$id = $_GET['id'];
if ($id ==1){
     echo "<div align=center>The first must be reserved</div>";
     echo "<meta http-equiv=\"refresh\" content=\"2 url=index.php\">";
}
else{

$xml->deleteXmlFile($id);

$xml->writeXmlFile();


header("location:index.php");
}

?>
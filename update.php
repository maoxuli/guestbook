<?php

include('xml.php');
include('config.php');

//creat a object og class xml_opration
$xml = new xml_opration;

$title = $xml->formatXmlString($_POST['title']);
$author = $xml->formatXmlString($_POST['author']);
$content = $xml->formatXmlString($_POST['content']);
$id = $_POST['id'];

$xml->updateXmlFile($id, $title, $author, $content);

$xml->writeXmlFile();


header("location:index.php");

?>
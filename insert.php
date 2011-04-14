<?php

include('xml_class.php');
include('constant.php');

//creat a object og class xml_opration
$xml = new xml_opration;

$id = $_POST['id'] + 1;
$title = $xml->formatXmlString($_POST['title']);
$author = $xml->formatXmlString($_POST['author']);
$email = $xml->formatXmlString($_POST['email']);
$web = $xml->formatXmlString($_POST['web']);
$icon = $_POST['icon'];
$content = $xml->formatXmlString($_POST['content']);

$xml->insertXmlFile($id, $title, $author, $email, $web, $icon, $content);

$xml->writeXmlFile();

header("location:index.php");

?>
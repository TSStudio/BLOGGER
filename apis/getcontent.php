<?php
include "server-info.php";
session_start();
if(!isset($_SESSION["username"])){
    $username='<a href="https://account.tmysam.top/loginform.php?code=105&URL=BLOGGER">登录</a>';
}else{
    $username=$_SESSION["username"];
}
if(!is_numeric($_GET["threadid"])){
    die();
}
$database = new mysqli($dbhost,$dbuser,$dbpawd,$dbname);
$sql = 'SELECT author,time,stars,title,content FROM articles WHERE threadid=?';
$stmt = $database->prepare($sql);
$stmt->bind_param('i',$threadid);
$threadid=$_GET['threadid'];
$stmt->bind_result($author,$time,$stars,$title,$content);
$stmt->execute();
$output = array("username"=>$username);
while ($stmt->fetch()) {
    $output['title']=$title;
    $output['content']=$content;
    $output['time']=date("Y-m-d",$time);
    $output['stars']=$stars;
    $output['author']=$author;
}
$database->close();
header('Content-type: application/json');
print(json_encode($output));
?>
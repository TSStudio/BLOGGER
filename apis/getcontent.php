<?php
include "server-info.php";
session_start();
if(!isset($_SESSION["username"])){
    $username="GUEST";
}else{
    $username=$_SESSION["username"];
}
if(!is_numeric($_GET["threadid"])){
    die();
}
$database = new mysqli($dbhost,$dbuser,$dbpawd,$dbname);
$result = $database->query("SELECT author,time,stars,title,content FROM articles WHERE threadid=".$_GET['threadid']);
$output = array("username"=>$username);
while($row = mysqli_fetch_array($result)){
    $output['title']=$row['title'];
    $output['content']=$row['content'];
    $output['time']=date("Y-m-d",$row["time"]);
    $output['stars']=$row['stars'];
    $output['author']=$row['author'];
}
header('Content-type: application/json');
print(json_encode($output));
?>
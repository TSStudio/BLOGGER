<?php
include "server-info.php";
session_start();
if(!isset($_SESSION["username"])){
    $username='<a href="https://account.tmysam.top/loginform.php?code=105&URL=BLOGGER">登录</a>';
}else{
    $username=$_SESSION["username"];
}
$database = new mysqli($dbhost,$dbuser,$dbpawd,$dbname);
$result = $database->query("SELECT author,time,stars,title,threadid FROM articles ORDER BY threadid DESC LIMIT 10");
$output = array("articles"=>array(),"tags"=>array(),"user"=>array("username"=>$username),"tags"=>array());
while($row = mysqli_fetch_array($result)){
    $output['articles'][]=array("author"=>$row["author"],"time"=>date("Y-m-d",$row["time"]),"stars"=>$row["stars"],"title"=>$row["title"],"threadid"=>$row["threadid"]);
}
$result = $database->query("SELECT tags FROM tags LIMIT 10");
while($row = mysqli_fetch_array($result)){
    $output['tags'][]=$row["tags"];
}
header('Content-type: application/json');
print(json_encode($output));
?>
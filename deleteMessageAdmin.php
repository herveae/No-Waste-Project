<?php
include_once("main.php");
if(!empty($_GET["id"])){
    $query="delete from messages where id=:id";
    $objstmt=$pdo->prepare($query);
    $objstmt->execute(["id"=>$_GET["id"]]);
    $objstmt->closeCursor();
    // header("Location:messagePrives.php");
}  
?>
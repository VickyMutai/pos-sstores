<?php
try{
    $pdo = new PDO('mysql:host=localhost;dbname=sambai','root','');
    // echo 'Connection successful';
}catch(PDOException $error){
    echo $error->getmessage();
}
?>
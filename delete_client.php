<?php
 include_once'db/connect_db.php';
 session_start();
 if($_SESSION['role']!=="Admin"){
   header('location:index.php');
 }

$delete = $pdo->prepare("DELETE FROM client WHERE client_id = '".$_GET['id']." '");
if($delete->execute()){
    header('location:clients.php');
}

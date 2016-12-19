<?php
require 'database.php';

$stories = $_POST['postInput'];

$stmt = $mysqli->prepare("insert into posts (user_id, story) values(?, ?)");
if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}
$stmt->bind_param('is', $_SESSION['user_id'], $stories);
$stmt->execute();
$stmt->close();

?>
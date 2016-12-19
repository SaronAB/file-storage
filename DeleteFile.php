<?php
session_start();
$filenameD = (string) $_GET["filename"];
$deletedFile = sprintf("/srv/uploads/%s/%s", $_SESSION["user"], $filenameD);
unlink($deletedFile);

header ("Location: Deleted.html");
exit;
?>
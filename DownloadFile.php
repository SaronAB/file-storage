<?php
session_start();
    $filenameV = (string) $_GET["filename"];
   
                    
                    $username = (string) $_SESSION["user"];
                    if( !preg_match('/^[\w_\-]+$/', $username) ){
                        echo htmlentities("Invalid username");
                        exit;
                    }
                    
                    
                    if( !preg_match('/^[\w_\.\-]+$/', $filenameV) ){
                        echo htmlentities("Invalid filename");
                        exit;
                    }
                             
                    $full_path = sprintf("/srv/uploads/%s/%s", $_SESSION["user"], $filenameV);
                    //echo htmlentities($filenameV);
                    //echo htmlentities($full_path);
                    
                    $finfo = new finfo(FILEINFO_MIME_TYPE);
                    $mime = $finfo->file($full_path);
                    //echo htmlentities($mime);
                    
                    
                        header("Content-Type: ".$mime);
                        header('Content-Disposition: attachment; filename="'.basename($filenameV).'"');
                        
                        readfile($full_path);
                      
?>
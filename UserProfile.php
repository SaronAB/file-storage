<!doctype html>
<html lang="en">
<head lang=en>
    <link rel="stylesheet" type="text/css" href="MainPage.css">
    <title> User Profile </title>
    
</head>
<body>
    Welcome To S-BREEZAY Where Sharing is Caring!
    <form enctype="multipart/form-data" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
        <input type="hidden" name="MAX_FILE_SIZE" value="20000000" />
        <label for="uploadfile_input"><br> <br><br><br><br> <br>Choose a file to upload:</label>
        <input name="uploadedfile" type="file" id="uploadfile_input" />
        <input type="submit" name="action" value="Upload">
    </form> <br> <br>
    
    
   <?php
        session_start();
        $currUser = $_SESSION["user"];
        $submission=null;
        
        $upload_folder = "/srv/uploads/$currUser/";
        $upload_files = scandir($upload_folder, 1);   //an array of files in user's uploads folder
        $arrlength = count($upload_files);   // gets the number of files in the user's uploads folder
    ?>
    
       <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
            <?php
                for($x=0; $x < $arrlength-2; $x++){
                    echo ("<input type=\"checkbox\" value=\"$upload_files[$x]\" name=\"checked[]\"/>");
                    echo (htmlentities($upload_files[$x])."&nbsp;");   //displays file names
                    //echo ("<input type=\"radio\" value=\"$upload_files[$x]\" name=\"viewFile\"/>");
                    echo ("<a href=ViewFile.php?filename=$upload_files[$x]>View</a> &nbsp;");
                    echo ("<a href=DeleteFile.php?filename=$upload_files[$x]>Delete</a> &nbsp;");
                    echo ("<a href=DownloadFile.php?filename=$upload_files[$x]>Download</a> <br>");
                   // echo ('<input type="submit" name="action" value="View"> <br>');
                }
                echo ('<br><input type="submit" name="action" value="Delete">');
            ?>
              
           </form>
    
        <?php
        
        if(isset($_POST["action"])) {  //checks if view, delete, or upload have been pressed
        $submission= (string) $_POST["action"];
                  
            if (strcmp($submission, "Upload") === 0){
                if($_FILES['uploadedfile']['size'] < 2000000) {
                    $target_file = basename($_FILES['uploadedfile']['name']);
                    $target_dir = sprintf("/srv/uploads/%s/%s", $_SESSION["user"], $target_file);
                         
                         
                    $username = (string) $_SESSION["user"];
                    if( !preg_match('/^[\w_\-]+$/', $username) ){
                        echo htmlentities("Invalid username");
                        exit;
                    }
                             
                    // checks if file name is valid
                    if( !preg_match('/^[\w_\.\-]+$/', $target_file) ){
                        header ("Location: InvalidFilename.html");
                        exit;
                    }
                     
                    if (move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_dir)){
                    header("Location: UploadSuccess.html");
                    exit;
                    } else {
                        header("Location: UploadFailure.html");
                        exit;
                    }
                }
                else {
                            echo htmlentities("File is too large!");
                }     
            }
            else if (strcmp($submission, "Delete") === 0){
                for($x=0;$x < count($_POST["checked"]);$x++){
                        $filenameD=$_POST["checked"];
                        $deletedFile = sprintf("/srv/uploads/%s/%s", $_SESSION["user"], $filenameD[$x]);
                        unlink($deletedFile);
                        
                    }
                    header ("Location: Deleted.html");
                    exit;                        
            }
        }
        
    ?>
    <br><br><br>
    <div>
    <form action="LogOut.php" method="post">
        <input type="submit" value="LogOut">
    </form>
    </div>
</body>
</html>

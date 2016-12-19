<!doctype html>
<head>
    <link rel="stylesheet" type="text/css" href="MainPage.css">
    <title>My Page</title>
</head>
<body>
<?php
    session_start();
    $user = (string) $_POST["usernameinput"];
    
    $h = fopen("/srv/uploads/users.txt", "r");
     
    $linenum = 1;
    while( !feof($h) ){
        $linenum++;
        $userFromFile = trim(fgets($h));

        if(strcmp($user, $userFromFile) === 0){
            $_SESSION["user"] = $user;
            header ("Location: UserProfile.php");
            fclose($h);
            exit;
        } else {
        }
    }
    
    fclose($h);
    header ("Location: InvalidUsername.html");
    exit; 
    
?>

</body>
</html>
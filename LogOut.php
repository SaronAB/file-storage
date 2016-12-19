<!doctype html>

<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="MainPage.css">
    <title>Log Out</title>
</head>
<body>
    <?php
        session_destroy();
        header ("Location: SiteMainPage.html")
    ?>
</body>
</html>
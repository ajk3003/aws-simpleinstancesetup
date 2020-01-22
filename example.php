<?php
 // With the given nginx setup, you can put the this file to:
 // --> /var/www/html/filename.php

 // Adjust the host address and port to connect to the db (MySQL)
 $dbhost = 'xxx.xxx.xxx.xxx:3306';

 // Adjust the user and pw to be valid for the db you connect to
 $dbuser = 'username';
 $dbpass = 'password';

 $conn = new mysqli($dbhost, $dbuser, $dbpass);

 // Check connection
 if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    echo "DB connection failure";
 }
 echo "DB connection successful";
 $conn->close();
 echo "Connection closed, everything done";
?>

<html>
 <head>
 <title>Simple PHP-DB connection test page</title>
 </head>
 <body>
 <h1>PHP DB connection test page</h1>
</body>
</html>



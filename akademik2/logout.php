<?php
session_start();
session_destroy();
header("Location: login.php");
exit();
?>

//sederhana 
<?php
session_start();
session_destroy();
header("Location: login.php");
?>
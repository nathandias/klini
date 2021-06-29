<?php   
session_start();  
if(!isset($_SESSION["email"])){  
    echo "<script type='text/javascript'>document.location.href='{$base_url}/ispring/';</script>";
} else { 
  require_once('sitedef.php');
  include_once('header/header.php');
  include_once('function/student_group.php');
?>

<!DOCTYPE html>
<html>
<body>
<pre>
<?php
    echo var_dump($array);
?>
</pre>
</body>
</html>

<?php
}
?>
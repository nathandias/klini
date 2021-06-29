<?php   
session_start();  
if(!isset($_SESSION["email"])){  
    echo "<script type='text/javascript'>document.location.href='{$base_url}/ispring/';</script>";
} else { 
  require_once('sitedef.php');
  include_once('header/header.php');
  include_once('function/student_group.php');
  include_once('function/student_result.php');
?>

<!DOCTYPE html>
<html>
<body>
<pre>
<?php
    echo var_dump($array1);

    # output a list of student user ids, who passed Unit 10

    $students_who_passed_unit_10 = array();

    foreach ($array1 as $module) {
      if ( preg_match( '/^Test Mountain States Unit 10/', $module['moduleTitle'])
          && $module['completionStatus'] == 'passed' )
      {
            $students_who_passed_unit_10[] = $module['userId'];
      }
    }

    echo "<hr/>";
    echo var_dump($students_who_passed_unit_10);


?>
</pre>
</body>
</html>

<?php
}
?>
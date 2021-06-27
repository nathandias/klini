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
        <form action="" method="POST">
        <main>
            <!-- header-section -->
            <section class="header-section">
                <div class="container">
                    <div class="header-inner flex">
                        <div class="left">
                            <img src="images/logo.png" alt="logo" class="logo-img">
                        </div>
                        <div class="right profile-part">
                            <p class="tooltip">
                                <img src="images/profile.png" alt="Profile" />Hi Admin... <span><i class="fas fa-chevron-up rotate"></i></span>
                                <span class="tooltiptext">
                                    <i class="fas fa-sign-out-alt mr-rt-7 logout-icon"></i>
                                <input type="submit" class="logout-btn" name="logout" value="Logout">
                                    <?php
                                    if(isset($_POST['logout']))
                                    {
                                        session_start(); 
                                        unset($_SESSION["email"]);
                                        unset($_SESSION["pass"]);
                                        session_destroy();  
                                        echo "<script type='text/javascript'>document.location.href='{$base_url}/ispring/';</script>";
                                    }
                                    ?>
                               </span>
                            </form>
                            </p>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Student-table-section -->
            <section class="student-table">
                <div class="container">
                    <div class="table-holder">
                        <div class="table-header flex">
                            <h1 class="text-23">Student Details</h1>
                            <div class="search-pad relative">
                                <!-- <input type="button" name="" class="btn-primary" value="Expert as PDF"> -->
                                <i class="fas fa-search search-icon"></i>
                                <input type="text" id="myInput" name="" placeholder="Search" class="search" />
                            </div>
                        </div>
                        <div class="main-table-wrap">
                            <table id="tableData" class="main-student-table">
                                <thead>
                                    <tr>
                                        <th>S no</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>                                        
                                        <th>Email</th>                                    
                                        <th>Status</th>
                                        <th>Add Date</th>
                                        <th>Last Login Date</th>                                
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="myTable">
                                    <?php
                                    $s_no=1;
                                    foreach($array as $key => $value){
                                        if($value['role']=='learner')
                                        {
                                     ?>
                                    <tr>
                                        <td><?php echo $s_no; $s_no++;?></td>                                  
                                        <?php
                                        $Student_Details = $value['fields']['field'];
                                        foreach ($Student_Details as $index => $array2){ 
                                            if($array2['name']=='FIRST_NAME')
                                            {
                                                $FIRST_NAME[$key]=$array2['value'];
                                            }
                                            if($array2['name']=='LAST_NAME')
                                            {
                                                if(!empty($array2['value']))
                                                {
                                                    $LAST_NAME[$key]=$array2['value'];
                                                }
                                                else
                                                {
                                                    $LAST_NAME[$key]=" ---- ";
                                                }
                                            }
                                            if($array2['name']=='EMAIL')
                                            {
                                                if(!empty($array2['value']))
                                                {
                                                    $EMAIL[$key]=$array2['value'];
                                                }
                                                else
                                                {
                                                    $EMAIL[$key]=" ---- ";
                                                }
                                            }
                                            
                                        }
                                            if(!empty($value['status']))
                                            {
                                                $status[$key]=$value['status'];
                                                if($status[$key]==1)
                                                {
                                                    $status[$key]='Active';
                                                }
                                                else
                                                {
                                                    $status[$key]='In Active';
                                                }
                                            }
                                            else
                                            {
                                                $status[$key]=" ---- ";
                                            }
                                            if(!empty($value['lastLoginDate']))
                                            {
                                                $lastLoginDate[$key]=$value['lastLoginDate'];
                                            }
                                            else
                                            {
                                                $lastLoginDate[$key]=" ---- ";
                                            }
                                        ?>
                                        <td><?php echo $FIRST_NAME[$key]; ?></td>
                                        <td><?php echo $LAST_NAME[$key]; ?></td>
                                        <td><?php echo $EMAIL[$key]; ?></td>
                                        <td><?php echo $status[$key]; ?></td>
                                        <td><?php echo $value['addedDate']; ?></td>
                                        <td><?php echo $lastLoginDate[$key]; ?></td>
                                        <td class="action-part"><a href="student_view_details.php?id=<?php echo $value['userId'] ?>"><input type="button" name="" class="btn-primary btn com-hover" value="View" /></a></td>
                                    <?php }} ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <script>
            $(document).ready(function() {
                $('#tableData').paging({ limit: 5 });
                $('#tableData').paging({
                    activePage: 0,
                });
            }); 
        </script>
    </body>
</html>
<?php  
}  
?>  
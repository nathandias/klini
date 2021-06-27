<?php   
session_start();  
if(!isset($_SESSION["email"])){  
    header("location:index.php");  
} else {  
  require_once('sitedef.php');
  include_once('header/header.php');
  include_once('function/student_group.php');
  include_once('function/department.php');
  include_once('function/student_result.php');
?>
<!DOCTYPE html>
<html>
    <body>
        <form method="POST">
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

            <!-- header-section -->

            <section class="view-details-section">
                <div class="container">
                    <div class="view-details-inner">
                        <div class="table-header flex">
                            <h1 class="text-23 change1">Student Standing</h1>
                            <div class="search-pad relative flex">
                                <div class="back-btn-pt">
                                    <a href="student_details.php" class="btn-primary btn-4 btn com-hover"><span>Back</span></a>
                                </div>
                                <button class="btn-primary btn-4 btn com-hover" id="downloadPDF"><span>Export as PDF</span></button>
                            </div>
                        </div>
                        <div class="student-profile" id="studentDetails">
                            <div class="lt-part">
                                <div class="header-view-details">
                                    <p>
                                        <span><i class="fas fa-user change"></i></span> Student Information
                                    </p>
                                </div>

                                <div class="student-infos flex">
                                    <!-- sec-rows -->
                                    <?php
                                    if(isset($_GET['id']))
                                    {
                                        $id=$_GET['id'];
                                    }
                                    foreach($array as $key => $value){
                                        $Id[$key]=$value['userId'];
                                        if($id==$Id[$key]){
                                        $role=$value['role'];
                                        $statusVal=$value['status'];
                                        if($statusVal==1)
                                        {   
                                            $status='Active';
                                        }
                                        else
                                        {
                                            $status='In Active';
                                        }                                     
                                        $Student_Details = $value['fields']['field'];
                                        foreach ($Student_Details as $index => $array2){
                                            if($array2['name']=='FIRST_NAME')
                                            {
                                                $FIRST_NAME=$array2['value'];
                                            }
                                            if($array2['name']=='LAST_NAME')
                                            {
                                                if(!empty($array2['value']))
                                                {
                                                    $LAST_NAME=$array2['value'];
                                                }
                                                else
                                                {
                                                    $LAST_NAME=" ---- ";
                                                }
                                            }
                                            if($array2['name']=='DOB')
                                            {
                                                if(!empty($array2['value']))
                                                {
                                                    $DOB=$array2['value'];
                                                }
                                                else
                                                {
                                                    $DOB=" ---- ";
                                                }
                                            }
                                            if($array2['name']=='PRN')
                                            {
                                                if(!empty($array2['value']))
                                                {
                                                    $PRN=$array2['value'];
                                                }
                                                else
                                                {
                                                    $PRN=" ---- ";
                                                }
                                            }
                                            if($array2['name']=='PHONE')
                                            {
                                                if(!empty($array2['value']))
                                                {
                                                    $PHONE=$array2['value'];
                                                }
                                                else
                                                {
                                                    $PHONE=" ---- ";
                                                }
                                            }
                                            if($array2['name']=='EMAIL')
                                            {
                                                if(!empty($array2['value']))
                                                {
                                                    $EMAIL=$array2['value'];
                                                }
                                                else
                                                {
                                                    $EMAIL=" ---- ";
                                                }
                                            }
                                            if($array2['name']=='COUNTRY')
                                            {
                                                if(!empty($array2['value']))
                                                {
                                                    $COUNTRY=$array2['value'];
                                                }
                                                else
                                                {
                                                    $COUNTRY=" ---- ";
                                                }
                                            }
                                        }
                                        $depatmentId=$value['departmentId'];
                                        foreach ($array3 as $dept => $depatment){
                                            $deptId=$depatment['departmentId'];
                                            if($depatmentId==$deptId)
                                            {
                                                $department=$depatment['name'];
                                            }
                                        }
                                    }
                                    }
                                    $time=0;
                                    $val=0;
                                    $Average=0;
                                    $PassedCourse=0;
                                    $InProgressCourse=0;
                                    $NotStartedCourse=0;
                                    $FailedCourse=0;
                                    foreach ($array1 as $Details => $result) {
                                        $userId[$Details]=$result['userId'];
                                        if($id==$userId[$Details]){
                                            if(!empty($result['moduleTitle']))
                                            {
                                                $courseTitle[$Details]=$result['moduleTitle'];
                                                $val=$val+1;
                                            }
                                            else
                                            {
                                                $courseTitle[$Details]=" ---- ";
                                            }
                                            if(!empty($result['accessDate']))
                                            {
                                                $startDate[$Details]=$result['accessDate'];
                                                $s_date[$Details]=date_create($startDate[$Details]);
                                            }
                                            else
                                            {
                                                $startDate[$Details]=" ---- ";
                                            }
                                            if(!empty($result['completionDate']))
                                            {
                                                $completionDate[$Details]=$result['completionDate'];
                                                $e_date[$Details]=date_create($completionDate[$Details]);
                                            }
                                            else
                                            {
                                                $completionDate[$Details]=" ---- ";
                                            }
                                            if(!empty($result['timeSpent']))
                                            {
                                                $timeSpent[$Details]=$result['timeSpent'];
                                                $time=$time+$timeSpent[$Details];
                                            }
                                            else
                                            {
                                                $timeSpent[$Details]=" 0:0 Hrs ";
                                            }
                                            if(!empty($result['completionStatus']))
                                            {
                                                $completionStatus[$Details]=$result['completionStatus'];
                                                if($completionStatus[$Details]=='passed')
                                                {
                                                    $completionStatus[$Details]='Passed';
                                                    $PassedCourse=$PassedCourse+1;
                                                }
                                                else if($completionStatus[$Details]=='in_progress')
                                                {
                                                    $completionStatus[$Details]='In Progress';
                                                    $InProgressCourse=$InProgressCourse+1;
                                                }
                                                else if($completionStatus[$Details]=='not_started')
                                                {
                                                    $completionStatus[$Details]='Not Started';
                                                    $NotStartedCourse=$NotStartedCourse+1;
                                                }
                                                else if($completionStatus[$Details]=='failed')
                                                {
                                                    $completionStatus[$Details]='Failed';
                                                    $FailedCourse=$FailedCourse+1;
                                                }
                                            }
                                            if(!empty($result['awardedScore']))
                                            {
                                                $awardedScore[$Details]=$result['awardedScore'];
                                            }
                                            else
                                            {
                                                $awardedScore[$Details]=" ---- ";
                                            }
                                            if(!empty($result['progress']))
                                            {
                                                $progress[$Details]=$result['progress'];
                                            }
                                            else
                                            {
                                                $progress[$Details]=" ---- ";
                                            }
                                        }                                    
                                    }  
                                    ?>
                                    <div class="inner-section sec-one flex width-half" id="mydiv" data-myval="<?php echo $FIRST_NAME."_".$LAST_NAME; ?>">
                                        <div class="left">
                                            <p class="label-p changeMe">First Name</p>
                                        </div>
                                        <div class="right">
                                            <p class="changeMe"><?php echo $FIRST_NAME; ?></p>
                                        </div>
                                    </div>

                                    <!-- sec-rows -->

                                    <div class="inner-section sec-one flex width-half">
                                        <div class="left">
                                            <p class="label-p changeMe">Last Name</p>
                                        </div>
                                        <div class="right">
                                            <p class="changeMe"><?php echo $LAST_NAME; ?></p>
                                        </div>
                                    </div>

                                    <!-- sec-rows -->

                                    <div class="inner-section sec-one flex width-half">
                                        <div class="left">
                                            <p class="label-p changeMe">Date of Birth</p>
                                        </div>
                                        <div class="right">
                                            <p class="changeMe"><?php echo $DOB; ?></p>
                                        </div>
                                    </div>

                                    <!-- sec-rows -->

                                    <div class="inner-section sec-one flex width-half">
                                        <div class="left">
                                            <p class="label-p changeMe">Roll</p>
                                        </div>
                                        <div class="right">
                                            <p class="changeMe"><?php echo $role; ?></p>
                                        </div>
                                    </div>

                                    <!-- sec-rows -->

                                    <div class="inner-section sec-one flex width-half">
                                        <div class="left">
                                            <p class="label-p changeMe">Status</p>
                                        </div>
                                        <div class="right">
                                            <p class="changeMe"><?php echo $status; ?></p>
                                        </div>
                                    </div>

                                    <!-- sec-rows -->

                                    <div class="inner-section sec-one flex width-half">
                                        <div class="left">
                                            <p class="label-p changeMe">Department</p>
                                        </div>
                                        <div class="right">
                                            <p class="changeMe"><?php echo $department; ?></p>
                                        </div>
                                    </div>

                                    <!-- sec-rows -->

                                    <div class="inner-section sec-one flex width-half">
                                        <div class="left">
                                            <p class="label-p changeMe">Phone Number</p>
                                        </div>
                                        <div class="right">
                                            <p class="changeMe"><?php echo $PHONE; ?></p>
                                        </div>
                                    </div>

                                    <!-- sec-rows -->

                                    <div class="inner-section sec-one flex width-half">
                                        <div class="left">
                                            <p class="label-p changeMe">Email</p>
                                        </div>
                                        <div class="right">
                                            <p class="changeMe"><?php echo $EMAIL; ?></p>
                                        </div>
                                    </div>
                                    
                                    <!-- sec-rows -->

                                    <div class="inner-section sec-one flex width-half">
                                        <div class="left">
                                            <p class="label-p changeMe">Country</p>
                                        </div>
                                        <div class="right">
                                            <p class="changeMe"><?php echo $COUNTRY; ?></p>
                                        </div>
                                    </div>

                                    <!-- sec-rows -->

                                    <div class="inner-section sec-one flex width-half">
                                        <div class="left">
                                            <p class="label-p changeMe">Pre-registration No.</p>
                                        </div>
                                        <div class="right">
                                            <p class="changeMe"><?php echo $PRN; ?></p>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>

                            <div class="lt-part">
                                <div class="header-view-details">
                                    <p>
                                        <span><i class="fas fa-graduation-cap change"></i></span> Course Details
                                    </p>
                                </div>

                                <div class="student-infos flex">
                                    <table class="main-student-table">
                                        <thead>
                                            <th class="changeMe">Course Title</th>
                                            <th class="changeMe">Start Date</th>
                                            <th class="changeMe">End Date</th>
                                            <th class="changeMe">Status</th>
                                            <th class="changeMe">Score</th>
                                            <th class="changeMe">progress</th>
                                            <th class="changeMe">Time Spent</th>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($array1 as $Details => $result) { 
                                                if($id==$userId[$Details]){ ?>
                                                    <tr>                                                
                                                        <td class="changeMe"> <?php echo $courseTitle[$Details]; ?></td>
                                                        <td class="changeMe"> <?php echo date_format($s_date[$Details],"Y-m-d"); ?></td>
                                                        <td class="changeMe"> <?php if(!empty($result['completionDate'])) { echo date_format($e_date[$Details],"Y-m-d"); } else { echo $completionDate[$Details]; } ?></td>
                                                        <td class="changeMe"> <?php echo $completionStatus[$Details]; ?></td>
                                                        <td class="changeMe"> <?php if(!empty($result['awardedScore'])) { echo $awardedScore[$Details];echo "%"; } else { echo $awardedScore[$Details]; } ?></td>
                                                        <td class="changeMe"> <?php if(!empty($result['progress'])) { echo $progress[$Details];echo "%"; } else { echo $progress[$Details]; } ?></td>
                                                        <td class="changeMe"> <?php if(!empty($result['timeSpent'])) { echo gmdate("H:i:s", $timeSpent[$Details]); echo "&nbspHrs"; } else { echo $timeSpent[$Details]; } ?></td>
                                                        <?php echo "<br>"; } }?>
                                                    </tr>
                                                    <tr>
                                                        <td class="changeMe" colspan="6" style="text-align:right;padding-right: 25px;font-weight: 700;font-size: 16px;">Total</td>
                                                        <td class="changeMe"><?php echo gmdate("H:i:s", $time); echo "&nbspHrs"; ?>                                                            
                                                        </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                            <div class="student-infos flex">
                                     <!-- sec-rows -->
                                     <div class="btm-cover-right btm-section">
                                        <p class="icon-label changeMe"><span >Average</span></p>
                                        <canvas id="myChart"></canvas>
                                    </div> 
                                    <div class="btm-cover-left flex">
                                        <!-- sec-rows -->
                                        <div class="btm-section">
                                            <div class="left">
                                                <p class="label-p changeMe">Average</p>
                                            </div>
                                            <div class="right">
                                                <p class="changeMe"><?php $Average=($PassedCourse/$val)*100; echo number_format($Average, 2);echo "%"; $total=100-$Average?></p>
                                            </div>
                                        </div>
                                        <!-- sec-rows -->
                                        <div class="btm-section">
                                            <div class="left">
                                                <p class="label-p changeMe">Total Course</p>
                                            </div>
                                            <div class="right">
                                                <p class="changeMe"><?php echo $val; ?></p>
                                            </div>
                                        </div>
                                        <!-- sec-rows -->
                                        <div class="btm-section">
                                            <div class="left">
                                                <p class="label-p changeMe">Passed Course</p>
                                            </div>
                                            <div class="right">
                                                <p class="changeMe"><?php echo $PassedCourse; ?></p>
                                            </div>
                                        </div>
                                        <!-- sec-rows -->
                                        <div class="btm-section">
                                            <div class="left">
                                                <p class="label-p changeMe">Failed Course</p>
                                            </div>
                                            <div class="right">
                                                <p class="changeMe"><?php echo $FailedCourse; ?></p>
                                            </div>
                                        </div>
                                        <!-- sec-rows -->
                                        <div class="btm-section">
                                            <div class="left">
                                                <p class="label-p changeMe">In Progress Course</p>
                                            </div>
                                            <div class="right">
                                                <p class="changeMe"><?php echo $InProgressCourse; ?></p>
                                            </div>
                                        </div>
                                        <!-- sec-rows -->
                                        <div class="btm-section">
                                            <div class="left">
                                                <p class="label-p changeMe">Not Started Course</p>
                                            </div>
                                            <div class="right">
                                                <p class="changeMe"><?php echo $NotStartedCourse; ?></p>
                                            </div>
                                        </div>
                                    </div>                                                                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <script>
            var ctx = document.getElementById('myChart').getContext('2d');
            var Average = <?php echo(json_encode(number_format($Average,2))); ?>;
            var total = <?php echo(json_encode(number_format($total,2))); ?>;
            var chart = new Chart(ctx, {
                // The type of chart we want to create
                type: 'doughnut',

                // The data for our dataset
                data: {
                    labels: [' Skilled ', ' Remaining '],
                    datasets: [{
                        data: [Average,total],
                        backgroundColor: [
                        	'rgb(54, 162, 235)',
                            'rgb(220,220,220)',                        
                        ],
                    }],
                },

                // Configuration options go here
                options: {}
            });
        </script>
    </body>
</html>
<?php  
}  
?>  
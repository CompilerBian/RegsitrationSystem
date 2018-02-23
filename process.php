<?php include 'database.php';

$query_1 = mysqli_query($con,"SELECT * FROM timeslot");
$row = mysqli_fetch_assoc($query_1);
$remain_for_1 = $row['remain_1'];
$remain_for_2 = $row['remain_2'];
$remain_for_3 = $row['remain_3'];
$remain_for_4 = $row['remain_4'];
$remain_for_5 = $row['remain_5'];
$remain_for_6 = $row['remain_6'];

//check if form submitted
if(isset($_POST['register'])){
    
    $UMID = mysqli_real_escape_string($con, $_POST['UMID']);
    $firstName = mysqli_real_escape_string($con, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($con, $_POST['lastName']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $projectTitle = mysqli_real_escape_string($con, $_POST['projectTitle']);
    $phoneNumber = mysqli_real_escape_string($con, $_POST['phoneNumber']);
    $timeSlot = mysqli_real_escape_string($con, $_POST['timeSlot']);
    
    $timeSlot = explode(" ",$timeSlot);
    $timeSlot = $timeSlot[0];
    //Validate input
    
    
    if(!isset($UMID) || $UMID == '' ||!isset($firstName) || $firstName == '' ||!isset($lastName) || $lastName == '' ||
      !isset($email) || $email == '' ||!isset($projectTitle) || $projectTitle == '' ||!isset($phoneNumber) || $phoneNumber == '' ||
      !isset($timeSlot) || $timeSlot == ''){
        
        $error = "Please fill in your message";
        header("Location: index.php?error=".urlencode($error));
        exit();
    }
    
    else{
        
        //create select query
        $query = "SELECT * FROM studentinfo";
        $studentInfo = mysqli_query($con, $query);
        //check if the user has already registered into the system.
        while($row = mysqli_fetch_assoc($studentInfo)){
            if($UMID == $row['UMID']){
                $duplicate_error = "You have registered into the system!";
                header("Location: index.php?UMID=".urlencode($UMID));
                exit();               
            }
        }
        
        
        //validate the UMID format
        if(!preg_match("/\d{8}/", $UMID)){
            $error = "UMID should be eight digitals";
            header("Location: index.php?error=".urlencode($error));
            exit();
        }
        
        //validate the first name and last name
        if(!preg_match("/[a-zA-Z]+/", $firstName) || !preg_match("/[a-zA-Z]+/", $lastName)){
            $error = "Please input the correct name format";
            header("Location: index.php?error=".urlencode($error));
            exit();
        }

        
        //Validate the phone number input format
        
        if(!preg_match("/\d{3}-\d{3}-\d{4}/", $phoneNumber)){
            $error = "Please input the correct phone Numer format";
            header("Location: index.php?error=".urlencode($error));
            exit();
        }
        
        //validate the email input format
        if(!preg_match("/^[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/", $email)){
            $error = "Please input the correct email format";
            header("Location: index.php?error=".urlencode($error));
            exit();
        }
        

        
        //determine the time slot ID
        if($timeSlot == "12/9/17,7:00am-8:00am"){
            $remain_for_1 = $remain_for_1+1;
            if($remain_for_1>6){
                $error = "This slot is full,please reschedule another slot";
                header("Location: index.php?error=".urlencode($error));
                exit();               
            }
        }
        if($timeSlot == "12/9/17,8:00am-9:00am"){
            $remain_for_2 = $remain_for_2+1;
            if($remain_for_2>6){
                $error = "This slot is full,please reschedule another slot";
                header("Location: index.php?error=".urlencode($error));
                exit();               
            }
        }
        
        if($timeSlot == "12/9/17,9:00am-10:00am"){
            $remain_for_3 = $remain_for_3+1;
            if($remain_for_3>6){
                $error = "This slot is full,please reschedule another slot";
                header("Location: index.php?error=".urlencode($error));
                exit();               
            }           
        }
        if($timeSlot == "12/9/17,10:00am-11:00am"){
            $remain_for_4 = $remain_for_4+1;
            if($remain_for_4>6){
                $error = "This slot is full,please reschedule another slot";
                header("Location: index.php?error=".urlencode($error));
                exit();               
            } 
        }
        if($timeSlot == "12/9/17,11:00am-12:00am"){
            $remain_for_5 = $remain_for_5+1;
            if($remain_for_5>6){
                $error = "This slot is full,please reschedule another slot";
                header("Location: index.php?error=".urlencode($error));
                exit();               
            }  
        }
        if($timeSlot == "12/9/17,12:00am-13:00am"){
            $remain_for_6 = $remain_for_6+1;
            if($remain_for_6>6){
                $error = "This slot is full,please reschedule another slot";
                header("Location: index.php?error=".urlencode($error));
                exit();               
            }
        }
             
        
        //insert time slot information into database
        $query_timeSlot = "UPDATE timeslot SET remain_1 = '$remain_for_1', remain_2 ='$remain_for_2', remain_3 ='$remain_for_3',remain_4 ='$remain_for_4', remain_5 ='$remain_for_5', remain_6 ='$remain_for_6' WHERE slotID = 1";
        
        
        // Insert student information into database
        $query_student = "INSERT INTO studentinfo (UMID, firstName, lastName, email, projectTitle, phoneNumber, slot)
                    VALUES ('$UMID','$firstName','$lastName','$email','$projectTitle','$phoneNumber','$timeSlot')";
        
        //check if insertion is successful
        if(!mysqli_query($con, $query_student) || !mysqli_query($con, $query_timeSlot)){
            die('Error: '.mysqli_error($con));
        }

        else{
            header("Location: registered.php");
            exit();
        }
            
    }
}
?>
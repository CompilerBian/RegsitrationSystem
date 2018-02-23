<?php include 'database.php';?>
<link rel="stylesheet" href="form.css" type="text/css">
<div class="body-content">
  <div class="module">
    <h1>Project Registration System</h1>
      
      <?php if(isset($_GET['error'])):?>
      <div class = "error"><?php echo $_GET['error']; ?> </div> 
      <?php endif;?>   
 
      <?php if(isset($_GET['UMID'])):?>
            <?php $UMID = $_GET['UMID']; ?>
            <script  type="text/javascript">
              var con;
              con=confirm("Do you want to change your current schedule ?");
              if(con==true){
                  <?php 
                  mysqli_query($con,"delete from studentinfo where UMID = '{$UMID}'");
                  ?>
              }
              else alert("You have registered into the system before!");
          </script>
      <?php endif;?>
      
      <?php 
          $query_1 = mysqli_query($con,"SELECT * FROM timeslot");
          $row = mysqli_fetch_assoc($query_1);
          $remain_1 = $row['remain_1'];
          $remain_2 = $row['remain_2'];
          $remain_3 = $row['remain_3'];
          $remain_4 = $row['remain_4'];
          $remain_5 = $row['remain_5'];
          $remain_6 = $row['remain_6'];
      
      ?>

    
      
    <form class="form" action="process.php" method="post" enctype="multipart/form-data" autocomplete="off">
      <div class="alert alert-error"></div>
      <input type="text" placeholder="UMID" name="UMID" required />
      <input type="text" placeholder="First Name" name="firstName" required />
      <input type="text" placeholder="Last Name" name="lastName" required />
      <input type="text" placeholder="project title" name="projectTitle" required />
      <input type="email" placeholder="Email:" name="email" required />
      <input type="text" placeholder="phone number:xxx-xxx-xxxx" name="phoneNumber"  required />
      <div class = "timeSlot">
          <p style="font-size:18"> Select a time slot: </p>
          <select id="timeSlot"  name = "timeSlot" onchange = "currentTime()">
              <option >12/9/17,7:00am-8:00am remaining: <?php echo 6-$remain_1 ?> seats</option>
              <option>12/9/17,8:00am-9:00am remaining: <?php echo 6-$remain_2 ?> seats</option>
              <option>12/9/17,9:00am-10:00am remaining: <?php echo 6-$remain_3 ?> seats</option>
              <option>12/9/17,10:00am-11:00am remaining: <?php echo 6-$remain_4 ?> seats</option>
              <option>12/9/17,11:00am-12:00am remaining: <?php echo 6-$remain_5 ?> seats</option>
              <option>12/9/17,12:00am-13:00pm remaining: <?php echo 6-$remain_6 ?> seats</option>
          </select>
          <p style="font-size:18">Your selected time slot is : <input type = "text" id = "time" name = "timeSlot" size = "18"></p>
        </div>
      <input type="submit" value="Register" name="register" class="btn btn-block btn-primary" />
    </form>
  </div>
</div>

<script>
    function currentTime(){
        var timeSlot = document.getElementById("timeSlot");
        document.getElementById("time").value = timeSlot.options[timeSlot.selectedIndex].text;
    }
</script>
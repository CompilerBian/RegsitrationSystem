<?php include 'database.php';?>
<?php 
//create select query
    $query = "SELECT * FROM studentinfo";
    $studentInfo = mysqli_query($con, $query);
    $query_1 = "SELECT * FROM timeslot";
    $timeslot = mysqli_query($con, $query_1);
?>
<link rel="stylesheet" href="form.css" type="text/css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!--<div class="body-content">-->
  <div class="module">
    <h1 style="font-size:24px;color:tomato;">You have sucessfully registrated for the project demotration.</h1>
    <div class="tableList">  
      <table class="table">
        <thead>
            <tr class="alter">
              <th>UMID</th>
              <th>Last Name</th>
              <th>First Name</th>
              <th>Project Title</th>
              <th>Phone Number</th>
              <th>Slot</th>
            </tr>
        </thead>
        <tbody>      
            <?php while($row = mysqli_fetch_assoc($studentInfo)){          
                echo "<tr><td>{$row['UMID']}</td> <td>{$row['lastName']}</td> <td>{$row['firstName']}</td> <td>{$row['projectTitle']}</td> <td>{$row['phoneNumber']}</td> <td>{$row['slot']}</td> </tr>";
                
                }
              ?>
        </tbody>
        </table>
    </div>
    <h2 style="font-size:150%; float: right;"><a href="index.php">Back</a></h2>
<!--  </div> -->
<!--</div>-->
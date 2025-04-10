<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['cvmsvid']==0)) {
  header('location:logout.php');
  } else{



  ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Covid Vaccination Management System || Dashboard</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="../admin/css/bootstrap.min.css" />
<link rel="stylesheet" href="../admin/css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="../admin/css/fullcalendar.css" />
<link rel="stylesheet" href="../admin/css/maruti-style.css" />
<link rel="stylesheet" href="../admin/css/maruti-media.css" class="skin-color" />
</head>
<body>
 
<?php include_once('includes/header.php');?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
  </div>
  <div class="container-fluid">
    <div class="quick-actions_homepage">
    <ul class="quick-actions">
          <li>  <?php
$vcenid=$_SESSION['cvmsvcenid'];
$sql1 ="SELECT * from  tblvaccinationbooking where VaccineCenterid='$vcenid' &&  Status is null";
$query1 = $dbh -> prepare($sql1);
$query1->execute();
$results1=$query1->fetchAll(PDO::FETCH_OBJ);
$newvacapp=$query1->rowCount();
?><h6 style="font-size:18px; color:red;">New vaccination Request</h6>
                            <h2><?php echo htmlentities($newvacapp);?></h2> <a href="new-vaccine-booking.php"> <i class="icon-people"></i> View Details </a> </li>

          <li> <?php 
                        $sql2 ="SELECT * from  tblvaccinationbooking where VaccineCenterid='$vcenid' && Status='Vaccinated'";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$results2=$query2->fetchAll(PDO::FETCH_OBJ);
$totvaccinated=$query2->rowCount();
?><h6 style="font-size:18px; color:green;">Vaccinated</h6>
                            <h2><?php echo htmlentities($totvaccinated);?></h2> <a href="vaccination-done.php"> <i class="icon-people"></i> View Details </a> </li>
          <li>
 <?php 
$sql3 ="SELECT * from  tblvaccinationbooking where VaccineCenterid='$vcenid'";
$query3 = $dbh -> prepare($sql3);
$query3->execute();
$results3=$query3->fetchAll(PDO::FETCH_OBJ);
$totapp=$query3->rowCount();
?><h6 style="font-size:18px; color:blue;">Total Request</h6>
                            <h2><?php echo htmlentities($totapp);?></h2> <a href="all-vaccination-booking.php"> <i class="icon-people"></i> View Details </a> </li>
       
         
        </ul>
   </div>
   
   
  </div>
</div>
</div>
</div>
<?php include_once('includes/footer.php');?>
<script src="../admin/js/excanvas.min.js"></script> 
<script src="../admin/js/jquery.min.js"></script> 
<script src="../admin/js/jquery.ui.custom.js"></script> 
<script src="../admin/js/bootstrap.min.js"></script> 
<script src="../admin/js/jquery.flot.min.js"></script> 
<script src="../admin/js/jquery.flot.resize.min.js"></script> 
<script src="../admin/js/jquery.peity.min.js"></script> 
<script src="../admin/js/fullcalendar.min.js"></script> 
<script src="../admin/js/maruti.js"></script> 
<script src="../admin/js/maruti.dashboard.js"></script> 
<script src="../admin/js/maruti.chat.js"></script> 
 

<script type="text/javascript">
  // This function is called from the pop-up menus to transfer to
  // a different page. Ignore if the value returned is a null string:
  function goPage (newURL) {

      // if url is empty, skip the menu dividers and reset the menu selection to default
      if (newURL != "") {
      
          // if url is "-", it is this page -- reset the menu:
          if (newURL == "-" ) {
              resetMenu();            
          } 
          // else, send page to designated URL            
          else {  
            document.location.href = newURL;
          }
      }
  }

// resets the menu selection upon entry to this page:
function resetMenu() {
   document.gomenu.selector.selectedIndex = 2;
}
</script>
</body>
</html>
<?php } ?>
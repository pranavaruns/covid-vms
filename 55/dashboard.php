<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['cvmsaid']==0)) {
  header('location:logout.php');
  } else{



  ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Covid Vaccination Management System || Dashboard</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="css/fullcalendar.css" />
<link rel="stylesheet" href="css/maruti-style.css" />
<link rel="stylesheet" href="css/maruti-media.css" class="skin-color" />
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
          <li> <?php 
                        $sql1 ="SELECT * from  tblvaccinecenter";
$query1 = $dbh -> prepare($sql1);
$query1->execute();
$results1=$query1->fetchAll(PDO::FETCH_OBJ);
$totvaccen=$query1->rowCount();
?>
<h6>Total Vaccine Center</h6>
                            <h2><?php echo htmlentities($totvaccen);?></h2>
                            <a href="manage-vaccine-center.php"> <i class="icon-dashboard"></i> View Details </a> </li>

          <li> <?php 
$sql2 ="SELECT * from  tblvaccinetype";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$results2=$query2->fetchAll(PDO::FETCH_OBJ);
$totvactype=$query2->rowCount();
?><h6>Total Vaccine Type</h6>
                            <h2><?php echo htmlentities($totvactype);?></h2>

           <a href="manage-vaccine-type.php"> <i class="icon-injection"></i> View Details</a> </li>
          <li>
<?php 
                        $sql3 ="SELECT * from  tblvaccinator";
$query3 = $dbh -> prepare($sql3);
$query3->execute();
$results3=$query3->fetchAll(PDO::FETCH_OBJ);
$totvaccinator=$query3->rowCount();
?><h6>Total Vaccinator</h6>
                            <h2><?php echo htmlentities($totvaccinator);?></h2>
           <a href="manage-vaccinator.php"> <i class="icon-people"></i> View Details </a> </li>
          <li>
          <?php 
                        $sql4 ="SELECT * from  tblvaccinationbooking where Status is null";
$query4 = $dbh -> prepare($sql4);
$query4->execute();
$results4=$query4->fetchAll(PDO::FETCH_OBJ);
$newvacapp=$query4->rowCount();
?><h6>New vaccination Request</h6>
                            <h2><?php echo htmlentities($newvacapp);?></h2> <a href="new-vaccine-booking.php"> <i class="icon-people"></i> View Details </a> </li>
          <li> <?php 
                        $sql5 ="SELECT * from  tblvaccinationbooking where Status='Vaccinated'";
$query5 = $dbh -> prepare($sql5);
$query5->execute();
$results5=$query5->fetchAll(PDO::FETCH_OBJ);
$totvaccinated=$query5->rowCount();
?><h6>Total Vaccinated People</h6>
                            <h2><?php echo htmlentities($totvaccinated);?></h2><a href="vaccination-done.php"> <i class="icon-people"></i> View Details </a> </li>

  <li> <?php 
$sql6 ="SELECT * from  tblvaccinationbooking";
$query6 = $dbh -> prepare($sql6);
$query6->execute();
$results6=$query6->fetchAll(PDO::FETCH_OBJ);
$totrequest=$query6->rowCount();
?><h6>Total Vaccination Requests</h6>
                            <h2>
                    <?php echo htmlentities($totrequest);?></h2><a href="all-requests.php"> <i class="icon-people"></i> View Details </a> </li>


        </ul>
   </div>
   
   
  </div>
</div>
</div>
</div>
<?php include_once('includes/footer.php');?>
<script src="js/excanvas.min.js"></script> 
<script src="js/jquery.min.js"></script> 
<script src="js/jquery.ui.custom.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/jquery.flot.min.js"></script> 
<script src="js/jquery.flot.resize.min.js"></script> 
<script src="js/jquery.peity.min.js"></script> 
<script src="js/fullcalendar.min.js"></script> 
<script src="js/maruti.js"></script> 
<script src="js/maruti.dashboard.js"></script> 
<script src="js/maruti.chat.js"></script> 
 

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
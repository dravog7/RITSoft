<?php
include("includes/header.php");
?>
<script>
function getname()
{
	document.getElementById('form2').submit();
}
</script>
<?php
	//This is used for header and side navigation links.

include("includes/sidenav.php");

?>

<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><span style="font-weight:bold;">Add Scholarship Details of Students...
                      
                    </span></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
  
      <form id="form2" name="form2" method="post" action="" enctype="multipart/form-data" class="sear_frm" >
      
	  <div class="form-group ">
      <label for="a_no">Full Admission No:</label>
      <input type="text" class="form-control" id="a_no" name="a_no"   onchange="getname()" >
    </div>
 
          <?php
		 if(isset($_POST['a_no']))
		 {
		 	$ad_no=$_POST['a_no'];
			
		 }
	  ?>
       </form>
	   <form id="form1" name="form1" method="post" action="" enctype="" class="sear_frm">
      
<?php
		//link for connection.php
	include "includes/dboperation.php";
	if($ad_no!=0)
	{
	if(!preg_match('/^([0-9A-Z]+)$/', $ad_no))
	echo "<script>alert('Please input admission number in Capital letter!!')</script>";
	else
	{
	$obj5=new dboperation();
	$query5="SELECT * FROM stud_details WHERE admissionno = '$ad_no' ";	
	$result5=$obj5->selectdata($query5);
	if(mysqli_num_rows($result5)==0)
	{
	   echo "<script> alert('Unknown Admission no...'); </script>";
           echo '<script> location.replace("add_scholarship.php"); </script>';
         }
	while($row=$obj5->fetch($result5))
	{
                // $admno=$row['admissionno'];
		$name=$row['name'];
		//$yrad=("$row[6]");
       // $yradnext=intval($yrad)%100+1;
        //$course=("$row[24]");
 //$course1=("$row[24]");
        $specialisation=$row['branch_or_specialisation'];

	}
	}
	}		
	
?>
      

	<div class="form-row">

 	<div class="form-group col-md-6">
      <label  for="adno">Admission No</label>
	  <input type="text" class="form-control" name="adno" id="adno" value="<?php echo $ad_no?>" readonly>
     </div>
	</div>
      
   
	<div class="form-row">
 	<div class="form-group col-md-6">
      <label  for="name">Name Of Student</label>
	  <input type="text" class="form-control"  name="name" id="name"  value="<?php echo $name?>" readonly>
	</div> </div>
	         
		         
<div class="form-row">
 	<div class="form-group col-md-6">
      <label  for="specialization">Specialization</label>
	  <input type="text" class="form-control"  name="specialization" id="specialization"  value="<?php echo $specialisation?>" readonly>
		</div>
		  
</div>
      
<div class="form-row">
 	<div class="form-group col-md-6">
      <label  for="specialization">Scholarship Name</label>
      
      <?php $obj11=new dboperation();
	$query11="SELECT * FROM scholarship_type";	
	$result11=$obj11->selectdata($query11);
	?>
	
	<?php
	while($row11=$obj11->fetch($result11))
	{     
	      $id=$row11['id']; 
	      $schlname=$row11['schol_name'];
	      
	      ?>
	      
	    <br> <input type="checkbox" name="chk[]" value="<?php echo $id; ?>"><?php echo $schlname; ?><br>
	      
	      <?php
            
	}
	
	?>
	</select>
	  
		</div>	</div>  
<!-- <div class="form-row">
 	<div class="form-group col-md-6">
      <label  for="specialization">Scholarship App Date: </label>
	  <input type="date" class="form-control"  name="sdate" id="sdate"  value="" required>
		</div>
		  
</div> -->



<!-- <div class="form-row">
 	<div class="form-group col-md-6">
      <label  for="specialization">Scholarship Issuing Semester: </label>

<select class="form-control"  name="ssem" id="ssem" required>
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>

</select>
		</div>
		  
</div> 
<div class="form-row">
 	<div class="form-group col-md-6">
      <label  for="specialization">Scholarship category: </label>
	  <input type="text" class="form-control" maxlength="100" name="scat" id="scat"  value="" required>
		</div>
		  
</div> -->

    
      <div align="center">
	   <button type="submit" value="submit" name="submit" id="submit" class="btn btn-primary">Submit Details</button> 
			  </div>

 
</form>
</div>

<?php
if(isset($_POST["submit"]))
{
	
	 $scholid=$_POST['chk']; 
	//$sname=$_POST["sname"];
	$admno=$_POST["adno"];
	//$scategory=$_POST["scat"];
	//$ssem=$_POST["ssem"];
	//$sdate=$_POST["sdate"];
	
	
	for($i=0;$i < sizeof($scholid);$i++)
  { 
 $sql=mysql_query("insert into scholarship(schol_id,studid,schol_status) values ($scholid[$i],'$admno',1)"); 
  }
if($sql)
	  {
		  echo "<script> alert('Scholarship Details added successfully...'); </script>";

                 echo '<script> location.replace("add_scholarship.php"); </script>';

	  }
	  
      else
	  {
echo "<script> alert('Failed...'); </script>";
 echo '<script> location.replace("add_scholarship.php"); </script>';

		 	  }

}

?>

<?php
	// Link for footer.php
include("includes/footer.php");
?>

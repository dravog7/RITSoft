<?php

/*This is used for header and side navigation links......  */
include("includes/header.php");
include("includes/sidenav.php");

?>

<div id="page-wrapper">   
	            <div class="row"><div class="col-lg-12" >
                    <h1 class="page-header"> Scholarship Details</h1>
             </div>
  <?php
//Connecting database 


//..............................................................................
if(isset($_POST['submit']))
{
    $add_no1=$_POST['add_no']; 
    $_SESSION["add_no"]=$_POST['add_no'];
   
}

if(isset($_SESSION["add_no"]))
{

    $con = mysqli_connect("127.0.0.1", "ritsoftv2", "ritsoftv2", "ritsoftv2");
    
    $add_no=$_SESSION["add_no"];				 
    
    //if admission number is entered in the search box then posting add_no....
    
    //fetch from stud details...
   $sql1 = "SELECT * FROM stud_details WHERE admissionno='$add_no'";
    if($result1 = mysqli_query($con, $sql1)){
        if(mysqli_num_rows($result1) > 0){
         while($row1 = mysqli_fetch_array($result1)){
      $admissionno=$row1['admissionno'];
      $name=$row1['name'];
      $gender=$row1['gender'];
      $religion=$row1['religion'];
      $caste=$row1['caste'];	
      $yoa=$row1['year_of_admission'];
      $mobile_phno=$row1['mobile_phno'];
      $address=$row1['address'];
      $branch_or_specialisation=$row1['branch_or_specialisation'];
      $courseid=$row1['courseid'];
      ?><br>
      <br><br>
      
      
      
	<table border="1" align="center" 
           style="background-color: #FFFFFF; width: 955px;" cellpadding="5"><tr><td><label for="adm_no">Admission No:</label></td><td>
	<input type="text" class="form-control" id="text" name="adm_no" value="<?php echo $admissionno?>" readonly>
		</td>
		
		
	<td>
	<label  for="course">Name</label></td><td>			
	<input type="text" class="form-control" id="course1" name="course"  value="<?php echo $name ?>" readonly> 

</td></tr>

	<tr><td><label for="adm_no">Gender:</label></td><td>
	<input type="text" class="form-control" id="text" name="adm_no" value="<?php echo $gender ?>" readonly>
		</td><td>
	<label  for="course">Religion and Caste</label>	</td><td>		
	<input type="text" class="form-control" id="course1" name="course"  value="<?php echo $religion.'/'.$caste ?>" readonly> </td></tr>


	<tr><td>
	<label for="adm_no">Year of admission:</label></td><td>
	<input type="text" class="form-control" id="text" name="adm_no" value="<?php echo $yoa ?>" readonly></td><td>	
	<label  for="course">Mobile No:</label>	</td><td>		
	<input type="text" class="form-control" id="course1" name="course"  value="<?php echo $mobile_phno ?>" readonly> 
</td></tr>
	<tr><td>
	<label for="adm_no">Address:</label></td><td>
	<textarea rows="4" cols="20" class="form-control" id="text" name="adm_no" readonly><?php echo $address?></textarea>
		</td><td>
	<label  for="course">Branch or Specialisation:</label>	</td><td>		
	<input type="text" class="form-control" id="course1" name="course"  value="<?php echo $courseid.'/'.$branch_or_specialisation; ?>" readonly> </td></tr> </table>

	


      
      
      
      
      <?php
     }
    }
    } 
    ?>  
                    <h3 style="color:red;" class="page-header"> Applied Scholarship Details...</h3>
          
             
                <?php
  $sql = "SELECT scholarship.id,schol_name,schol_status FROM scholarship,scholarship_type WHERE studid='$add_no' AND schol_status=1 and scholarship.schol_id=scholarship_type.id ";
    if($result = mysqli_query($con, $sql)){
        if(mysqli_num_rows($result) > 0){
       		
      /*Each results is taken and viewed in a table format based on the admission number......*/
	  
                echo "<br><div class='table-responsive'>
<table class='table table-hover table-bordered'>
     <tr>
        <th>SL.NO:</th>
			<th>Scholarship Name</th>
			<!-- <th>Category</th>
			<th>Issuing semester</th>
			<th>Issuing Date</th> -->
			<th>Status</th>
			<!-- <th>Edit Details</th> -->
			<th>Sanction Scholarship</th>
			<th>Delete</th>
			
    </tr>"; 
	
	/*Fetching Datas and showing in the corresponding feilds in a table format.........*/
	$i=1;
            while($row = mysqli_fetch_array($result)){
            $sid=$row['id'];
            
                                echo "<tr align='centre'>";
				echo "<td align='centre'>" . $i . "</td>";
				//echo "<td align='centre'>" . $sid . "</td>";
				echo "<td align='centre'>" . $row['schol_name'] . "</td>";	
				//echo "<td align='centre'>" . $row['category'] . "</td>";	
				//echo "<td align='centre'>" . $row['issuing_semester'] . "</td>";	
				//echo "<td align='centre'>" . $row['schol_date'] . "</td>";
				$status=$row['schol_status'];
				if($status==1)
				echo "<td align='centre'>" ."APPLIED". "</td>";
				
/*echo '<td><a href="#?sid=<?php echo $sid;?>" ><img border="0" alt="EDIT" src="images/edit.png" width="30" height="30"></a>
</td>';*/
?>
<td><a href="sanction_scholar.php?sid=<?php echo $sid;?>" onclick="return confirm('Are you sure?')" >SANCTION</a></td>

<td><a href="delete_scholar.php?sid=<?php echo $sid;?>" onclick="return confirm('Are you sure?')" >DELETE</a></td>
	<?php			
				
				echo "</tr>";
				$i++;
            }
			echo "</table>"; 
			echo "</div>"; 
            
            // Close result set
            mysqli_free_result($result);
        } else{
            echo "<p>No Recods found</p>";				//if no matches found.....
        }  
}
  ?>
                <h3 style="color:red;" class="page-header"> Sanctioned Scholarship Details...</h3>
          
             
                <?php
  $sql = "SELECT scholarship.id,schol_name,schol_status FROM scholarship,scholarship_type WHERE studid='$add_no' AND schol_status=2 and scholarship.schol_id=scholarship_type.id ";
    if($result = mysqli_query($con, $sql)){
        if(mysqli_num_rows($result) > 0){
       		
      /*Each results is taken and viewed in a table format based on the admission number......*/
	  
                echo "<br><div class='table-responsive'>
<table class='table table-hover table-bordered'>
     <tr>
        <th>SL.NO:</th>
			<th>Scholarship Name</th>
			<!-- <th>Category</th>
			<th>Issuing semester</th>
			<th>Issuing Date</th> -->
			<th>Current Status</th>
			<!-- <th>Edit Details</th> -->
			<th>Cancel</th>
			<th>Change Status</th> 
			
    </tr>"; 
	
	/*Fetching Datas and showing in the corresponding feilds in a table format.........*/
	$i=1;
            while($row = mysqli_fetch_array($result)){
            $sid=$row['id'];
            
                                echo "<tr align='centre'>";
				echo "<td align='centre'>" . $i . "</td>";
				echo "<td align='centre'>" . $row['schol_name'] . "</td>";	
				//echo "<td align='centre'>" . $row['category'] . "</td>";	
				//echo "<td align='centre'>" . $row['issuing_semester'] . "</td>";	
				//echo "<td align='centre'>" . $row['schol_date'] . "</td>";
				$status=$row['schol_status'];
				if($status==2)
				echo "<td align='centre'>" ."Scholarship Sanctioned". "</td>";
				
				/*echo '<td>
<a href="#?sid=<?php echo $sid;?>" ><img border="0" alt="EDIT" src="images/edit.png" width="30" height="30"></a>
</td>';*/

?>
<td><a href="cancel_scholar.php?sid=<?php echo $sid;?>" onclick="return confirm('Are you sure?')" >CANCEL</a></td>

<td><a href="applied_scholar.php?sid=<?php echo $sid;?>" onclick="return confirm('Are you sure?')" >Change Status as APPLIED</a></td> 
	<?php			
		
							
				
				echo "</tr>";
				$i++;
            }
			echo "</table>"; 
			echo "</div>"; 
            
            // Close result set
            mysqli_free_result($result);
        } else{
            echo "<p>No Recods found</p>";				//if no matches found.....
        }  
}
?>

<h3 style="color:red;" class="page-header"> Cancelled Scholarship Details...</h3>
          
             
                <?php
  $sql = "SELECT scholarship.id,schol_name,schol_status FROM scholarship,scholarship_type WHERE studid='$add_no' AND schol_status=0 and scholarship.schol_id=scholarship_type.id ";
    if($result = mysqli_query($con, $sql)){
        if(mysqli_num_rows($result) > 0){
       		
      /*Each results is taken and viewed in a table format based on the admission number......*/
	  
                echo "<br><br><br><div class='table-responsive'>
<table class='table table-hover table-bordered'>
     <tr>
        <th>SL.NO:</th>
			<th>Scholarship Name</th>
			<!-- <th>Category</th>
			<th>Issuing semester</th>
			<th>Issuing Date</th> -->
			<th>Current Status</th>
			<!-- <th>Edit Details</th> -->
			<th>Sanction Again</th>
			<th>Change Status</th> 
			
    </tr>"; 
	
	/*Fetching Datas and showing in the corresponding feilds in a table format.........*/
	$i=1;
            while($row = mysqli_fetch_array($result)){
            $sid=$row['id'];
            
                                echo "<tr align='centre'>";
				echo "<td align='centre'>" . $i . "</td>";
				echo "<td align='centre'>" . $row['schol_name'] . "</td>";	
				//echo "<td align='centre'>" . $row['category'] . "</td>";	
				//echo "<td align='centre'>" . $row['issuing_semester'] . "</td>";	
				//echo "<td align='centre'>" . $row['schol_date'] . "</td>";
				$status=$row['schol_status'];
				if($status==0)
				echo "<td align='centre'>" ."Scholarship Cancelled". "</td>";
				/*echo '<td>
<a href="#?sid=<?php echo $sid;?>" ><img border="0" alt="EDIT"  width="30" height="30"></a>
</td>';*/

?>
<td><a href="sanction_scholar.php?sid=<?php echo $sid;?>" onclick="return confirm('Are you sure?')" >APPROVE AGAIN</a></td>

 <td><a href="applied_scholar.php?sid=<?php echo $sid;?>" onclick="return confirm('Are you sure?')" >Change Status as APPLIED</a></a></td>
	<?php			
		
							
				
				echo "</tr>";
				$i++;
            }
			echo "</table>"; 
			echo "</div>"; 
            
            // Close result set
            mysqli_free_result($result);
        } else{
            echo "<p>No Recods found</p>";				//if no matches found.....
        }  
}


  
 } //first if
  
  
  
  
  
  
//}

//........................................................................................................................



//.........................................................................................................................


?>

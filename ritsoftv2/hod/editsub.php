<?php
include("../connection.php");
	
if (isset($_POST['submit'])) {
   
       $sidp=$_POST['sid'];
	$sub_id=$_POST['subid'];
	$subid=strtoupper($_POST['subid']);
	$name=strtoupper($_POST['name']);
	$classid=$_POST['deptname'];
	$type=strtoupper($_POST['type']);
	$inpass=$_POST['inpass'];
	$inmax=$_POST['inmax'];
	$expass=$_POST['expass'];
	$exmax=$_POST['exmax'];
	


		$sql ="UPDATE  subject_class SET subjectid='$subid',subject_title='$name',classid='$classid',type='$type',internal_passmark='$inpass',internal_mark='$inmax',external_pass_mark='$expass',external_mark='$exmax' where subjectid='$sidp' and classid='$classid'";
		if(mysql_query($sql)== TRUE) { 
?>
		<script type="text/javascript"> alert("Subject Updated Successfully");
		location.replace("subject_view.php");
		</script>
<?php
		}
		else
		{
?>
		<script type="text/javascript"> alert("Failed");
		location.replace("subject_view.php");
        </script> 
<?php	  
	} 
	}
?>
 
    


<?php
session_start();
include("../connection.php");
if (isset($_POST["key"])) {
	if ($_POST["key"]!="") {
		$subjectid=$_POST["key"];
		$stid=$_SESSION['admissionno'];
		$sql=mysql_query("select classid from current_class where studid='$stid'",$con);
if($sql)
{
	$result=mysql_fetch_array($sql);
}
$clid=$result['classid'];

		
		
		
		$l=mysql_query("select name,faculty_details.fid as id from subject_allocation,faculty_details where subject_allocation.fid=faculty_details.fid and subjectid='$subjectid' and subject_allocation.classid='$clid'") or die(mysql_error());
		echo '<label>Faculty</label>';
		echo '<select class="form-control" required="required" name="fac"><option value="">--select--</option>';
		while ($r=mysql_fetch_assoc($l)) {
			echo '<option value="'.$r["id"].'">'.$r["name"].'</option>';
		}
		echo '</select>';
	}
}

?>

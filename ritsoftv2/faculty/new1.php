<?php
//$con=mysqli_connect("localhost","root","","ritsoft2");
include("../connection.php");
//session_start();
//$uname=$_SESSION['fid'];

include("includes/header.php");
include("includes/sidenav.php");



$uname=$_SESSION['fid'];


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Marks</title>
	<script>
		function showsub(str)
		{
			var xmlhttp;
			if (window.XMLHttpRequest)
			{
				xmlhttp=new XMLHttpRequest();
			}
			else
			{
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}

			xmlhttp.open("GET","getsub.php?id="+str,true);
			xmlhttp.send();

			xmlhttp.onreadystatechange=function() 
			{
				if(xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					document.getElementById("sub").innerHTML=xmlhttp.responseText;

				}
			}
		}
	</script>
</head>
<div id="page-wrapper">
	<body>


		<div class="map_contact">
			<div class="container">

				<h3 class="tittle"><center>view sessional mark</center></h3>
				<div class="contact-grids" align="center">

					<div class="col-md-8 contact-grid" style="text-align:center">
						<form method="post" enctype="multipart/form-data" action="new1.php">
							<table  align="center" width="700" style="cellspacing:2px;">
								<tbody>
									<tr><td> Class</td>  <td>  
										<select name="class" class="form-control" onchange="showsub(this.value)">
											<option>select</option>
											<?php
											$c=mysql_query("select distinct(classid) from subject_allocation where fid='$uname'");

											while($res=mysql_fetch_array($c))
											{
												$res1=mysql_query("select * from class_details where classid='$res[classid]' and active='YES'");
												while($rs=mysql_fetch_array($res1))
												{
													?>
													<option value="<?php echo $rs['classid'].",".$rs['courseid'].",S".$rs['semid'].",".$rs['branch_or_specialisation'];?>">
														<?php echo $rs['courseid'];?>,S<?php echo $rs['semid'];?>,<?php echo $rs['branch_or_specialisation'];?></option>
														<?php
													}
												}
												?>
											</select>`
										</td></tr>


										<tr><td>Subject </td> <td><div id="sub">
											<select name="sub" class="form-control" >
												<option>select</option>
											</select>

										</div> </td></tr><tr></tr>
										<tr><td></td><td><input type="submit" name="btnshow" class="btn btn-primary" action="new1.php" value="View Sessional Mark"  />  </td></tr> 
										<form name="form1" method="post">

											<?php
//$con=mysql_connect("localhost","root","","ritsoft2");
											include("../connection.php");
											if(isset($_POST['btnshow']))
											{
												?>
												<div class="table-responsive">
													<table id="talbew" class="table table-hover table-bordered">	
														<tr>
															<td>Roll No</td>
															<td>Name</td>
															<td>Marks</td>
															<td>Remark</td>
														</tr>

														<?php


														$a=explode(",",$_POST['class']);
														$b=explode("-",$_POST['sub']);

														?>
														<input type="hidden" value="<?php echo $_POST['class']; ?>" name="a"/>
														<input type="hidden" value="<?php echo $b; ?>" name="b"/>
														<?php

														if($b[1]=='ELECTIVE')
														{
															$res22=mysql_query("SELECT c.studid,b.name,c.rollno FROM stud_details b,current_class c,elective_student e where c.classid='$a[0]' and c.studid=b.admissionno and e.sub_code='$b[0]' and e.stud_id=c.studid order by c.rollno asc");
															$i=0;
															while($rs=mysql_fetch_array($res22))
															{
																$aid=$rs["studid"];

																$r=mysql_query("select sessional_marks, sessional_remark from sessional_marks where subjectid='$b[0]' and studid='$aid'");
																$x=mysql_fetch_assoc($r);
																?>           
																<tr>
																	<td><?php echo $rs["rollno"]; ?></td>
																	<td><?php echo $rs["name"]; ?></td>
																	<td><?php echo $x["sessional_marks"]; ?></td>
																	<td>  <?php echo $x["sessional_remark"]; ?></td>


																</tr>
																<?php

																$i++;
															}


														}
														else
														{



	//$res=mysqli_query($con,"SELECT a.adm_no,b.name,c.rollno,d.sessional_marks FROM stud_sem_registration a,stud_details b,current_class c,sessional_marks d where a.classid='$a[0]' and a.new_seum='$a[2]' and a.adm_no=b.admissionno and a.classid=c.classid and a.adm_no=c.studid and d.subjectid='$b' and d.studid=b.admissionno order by c.rollno asc");

//	$res=mysql_query("SELECT a.adm_no as adno,b.name,c.rollno FROM stud_sem_registration a,stud_details b,current_class c where a.classid='$a[0]' and a.new_sem='$a[2]' and a.adm_no=b.admissionno and a.classid=c.classid and a.adm_no=c.studid order by c.rollno asc");
															$res=mysql_query("SELECT c.studid,b.name,c.rollno FROM stud_details b,current_class c where c.classid='$a[0]' and c.studid=b.admissionno order by c.rollno asc");

															$i=0;
															while($rs=mysql_fetch_array($res))
															{
																$aid=$rs["studid"];

																$r=mysql_query("select * from sessional_marks where subjectid='$b[0]' and studid='$aid'");
																$x=mysql_fetch_assoc($r);
																?>           
																<tr>
																	<td><?php echo $rs["rollno"]; ?></td>
																	<td><?php echo $rs["name"]; ?></td>
																	<td><?php echo $x["sessional_marks"]; ?></td>
																	<td>  <?php echo $x["sessional_remark"]; ?></td>


																</tr>
																<?php

																$i++;
															}
														}	?>

														<tr>



   <!--- <td><input type="submit" name="submit" value="Enter Mark"/></td>  </tr>---!>
	</table>
        <?php
}
	?>
    </form>


    
          
    <!--<tr><td><!--<input type="submit" name="btnsave" value="save"  /> --> 

    </tr>
</div>
</body>
</table>
</div>

</form>
<button class="btn btn-primary" id="nodatexl">excel</button>
</div>
<form id="gooddnowdatafor" action="html_to_xl.php" method="post" target="_blank" style="display: none;">
	<input type="hidden" name="html">
</form>
</div>

</div>
</div>

<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>

</body>

</html>

<?php

include("includes/footer.php");
?>
<script type="text/javascript">
	$(document).ready(function($) {
		$(document).on('click', '#nodatexl', function(event) {
			event.preventDefault(); 
			$this = $('#talbew'); 
			$html =  $this.html() + ""; 
			$('#gooddnowdatafor').find('input').val( $html );
			$('#gooddnowdatafor').submit();

		});
		
	});


</script>


<?php
if(isset($_GET['sid']))
{

include "../connection.php";
$id=$_GET["sid"];
$sql=mysql_query("select * from scholarship where id=$id");
$r=mysql_fetch_assoc($sql); 
$status=$r['schol_status'];

if($status==1)
{ 
	  
	   $l1=mysql_query("update scholarship set schol_status=2 where id=$id");
	   if($l1)
	   {
		 echo "<script> alert('Updated sucessfully...'); </script>";
                 echo '<script> location.replace("backend-search_scholarship2.php"); </script>';
           }
           
           else
	  {
               echo "<script> alert('Failed...'); </script>";
               echo '<script> location.replace("backend-search_scholarship2.php"); </script>';

          }
           
 }
elseif($status==0)
{ 
	  
	   $l1=mysql_query("update scholarship set schol_status=2 where id=$id");
	   if($l1)
	   {
		 echo "<script> alert('Updated sucessfully...'); </script>";
                 echo '<script> location.replace("backend-search_scholarship2.php"); </script>';
           }
           
           else
	  {
               echo "<script> alert('Failed...'); </script>";
               echo '<script> location.replace("backend-search_scholarship2.php"); </script>';

          }
           
 }
else

{
echo "<script> alert('Failed...'); </script>";
echo '<script> location.replace("backend-search_scholarship2.php"); </script>';
}	  
      
}


?>


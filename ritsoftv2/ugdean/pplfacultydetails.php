<?php
include("includes/header.php");
?>
<!DOCTYPE html>
<?php
include("includes/sidenav.php");
?>
<style type="text/css">
table {
    margin-top: 20px;
    /**border-collapse: collapse;**/
    border-spacing: 35px;
    padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}
}
width: 200%;
/* border: 1px solid #ddd;*/
}

th, td {
    text-align: left;

</style>
<div id="page-wrapper">
 <div class="row">
    <div class="col-lg-12">
       <form method="post" action="excel_single.php">
           <h1 class="page-header"><span style="font-weight:bold;">FACULTY DETAILS
           </span></h1>
       </div>
   </div>


   <?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("127.0.0.1","ritsoftv2","ritsoftv2", "ritsoftv2");



//..............................................................................

$fid=$_SESSION['fid'];
    //$category=$_POST['category'];
$sql = "SELECT * FROM faculty_details WHERE fid='$fid'";
	//echo $sql;
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){

     echo "<table align='center'>";


     while($row = mysqli_fetch_array($result)){

        echo '<tr><td><img src="data:image/jpeg;base64,'.base64_encode( $row['photo'] ).'" width="200" height="200" onerror="this.onerror=null;this.src=\'../vendor/images/default.png\';" /></td>';
        echo '<td> <a style=" position: absolute; top: 10%; right: 3%; " class="btn btn-sm btn-info" href="dash_home.php">BACK</a> </td>';
        echo "<tr>";
        echo "<tr><th>FACULTY ID</th><td>{$row['fid']}</td></tr>";
        echo "<tr><th>NAME</th><td>{$row['name']}</td></tr>";
        echo "<tr><th>DEPTNAME</th><td>{$row['deptname']}</td></tr>";
        echo "<tr><th>PHONENO</th><td>{$row['phoneno']}</td></tr>";
        echo "<tr><th>EMAIL</th><td>{$row['email']}</td></tr>";
        echo "</tr>";
    }
    echo "</table>"; 

            // Close result set
    mysqli_free_result($result);
} else{
    echo "<p>No matches found</p>";
}  
}

?>

</div>
<?php include("includes/footer.php"); ?>
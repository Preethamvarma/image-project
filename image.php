<?php require_once("db.php");?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="style.css">
	<title>Uplaod image and download in PHP and MYSQL database </title>
</head>
<body>

<div class="container_display">
	<table cellpadding="10">
		<tr>
			<th> Image</th>
			<th>Title</th>
		</tr>
		<?php 
		
		if(isset($_POST['submit']))
{

$party_id = $_POST['party_id'];
$leader_id = $_POST['leader_id'];
$img_name = $_POST['img_name'];
$fdate = $_POST['fdate'];
$tdate = $_POST['tdate'];
		
		$res=mysqli_query($conn, "SELECT * FROM image WHERE ( party_id = $party_id AND leader_id = $leader_id ) AND ( date BETWEEN '$fdate' AND '$tdate' ) OR img_name = '$img_name'   ");
	
} else {
	echo 'error loading file';
}

		
		while($row=mysqli_fetch_array($res)) 

			{
				echo '<tr> 
                  <td><img src="upload/'.$row['image'].'" height="200"></td> 
                  <td>'.$row['image'].'</td> 
                  <td><a href="download.php?id='.$row['id'].'"><button class="btn-primary download_btn">Download</button></a>
               
                  </td> 


				</tr>';
			}
		

 ?>
		
	</table>
	</div>

</body>
</html>
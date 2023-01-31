<?php require_once("db.php"); ?>
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

			if (isset($_POST['submit'])) {

				$party_id = @$_POST['party_id'];
				$leader_id = @$_POST['leader_id'];
				$img_name = @$_POST['img_name'];
				$fdate = @$_POST['fdate'];
				$tdate = @$_POST['tdate'];

				// echo '<br />party_id: ' . $party_id;
				// echo '<br />leader_id: ' . $leader_id;
				// echo '<br />img name: ' . $img_name;
				// echo '<br />fdate: ' . $fdate;
				// echo '<br />tdate: ' . $tdate . '<br />';


				// $res = mysqli_query($conn, "SELECT * FROM image WHERE ( party_id = $party_id OR leader_id = $leader_id ) OR ( date BETWEEN '$fdate' AND '$tdate' ) OR img_name = '$img_name'   ");
				$condition = '';

				if ($party_id)
					$condition = $condition . " party_id = $party_id ";

				if ($leader_id) {
					if ($condition) $condition = $condition . " AND leader_id = $leader_id ";
					else $condition = $condition . " leader_id = $leader_id ";
				}

				if ($fdate && $tdate) {
					if ($condition) $condition = $condition . " AND date BETWEEN '$fdate' AND '$tdate' ";
					else $condition = $condition . " date BETWEEN '$fdate' AND '$tdate' ";
				}

				if ($img_name) {
					if ($condition) $condition = $condition . " AND img_name = '$img_name'";
					else $condition = $condition . " img_name = '$img_name'";
				}

				// echo "CONDITION: " . $condition;

				// $res = mysqli_query($conn, "SELECT * FROM image WHERE ( party_id = $party_id OR leader_id = $leader_id ) OR ( date BETWEEN '$fdate' AND '$tdate' ) OR img_name = '$img_name'   ");
				$str = "SELECT * FROM image WHERE " . $condition;

				// echo '<br />' . $str;

				$res = mysqli_query($conn, $str);
			} else {
				echo 'error loading file';
			}


			while ($row = mysqli_fetch_array($res)) {
			?>
				<tr>
					<td><img src="upload/<?php echo $row['image'] ?>" height="200"></td>
					<td><?php echo $row['image'] ?></td>
					<td><a href="download.php?id=<?php echo $row['id']; ?>"><button class="btn-primary download_btn">Download</button></a></td>
				</tr>
			<?php
			}
			?>

		</table>
	</div>

</body>

</html>
<?php
include 'db.php';
if (isset($_POST['submit'])) {
	$extension = array('jpeg', 'jpg', 'png', 'gif');
	foreach ($_FILES['images']['tmp_name'] as $key => $value) {
		$filename = @$_FILES['images']['name'][$key];
		$filename_tmp = @$_FILES['images']['tmp_name'][$key];
		echo '<br>';
		$ext = pathinfo($filename, PATHINFO_EXTENSION);

		$finalimg = '';
		if (in_array($ext, $extension)) {
			if (!file_exists('upload/' . $filename)) {
				move_uploaded_file($filename_tmp, 'upload/' . $filename);
				$finalimg = $filename;
			} else {
				$filename = str_replace('.', '-', basename($filename, $ext));
				$newfilename = $filename . time() . "." . $ext;
				move_uploaded_file($filename_tmp, 'upload/' . $newfilename);
				$finalimg = $newfilename;
			}
			$party_id = @$_POST['party_id'];
			$leader_id = @$_POST['leader_id'];
			$img_name = @$_POST['img_name'];
			$date = @$_POST['date'];
			//insert
			$insertqry = "INSERT INTO image ( party_id, leader_id, img_name, date, image) VALUES ('$party_id','$leader_id','$img_name','$date','$finalimg')";
			mysqli_query($conn, $insertqry);

			header('Location: index.php?message=Image uploaded successfully!');
		} else {
			//display error
		}
	}
}

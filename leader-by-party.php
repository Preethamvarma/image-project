<?php
require_once "db.php";
$party_id = $_POST["party_id"];
$result = mysqli_query($conn,"SELECT * FROM leader where party_id = $party_id");
?>
<option value="">Select Leader</option>
<?php
while($row = mysqli_fetch_array($result)) {
?>
<option value="<?php echo $row["id"];?>"><?php echo $row["name"];?></option>
<?php
}
?>
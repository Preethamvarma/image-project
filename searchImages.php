<?php require_once("db.php"); ?>

<?php

if (isset($_POST['search'])) {

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
    try {
        $res = mysqli_query($conn, $str);

?>
        <div class="image-container">

            <?php

            while ($row = mysqli_fetch_array($res)) {
            ?>
                <div class="card image-card">
                    <img src="upload/<?php echo $row['image'] ?>" alt="image">
                    <div class="image-details">
                        <h5><?php echo $row['image'] ?></h5>
                        <a href="download.php?id=<?php echo $row['id']; ?>"><button class="btn">Download</button></a>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
<?php
    } catch (\Throwable $th) {
        echo "<p class='error'>Atleast one input value is required!</p>";
    }
} else {
    echo "<p class='error'>Invalid action!</p>";
}

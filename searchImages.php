<?php require_once("db.php"); ?>

<?php

if (isset($_POST['search'])) {

    $party_id = @$_POST['party_id'];
    $leader_id = @$_POST['leader_id'];
    $img_name = @$_POST['img_name'];
    $fdate = @$_POST['fdate'];
    $tdate = @$_POST['tdate'];
    $skip = @$_POST['skip'] ?  @$_POST['skip'] : 0;
    $limit = @$_POST['limit'] ? @$_POST['limit'] : 25;

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

    $str = "SELECT *, (SELECT count(i.id) FROM image i where" . $condition . ") as rowsCount FROM image where" . $condition . "LIMIT " . $skip . " , " . $limit;

    try {
        $res = mysqli_query($conn, $str);

        $response["rowsCount"] = 0;
        $response["data"] = [];
        $counter = 0;

        while ($row = mysqli_fetch_array($res)) {
            if ($counter === 0) $response["rowsCount"] = $row["rowsCount"];
            $response["data"][$counter]["id"] = $row["id"];
            $response["data"][$counter]["image"] = $row["image"];
            $response["data"][$counter]["img_name"] = $row["img_name"];
            $counter++;
        }
        $response["totalRecords"] = $counter;
        echo json_encode($response);
    } catch (\Throwable $th) {
        echo null;
    }
} else {
    echo null;
}

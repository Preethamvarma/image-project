<!DOCTYPE html>
<html lang="en">

<head>
  <title>TS Intelligence</title>
  <?php require_once("./includes/headerLinks.php"); ?>

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    html,
    body {
      background-color: lightgoldenrodyellow;
      color: black;
      font-family: 'Nunito', sans-serif;
      font-weight: 200;
      margin: 0;
      padding: 0;
    }

    div.container {
      width: auto;
      margin: 0 auto;
      padding: 10px 20px;
    }

    div.form-group {
      margin-bottom: 0;
    }

    .full-height {
      height: 100vh;
    }

    .flex-center {
      align-items: center;
      display: flex;
      justify-content: center;
    }

    .position-ref {
      position: relative;
    }

    .top-right {
      position: absolute;
      right: 10px;
      top: 18px;
    }

    .content {
      text-align: center;
    }

    .title {
      font-size: 84px;
    }

    .links>a {
      color: #636b6f;
      padding: 0 25px;
      font-size: 13px;
      font-weight: 600;
      letter-spacing: .1rem;
      text-decoration: none;
      text-transform: uppercase;
    }

    .btn {
      color: #fff;
      padding: 5px 20px;
      font-size: 13px;
      font-weight: 600;
      letter-spacing: .1rem;
      text-decoration: none;
      text-transform: uppercase;
      background-color: #007bff;
    }

    .m-b-md {
      margin-bottom: 30px;
    }

    .error {
      color: red
    }

    .card {
      width: 100%;
    }

    .card-body {
      display: grid;
      grid-template-columns: auto auto auto;
      gap: 15px;
    }


    .search-box {
      display: flex;
      align-items: end;
    }

    div.search-box .btn {
      margin: 0px;
    }

    #data-container {
      padding: 5px 20px;
    }

    .image-container {
      display: grid;
      grid-template-columns: auto auto auto;
      gap: 15px;
    }

    .image-card {
      padding: 1rem
    }

    .image-card img {
      width: 100%;
      height: 150px;
      object-fit: cover;
      border-radius: 3px;
    }

    .image-card h5 {
      margin: 10px 0;
      font-weight: 700;
      font-size: 1rem;
    }


    /*

0 - 600px :       Phone
600px - 900px :   Tablet portrait
900px - 1200px :  Tablet landscape

[1200px - 1800px] : is where our normal css will be applied

1800 + :          Big desktop

*/


    @media only screen and (max-width: 600px) {

      .card-body,
      .image-container {
        grid-template-columns: auto;
        padding: 10px;
        gap: 10px
      }

      div.search-box .btn {
        margin-top: 16px;
      }
    }

    @media only screen and(max-width: 900px) {
      .image-details .btn {
        padding: 5px 10px;
        font-size: 12px;
      }
    }

    @media only screen and (max-width: 1200px) {}

    @media only screen and (min-width: 1800px) {}
  </style>
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="card">
        <div class="card-header">
          <h2 class="text-success"><strong>TELANGANA STATE POLICE, INTELLIGENCE</strong></h2>
        </div>
        <div class="card-body">
          <div class="form-group">
            <label for="party">Name of the Party</label>
            <select class="form-control" id="party-dropdown" name="party_id">
              <option value="">Select party</option>
              <?php
              require_once "db.php";
              $result = mysqli_query($conn, "SELECT * FROM party");
              while ($row = mysqli_fetch_array($result)) {
              ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row["name"]; ?></option>
              <?php
              }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label for="leader">Name of the Leader</label>
            <select class="form-control" id="leader-dropdown" name="leader_id">
            </select>
          </div>
          <div class="form-group">
            <label for="name">Name of the Image</label>
            <input type="text" class="form-control" id="img_name" name="img_name">
          </div>
          <div class="form-group">
            <label for="date">From Date</label>
            <input type="date" class="form-control" id="fdate" name="fdate">
          </div>
          <div class="form-group">
            <label for="date">To Date</label>
            <input type="date" class="form-control" id="tdate" name="tdate">
          </div>
          <div class="form-group search-box">
            <button type="button" class="btn" onclick="searchImages()">Search Images</button>
          </div>
        </div>
        <div id="data-container"></div>
      </div>
    </div>
  </div>
  </div>
  <?php require_once("./includes/scripts.php"); ?>
  <script>
    $(document).ready(function() {
      $('#party-dropdown').on('change', function() {
        var party_id = this.value;
        $.ajax({
          url: "leader-by-party.php",
          type: "POST",
          data: {
            party_id: party_id
          },
          cache: false,
          success: function(result) {
            $("#leader-dropdown").html(result);
          }
        });
      });
      $('#leader-dropdown').on('change', function() {
        var leader_id = this.value;
      });
    });
  </script>

  <script type="text/javascript">
    function searchImages() {
      const party_id = $("#party-dropdown").val();
      const leader_id = $("#leader-dropdown").val();
      const image_name = $("#img_name").val();
      const fdate = $("#fdate").val();
      const tdate = $("#tdate").val();
      $.ajax({
        url: "./searchImages.php",
        type: "POST",
        data: {
          search: true,
          party_id,
          leader_id,
          image_name,
          fdate,
          tdate
        },
        success: function(res) {
          if (res) {
            $("#data-container").html(res)
          }
        },
        error: function(error) {
          $("#data-container").html(error)
        }
      })

    }
  </script>

</body>

</html>
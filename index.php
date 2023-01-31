<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>TS Intelligence</title>
  <?php require_once("./includes/headerLinks.php"); ?>

  <style>
    html,
    body {
      background-color: lightgoldenrodyellow;
      color: black;
      font-family: 'Nunito', sans-serif;
      font-weight: 200;
      height: 150vh;
      margin: 0;
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

    .btn {
      color: #fff;
      padding: 5px 25px;
      font-size: 13px;
      font-weight: 600;
      letter-spacing: .1rem;
      text-decoration: none;
      text-transform: uppercase;
      background-color: #007bff;
      margin-bottom: 16px;
    }

    a.link {
      color: #0062cc;
      font-size: 12px;
      font-weight: 600;
      text-decoration: underline;
    }

    .m-b-md {
      margin-bottom: 30px;
    }
  </style>
</head>

<body>
  <div class="container mt-5">
    <div class="row">
      <div class="card">
        <div class="card-header">
          <h2 class="text-success"><strong>TELANGANA STATE POLICE, INTELLIGENCE</strong></h2>
        </div>
        <div class="card-body">
          <form action="upload.php" method="post" enctype="multipart/form-data">
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


              <label for="name">Name of the Image</label><br>
              <input type="text" id="img_name" name="img_name"><br><br>
              <label for="date">Please select your Date</label><br>
              <input type="date" id="date" name="date"><br>
            </div>
            <div class="form-group">
              <div class="input-images"></div>
            </div>
            <button type="submit" class="btn" name="submit">Upload</button>
          </form>
          <a href="search.php" class="link">Search Images</a>
        </div>
      </div>
    </div>
  </div>
  </div>

  <?php require_once("./includes/scripts.php"); ?>
  <!-- image uploader -->
  <script type="text/javascript" src="./plugins/drag-drop-image-uploader/dist/image-uploader.min.js"></script>
  <!-- image uploader -->
  <script>
    $(".input-images").imageUploader();
  </script>

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
</body>

</html>
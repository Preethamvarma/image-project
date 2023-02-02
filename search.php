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
      margin: 5px 20px;
      margin-bottom: 11vh;
      padding: 15px;
      min-height: 40vh;
      border: 1px dashed #ccc;
    }

    #data-container .default-text {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100%;
      color: green;
      font-weight: bold;
    }

    .image-container {
      display: grid;
      grid-template-columns: auto auto auto auto;
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

    /** PAGINATION */
    .section-pagination {
      position: fixed;
      bottom: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      left: 0;
      right: 0
    }

    #pagination-nav {
      box-shadow: 0px 1px 3px rgba(0, 0, 0, .5);
      border: 1px solid #f2f2f2;
      padding: 5px 15px;
      position: relative;
      width: auto;
      background-color: #fff;
    }

    #pagination-nav .pagination {
      margin: 0;
    }

    #rowsPerPage {
      width: auto
    }

    /** PAGINATION */


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
        grid-template-columns: auto !important;
        padding: 10px;
        gap: 10px
      }

      div.search-box .btn {
        margin-top: 16px;
      }

      .section-pagination {
        left: 25px;
        right: 25px;
      }

      #pagination-nav {
        flex-direction: column;
        width: 100%
      }

      #pagination-nav ul.pagination {
        margin-top: 10px;
        margin-bottom: 10px;
      }

      #data-container {
        margin-bottom: 20vh;
      }
    }

    @media only screen and(max-width: 900px) {
      .image-details .btn {
        padding: 5px 10px;
        font-size: 12px;
      }
    }

    @media only screen and (max-width: 1200px) {
      .image-container {
        grid-template-columns: auto auto auto;
      }
    }

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
        <div id="data-container">
          <div class="default-text">Please apply filter to show the records</div>
        </div>
        <section class="section-pagination">
          <nav id="pagination-nav" aria-label="Page navigation" class="d-flex align-items-center container">
            <div class="page-sizes mr-4">
              <div class="form-group d-flex align-items-center">
                <label for="rowsPerPage" class="mr-2 mb-0">Rows</label>
                <select class="form-control" id="rowsPerPage" name="rowsPerPage" onchange="onRowsPerPageChange()">
                  <option value="25">25</option>
                  <option value="50">50</option>
                  <option value="100">100</option>
                </select>
              </div>
            </div>
            <ul class="pagination"></ul>
            <div class="ml-4" id="pageStatus">Showing 10 to 20</div>
          </nav>
        </section>
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
    const element = document.querySelector("#pagination-nav ul.pagination");
    let rowsCount = 0;
    let totalRecords = 0;
    let rowsPerPage = 25;
    let currentPage = 1;
    let totalPages = rowsCount / rowsPerPage;

    element.innerHTML = createPagination(totalPages, currentPage);

    function updatePage(page) {
      if (page > 0 && page <= totalPages) {
        currentPage = page;
        createPagination(totalPages, currentPage);
        searchImages();
      }
    }

    function createPagination(totalPages, currentPage) {
      // if (currentPage < 1 || currentPage > totalPages) return ""

      let liTag = '';
      let active;
      let beforePage = currentPage - 1;
      let afterPage = currentPage + 1;

      liTag += `<li class="page-item" onclick="updatePage(${currentPage - 1})"><span class="page-link">&#8826;&#8826;</span></li>`;

      if (currentPage > 2 && totalPages > 4) {
        liTag += `<li class="page-item" onclick="updatePage(1)"><span class="page-link">1</span></li>`;
        if (currentPage > 3) liTag += `<li class="page-item"><span class="page-link">...</span></li>`;
      }

      if (currentPage == totalPages) beforePage = beforePage - 2;
      else if (currentPage == totalPages - 1) beforePage = beforePage - 1;

      if (currentPage == 1) afterPage = afterPage + 2;
      else if (currentPage == 2) afterPage = afterPage + 1;

      for (var plength = beforePage; plength <= afterPage; plength++) {
        if (plength > totalPages) continue;

        if (plength == 0) plength = plength + 1;

        if (currentPage == plength) active = "active";
        else active = "";

        if (plength > 0) liTag += `<li class="page-item ${active}" onclick="updatePage(${plength})"><span class="page-link">${plength}</span></li>`;
      }

      if (currentPage < totalPages - 1 && totalPages > 4) {
        if (currentPage < totalPages - 2) liTag += `<li class="page-item"><span class="page-link">...</span></li>`;
        liTag += `<li class="page-item" onclick="updatePage(${totalPages})"><span class="page-link">${totalPages}</span></li>`;
      }

      liTag += `<li class="page-item ${currentPage >= totalPages ? 'disable' : ''}" onclick="updatePage(${currentPage + 1})"><span class="page-link">&#8827;&#8827;</span></li>`;

      element.innerHTML = liTag;
      const from = rowsPerPage * (currentPage - 1);
      $("#pageStatus").text(`Showing ${rowsCount ? from + 1 : 0 } - ${rowsCount ? totalRecords : 0} of ${rowsCount}`);

      return liTag;
    }

    function onRowsPerPageChange() {
      rowsPerPage = parseInt($("#rowsPerPage").val(), 10);
      totalPages = rowsCount / rowsPerPage;
      updatePage(1)
    }

    function createCard(id, image, img_name) {
      return `<div class="card image-card">
                    <img src="upload/${image}" alt="image">
                    <div class="image-details">
                        <h5>${img_name}</h5>
                        <a href="download.php?id=${id}"><button class="btn">Download</button></a>
                    </div>
                </div>`;
    }

    function searchImages() {
      let skip = rowsPerPage * (currentPage - 1) || 0;
      let limit = rowsPerPage || 25;

      const party_id = $("#party-dropdown").val();
      const leader_id = $("#leader-dropdown").val();
      const img_name = $("#img_name").val();
      const fdate = $("#fdate").val();
      const tdate = $("#tdate").val();

      $.ajax({
        url: "./searchImages.php",
        type: "POST",
        dataType: "json",
        data: {
          search: true,
          party_id,
          leader_id,
          img_name,
          fdate,
          tdate,
          skip,
          limit
        },
        success: function(res) {
          if (res) {
            rowsCount = res.rowsCount || 0;
            totalRecords = res.totalRecords || 0;
            totalPages = Math.ceil(rowsCount / rowsPerPage);

            let ele = '';
            res.data?.forEach((item, i) => {
              ele += createCard(item.id, item.image, item.img_name)
            })
            $("#data-container").html(`<div class="image-container">${ele}</div>`);
            createPagination(totalPages, currentPage)
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
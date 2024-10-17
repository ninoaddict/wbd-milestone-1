<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/public/css/preflight.css">
  <link rel="stylesheet" href="/public/css/globals.css">
  <link rel="stylesheet" href="/public/css/navbar.css">
  <link rel="stylesheet" href="/public/css/vacancy.css">
  <title>Vacancy Details</title>
</head>

<body>
  <?php include dirname(__DIR__) . '/components/Navbar.php' ?>
  <main>
    <div class="content-separator">
      <div class="delete-or-close">
        <div class="close-button">
          <button type="input" id="close-or-opener"><?= $data['is_open']?></button>
        </div>
        <div class="delete-button">
          <button type="input" id="deleter">Delete Job</button>
        </div>
        <div class="add-button">
          <a href="../tambahlowongan">Add Job</a>
        </div>
      </div>
      <div class="actual-container">
        <section class="container-job">
          <h1><b class="job-title"><?= $data['posisi']?></b></h1>
          <h2 class="descript-title">Description:</h2>
          <h3 class="job-description">
            <?= htmlspecialchars_decode($data['deskripsi'])?>
          </h3>
          <h2 class="job-requirement">Company:</h2>
          <h3><?= $data['company_name']?></h3>
          <h2 class="job-requirement">Location:</h2>
          <h3><?= $data['jenis_lokasi']?></h3>
          <h2 class="job-requirement">Job Type:</h2>
          <h3><h3><?= $data['jenis_pekerjaan']?></h3></h3>
        </section>
        <section class="container-taker">
          <h1><b class="job-title">Job Takers</b></h1>
          <div class="scrollable-div">
            <!-- Add content here -->
            <div class="container-person">
              <div class="person-name">
                Name: Patricio Estrello
              </div>
              <div class="status-and-details">
                <div class="container-status">
                  Status: Gay
                </div>
                <div class="details-link">
                  <a href="../detaillamaran">See Details</a>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </main>
  <script src="../../public/js/DetailLowonganVacancy.js"></script>
</body>

</html>
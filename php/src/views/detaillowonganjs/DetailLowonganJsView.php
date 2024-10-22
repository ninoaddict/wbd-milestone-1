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
      <div class="actual-container">
        <section class="container-job-jsversion">
          <h1><b class="job-title"><?= $data['0']['posisi']?></b></h1>
          <h2 class="descript-title">Description:</h2>
          <h3 class="job-description">
            <?= htmlspecialchars_decode($data['0']['deskripsi'])?>
          </h3>
          <h2 class="job-requirement">Company:</h2>
          <h3><?= $data['0']['company_name']?></h3>
          <h2 class="job-requirement">Location:</h2>
          <h3><?= $data['0']['jenis_lokasi']?></h3>
          <h2 class="job-requirement">Job Type:</h2>
          <h3><h3><?= $data['0']['jenis_pekerjaan']?></h3></h3>
          <h2 class="job-requirement">Status:</h2>
          <h3><?= $data['status']?></h3>
          <div class="flexing-apply">
            <?php 
              if ($data["status"] == "Available") {
                echo <<<HTML
                      <a href='/lowongan/{$data["0"]["lowongan_id"]}/apply' id="apply-job-style">Apply Job</a>
                    HTML;
              }
            ?>
          </div>
        </section>
        <section class="container-attach">
        <h1><b class="attachment">Attachments</b></h1>
        <?php 
          if ($data["status"] == "Accepted" || $data["status"] == "Rejected" || $data["status"] == "Waiting") {
            echo '<div class="cv-or-vid">
                <button type="button" id="view-cv">View CV</button>
                <button type="button" id="view-vid">View Video</button>
                <a id="download">Download</a>
                <a id="see">New Tab</a>
              </div>
              <div id="pdf-vid-show">
              </div>
              </div>';
          } else {
            echo '<div class="cv-or-vid"><h3>You can only see the attachments after applying for this job!</h3></div>';
          }
        ?>
        </section>
      </div>
    </div>
    <div id="pdf-embed">
      <?= $data['cv_path']?>
    </div>
    <div id="video-embed">
    <?= $data['video_path']?>
    </div>
  </main>
  <script src="../../public/js/DetailLowonganJsVacancy.js"></script>
</body>

</html>
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
    <div class="content-separator-jsversion">
      <div class="actual-container-jsversion">
        <section class="container-job-jsversion">
          <h1><b class="job-title"><?= $data['0']['posisi']?></b></h1>
          <h2 class="descript-title">Description:</h2>
          <h3 class="job-description">
            <?= htmlspecialchars_decode($data['0']['deskripsi'])?>
          </h3>
          <h2 class="job-requirement">Company:</h2>
          <h3><?= $data['0']['company_name']?></h3>
          <h2 class="job-requirement">Location Type:</h2>
          <h3><?= $data['0']['jenis_lokasi']?></h3>
          <h2 class="job-requirement">Job Type:</h2>
          <h3><h3><?= $data['0']['jenis_pekerjaan']?></h3></h3>
          <h2 class="job-requirement">Status:</h2>
          <h3><?= $data['status']?></h3>
          <h4><?= html_entity_decode($data['status_reason'])?></h4>
          <?php 
            if ($data['file_path']) {
            echo '<h2 class="job-requirement">Attachments:</h2>';
            }
          ?>
          <div class="attachment-placement">
            <?php 
              if ($data['file_path']) {
                $file_name = [];
                $file_path = [];
                foreach ($data['file_path'] as $files) {
                  array_push($file_path, $files);
                  array_push($file_name, substr($files,15));
                }
                for ($i = 0; $i < count($file_name); $i++) {
                  echo <<<HTML
                    <a class="embed-file-style" href="$file_path[$i]">{$file_name[$i]}</a>
                  HTML;
                }
              }
            ?>
          </div>
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
        <section class="company-profile">
          <h1><b class="attachment">About The Company</b></h1>
          <h2><?php echo $data['company_detail']['nama']?></h2>
          <h3>Location: <?php echo $data['company_detail']['lokasi']?></h3>
          <h4><?php echo $data['company_detail']['about']?></h4>
        </section>
        <section class="container-attach">
        <h1><b class="attachment">My Attachments</b></h1>
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
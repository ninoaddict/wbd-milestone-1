<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Detail lowongan for company">
  <meta name="keywords" content="job, apply, vacancy, linkedin, Linkedin">
  <link rel="stylesheet" href="/public/css/preflight.css">
  <link rel="stylesheet" href="/public/css/globals.css">
  <link rel="stylesheet" href="/public/css/navbar.css">
  <link rel="stylesheet" href="/public/css/vacancy.css">
  <link rel="stylesheet" href="/public/css/toast.css">
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
          <a href="../editlowongan" id="editer">Edit Job</a>
        </div>
      </div>
      <div class="actual-container">
        <section class="container-job">
          <h1 id="position"><?= $data['posisi']?></h1>
          <h2 class="descript-title">Description:</h2>
          <h3 class="job-description">
            <?= htmlspecialchars_decode($data['deskripsi'])?>
          </h3>
          <h2 class="job-requirement">Company:</h2>
          <h3><?= $data['company_name']?></h3>
          <h2 class="job-requirement">Location:</h2>
          <h3><?= $data['jenis_lokasi']?></h3>
          <h2 class="job-requirement">Job Type:</h2>
          <h3><?= $data['jenis_pekerjaan']?></h3>
          <h2 class="job-requirement">Attachments:</h2>
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
                    <img src="$file_path[$i]" class="image-file-style"/>
                  HTML;
                }
              }
            ?>
          </div>
        </section>
        <section class="container-taker">
          <h1>Job Takers</h1>
          <div class="scrollable-div">
            <?php 
              foreach ($data['lamaran'] as $lamarans) {
                echo <<<HTML
                  <div class='container-person'>
                    <div class='status-and-name'>
                      <div class='person-name'>
                        <p>Name: {$lamarans['nama']}</p>
                      </div>
                      <div class='container-status'>
                        Status: {$lamarans['status']}
                      </div>
                    </div>
                    <div class='details-placement'>
                      <div class='details-link'>
                        <a href='../lamaran/{$lamarans["lamaran_id"]}'>See Details</a>
                      </div>
                    </div>
                  </div>
                HTML;
              }
            ?>
          </div>
          <div class="export-container">
            <button id="button-csv">Export CSV</button>
          </div>
          <div id="embed-csv">
            <?= json_encode($data['lamaran']);?>
          </div>
        </section>
      </div>
    </div>
  </main>
  <ul class="notifications"></ul>
  <script src="../../public/js/DetailLowonganVacancy.js"></script>
  <script src="/public/js/toast.js" defer></script>
  <?php if (isset($successMessage)): ?>
    <script defer>
      window.addEventListener('load', (event) => {
        createToast('success', '<?php echo $successMessage?>');
      });
    </script>
  <?php endif; ?>
</body>

</html>
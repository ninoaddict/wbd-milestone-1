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
          <a href="../editlowongan" id="editer">Edit Job</a>
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
          <h2 class="job-requirement">Attachments:</h2>
          <div class="attachment-placement">
            <?php 
              if (count($data['file_path']) > 0) {
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
        </section>
        <section class="container-taker">
          <h1><b class="job-title">Job Takers</b></h1>
          <div class="scrollable-div">
            <!-- Add content here -->
            <?php 
              foreach ($data['lamaran'] as $lamarans) {
                echo <<<HTML
                  <div class='container-person'>
                    <div class='person-name'>
                      Name: {$lamarans['nama']}
                    </div>
                    <div class='status-and-details'>
                      <div class='container-status'>
                        Status: {$lamarans['status']}
                      </div>
                      <div class='details-link'>
                        <a href='../lamaran/{$lamarans["lamaran_id"]}'>See Details</a>
                      </div>
                    </div>
                  </div>
                HTML;
              }
            ?>
          </div>
        </section>
      </div>
    </div>
  </main>
  <script src="../../public/js/DetailLowonganVacancy.js"></script>
</body>

</html>
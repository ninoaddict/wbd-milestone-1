<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Edit lowongan">
  <meta name="keywords" content="job, apply, vacancy, linkedin, Linkedin">
  <link rel="stylesheet" href="/public/css/preflight.css">
  <link rel="stylesheet" href="/public/css/globals.css">
  <link rel="stylesheet" href="/public/css/navbar.css">
  <link rel="stylesheet" href="/public/css/addvacancy.css">
  <link rel="stylesheet" href="/public/css/toast.css">
  <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
  <title>Edit Job</title>
</head>

<body>
  <?php include dirname(__DIR__) . '/components/Navbar.php' ?>
  <main>
    <div class="content-separator">
      <div class="add-actual-container">
        <form class="container-add-job" id="uploadForm" enctype="multipart/form-data">
          <div class="add-job-title">
            Edit Job
          </div>
          <div class="form-flex-structure">
            <div class="form-structure">
              <label for="job-name" class="input-name-style">Job Name</label>
              <input type="text" class="input-style" id="job-name" value="<?= $data['posisi'] ?>" required />
            </div>
            <div class="form-structure">
              <p for="requirements" class="input-name-style">Company Name</p>
              <div class="input-style" id="requirements"><?= $data['company_name'] ?></div>
            </div>
          </div>
          <div class="form-flex-structure">
            <div class="form-structure">
              <label for="location" class="input-name-style">Location</label>
              <select id="location" class="input-style" value="<?= $data['jenis_lokasi'] ?>">
                <option value="on-site" <?php if ($data['jenis_lokasi'] == "on-site")
                  echo "selected" ?>>On-Site</option>
                  <option value="hybrid" <?php if ($data['jenis_lokasi'] == "hybrid")
                  echo "selected" ?>>Hybrid</option>
                  <option value="remote" <?php if ($data['jenis_lokasi'] == "remote")
                  echo "selected" ?>>Remote</option>
                </select>
              </div>
              <div class="form-structure">
                <label for="job-type" class="input-name-style">Job Type</label>
                <select id="job-type" class="input-style" value="<?= $data['jenis_pekerjaan'] ?>">
                <option value="full-time" <?php if ($data['jenis_pekerjaan'] == "full-time")
                  echo "selected" ?>>Full-Time
                  </option>
                  <option value="part-time" <?php if ($data['jenis_pekerjaan'] == "part-time")
                  echo "selected" ?>>Part-Time
                  </option>
                  <option value="internship" <?php if ($data['jenis_pekerjaan'] == "internship")
                  echo "selected" ?>>
                    Internship</option>
                </select>
              </div>
            </div>
            <div class="form-flex-structure">
              <div class="form-structure">
                <label for="status" class="input-name-style">Status</label>
                <select id="status" class="input-style" value="<?= $data['is_open'] ?>">
                <option value="Open" <?php if ($data['is_open'] == "Open")
                  echo "selected" ?>>Open</option>
                  <option value="Closed" <?php if ($data['is_open'] == "Close")
                  echo "selected" ?>>Closed</option>
                </select>
              </div>
            </div>
            <div class="form-flex-structure">
              <div class="form-structure">
                <label for="attachment-upload" class="input-name-style">Attachments</label>
                <input type="file" accept="image/jpg, image/jpeg, image/png" multiple id="attachment-upload"
                  name="files[]" />
              </div>
            </div>
            <div class="form-flex-quill">
              <label class="input-name-style">Description</label>
              <div id="editor">
              <?php echo html_entity_decode($data['deskripsi']) ?>
            </div>
          </div>
          <div class="button-add-style">
            <button id="form-submit" class="button-style">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </main>
  <ul class="notifications"></ul>
  <script src="/public/js/toast.js" defer></script>

  <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
  <script src="../../public/js/initQuill.js"></script>
  <script src="../../public/js/editLowongan.js"></script>
</body>

</html>
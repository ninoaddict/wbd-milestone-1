<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Page for adding vacancy">
  <meta name="keywords" content="job, apply, vacancy, LinkinPurry">
  <link rel="stylesheet" href="/public/css/preflight.css">
  <link rel="stylesheet" href="/public/css/toast.css">
  <link rel="stylesheet" href="/public/css/globals.css">
  <link rel="stylesheet" href="/public/css/navbar.css">
  <link rel="stylesheet" href="/public/css/addvacancy.css">
  <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
  <title>Add Job</title>
</head>

<body>
  <?php include dirname(__DIR__) . '/components/Navbar.php' ?>
  <main>
    <div class="content-center">
      <div class="add-actual-container">
        <form class="container-add-job" id="uploadForm" enctype="multipart/form-data">
          <div class="add-job-title">
            Add Job
          </div>
          <div class="form-flex-structure">
            <div class="form-structure">
              <label for="job-name" class="input-name-style">Job Name</label>
              <input type="text" class="input-style" id="job-name" required />
            </div>
            <div class="form-structure">
              <p class="input-name-style">Company Name</p>
              <div id="requirements" class="input-style"><?php echo $data ?></div>
            </div>
          </div>
          <div class="form-flex-structure">
            <div class="form-structure">
              <label for="location" class="input-name-style">Location</label>
              <select id="location" class="input-style">
                <option value="on-site">On-Site</option>
                <option value="hybrid">Hybrid</option>
                <option value="remote">Remote</option>
              </select>
            </div>
            <div class="form-structure">
              <label for="job-type" class="input-name-style">Job Type</label>
              <select id="job-type" class="input-style">
                <option value="full-time">Full-Time</option>
                <option value="part-time">Part-Time</option>
                <option value="internship">Internship</option>
              </select>
            </div>
          </div>
          <div class="form-flex-structure">
            <div class="form-structure">
              <label for="status" class="input-name-style">Status</label>
              <select id="status" class="input-style">
                <option value="Open">Open</option>
                <option value="Closed">Closed</option>
              </select>
            </div>
          </div>
          <div class="form-flex-structure">
            <div class="form-structure">
              <label for="attachment-upload" class="input-name-style">Attachments</label>
              <input type="file" accept="image/jpeg, image/jpg, image/png" multiple id="attachment-upload"
                name="files[]" />
            </div>
          </div>
          <div class="form-flex-quill">
            <label class="input-name-style">Description</label>
            <div id="editor">
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
  <?php if (isset($errorMessage)): ?>
    <script defer>
      window.addEventListener('load', (event) => {
        createToast('error', '<?php echo $errorMessage?>');
      });
    </script>
  <?php endif; ?>

  <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
  <script src="../../public/js/addLowongan.js"></script>

  <script>
    const quill = new Quill('#editor', {
      theme: 'snow'
    });
  </script>
</body>

</html>
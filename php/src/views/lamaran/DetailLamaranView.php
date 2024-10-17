<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/public/css/preflight.css">
  <link rel="stylesheet" href="/public/css/globals.css">
  <link rel="stylesheet" href="/public/css/navbar.css">
  <link rel="stylesheet" href="/public/css/detaillamaran.css">
  <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />

  <title>Detail Lamaran</title>
</head>

<body>
  <?php include dirname(__DIR__) . '/components/Navbar.php' ?>
  <main>
    <div class="card info-card">
      <div class="card-container">
        <div class="card-detail">
          <h1 class="card-detail-name">
            Adril Putra Merin
          </h1>
        </div>
        <div class="card-detail-info">
          <h2 class="card-detail-email">
            Email: adrilbless37@gmail.com
          </h2>
          <h2 class="card-detail-email">
            ID Lamaran: 129889
          </h2>
        </div>
        <form id="update-status-form">
          <div class="card-status">
            <label for="status" class="status-label">Status</label>
            <select name="status" id="status" class="option-select">
              <option value="accepted">Waiting</option>
              <option value="accepted">Accepted</option>
              <option value="accepted">Rejected</option>
            </select>
          </div>
          <div class="editor-container">
            <div class="status-reason">
              <h3 class="status-reason-text">Reason</h3>
            </div>
            <div id="editor">
            </div>
          </div>
          <div class="save-btn-container">
            <button class="save-btn" type="submit" id="save-btn">
              Save
            </button>
          </div>
        </form>
      </div>
    </div>

    <div class="card info-card resume-card">
      <div class="resume-container">
        <h1 class="resume-title">Resume</h1>
      </div>
      <embed src="/storage/resume/spesifikasi.pdf" type="application/pdf" width="100%" class="pdf-viewer" />
    </div>

    <div class="card info-card resume-card">
      <div class="resume-container">
        <h1 class="resume-title">Video Perkenalan</h1>
      </div>
      <video controls>
      <source src="/storage/video/temp.mp4" type="video/mp4">
        Your browser does not support the video tag.
      </video>
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
  <script src="/public/js/detaillamaran.js"></script>
</body>

</html>
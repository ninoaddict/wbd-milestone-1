<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="View lamaran in detail">
  <meta name="keywords" content="job, apply, vacancy, linkedin, verlinkt">
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
            <?php echo $data['nama'] ?>
          </h1>
        </div>
        <div class="card-detail-info">
          <h2 class="card-detail-email">
            Email: <?php echo $data['email'] ?>
          </h2>
          <h2 class="card-detail-email">
            ID Lamaran: <?php echo $data['lamaran_id'] ?>
          </h2>
        </div>
        <form id="update-status-form">
          <div class="card-status">
            <label for="status" class="status-label">Status</label>
            <select name="status" id="status" class="option-select" <?php if ($data['status'] !== 'waiting')
              echo 'disabled' ?>>
                <option value="waiting" <?php if ($data['status'] == 'waiting')
              echo 'selected="selected"' ?>>Waiting
                </option>
                <option value="accepted" <?php if ($data['status'] == 'accepted')
              echo 'selected="selected"' ?>>
                  Accepted</option>
                <option value="rejected" <?php if ($data['status'] == 'rejected')
              echo 'selected="selected"' ?>>
                  Rejected</option>
              </select>
            </div>
            <div class="editor-container">
              <div class="status-reason">
                <h3 class="status-reason-text">Reason</h3>
              </div>
              <div id="editor">
                <?php
            if (!empty($data['status_reason'])) {
              echo html_entity_decode($data['status_reason']);
            }
            ?>
            </div>
          </div>
          <div class="save-btn-container">
            <button class="save-btn" type="submit" id="save-btn" <?php if ($data['status'] !== 'waiting')
              echo 'disabled' ?>>
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
        <embed src="<?php echo $data['cv_path'] ?>" type="application/pdf" width="100%" class="pdf-viewer" />
    </div>

    <?php if (!empty($data['video_path'])): ?>
      <div class="card info-card resume-card">
        <div class="resume-container">
          <h1 class="resume-title">Video Perkenalan</h1>
        </div>
        <video controls>
          <source src="/storage/video/temp.mp4" type="video/mp4">
          Your browser does not support the video tag.
        </video>
      </div>
    <?php endif; ?>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
  <script>
    const quill = new Quill('#editor', {
      theme: 'snow',
      modules: {
        toolbar: [
          [{ 'header': [1, 2, false] }],
          ['bold', 'italic', 'underline'],
          ['link', 'blockquote', 'code-block'],
          [{ 'list': 'ordered' }, { 'list': 'bullet' }],
          [{ 'indent': '-1' }, { 'indent': '+1' }],
          [{ 'color': [] }, { 'background': [] }],
          [{ 'align': [] }],
        ]
      }
    });

    <?php if ($data['status'] !== 'waiting')
      echo 'quill.enable(false)' ?>

      const updateStatusForm = document.getElementById('update-status-form');

      function onSubmit(e) {
        e.preventDefault();
        const formData = new FormData(updateStatusForm);
        if (formData.get('status') === 'waiting') return;

        const statusReason = quill.root.innerHTML == "<p><br></p>" ? '' : quill.root.innerHTML;

        formData.append('status_reason', statusReason);

        let xhr = new XMLHttpRequest();
        xhr.open('POST', '/lamaran/<?php echo $data['lamaran_id'] ?>', true);
        xhr.onload = function () {
          console.log('masuk sini');
          if (xhr.status === 200) {
            location.reload();
          } else {
            const res = JSON.parse(xhr.responseText);
            console.log(res.error_msg);
          }
        }

        xhr.onerror = function () {
          console.log('Something wrong');
        };

        xhr.send(formData);
      }

    updateStatusForm.addEventListener('submit', onSubmit);
  </script>
</body>

</html>
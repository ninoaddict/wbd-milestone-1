<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Page for applying job in Linkedin">
  <meta name="keywords" content="job, apply, vacancy, linkedin, Linkedin">
  <link rel="stylesheet" href="/public/css/preflight.css">
  <link rel="stylesheet" href="/public/css/globals.css">
  <link rel="stylesheet" href="/public/css/navbar.css">
  <link rel="stylesheet" href="/public/css/lamaran.css">

  <title>Apply Lowongan</title>
</head>

<body>
  <?php include dirname(__DIR__) . '/components/Navbar.php' ?>
  <main>
    <div class="card-title-container">
      <h1 class="card-title">Apply to <?php echo $data['company_name'] ?></h1>
    </div>
    <div class="card">
      <form action="/lowongan/<?php echo $data['lowongan_id'] ?>/apply" method="post" enctype="multipart/form-data">
        <div class="input-container">
          <label for="name" class="input-label">Name <span class="red-star">*</span></label>
          <input type="text" id="name" name="name" disabled value="<?php echo $data['name'] ?>" class="text-input">
        </div>
        <div class="input-container">
          <label for="email" class="input-label">Email <span class="red-star">*</span></label>
          <input type="text" id="email" name="email" disabled value="<?php echo $data['email'] ?>" class="text-input">
        </div>
        <div class="file-input-container">
          <label class="upload-label" for="pdf_input">Curriculum Vitae (CV) <span class="red-star">*</span></label>
          <input class="file-input" aria-describedby="pdf_input_help" id="pdf_input" name="pdf_input" type="file" accept=".pdf" required>
          <p class="file-input-help" id="pdf_input_help">PDF only</p>
        </div>
        <div class="file-input-container">
          <label class="upload-label" for="video_input">Introduction Video</label>
          <input class="file-input" aria-describedby="video_input_help" id="video_input" name="video_input" type="file" accept=".mp4">
          <p class="file-input-help" id="file_input_help">MP4 only</p>
        </div>
        <div class="btn-container">
          <button class="submit-btn">
            Submit Application
          </button>
        </div>
      </form>
    </div>
  </main>
</body>

</html>
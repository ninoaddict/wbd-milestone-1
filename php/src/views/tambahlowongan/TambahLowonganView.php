<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/public/css/preflight.css">
  <link rel="stylesheet" href="/public/css/globals.css">
  <link rel="stylesheet" href="/public/css/navbar.css">
  <link rel="stylesheet" href="/public/css/addvacancy.css">
  <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet"/>
  <title>Add Job</title>
</head>

<body>
  <?php include dirname(__DIR__) . '/components/Navbar.php' ?>
  <main>
    <div class="content-center">
        <div class="add-actual-container">
            <form class="container-add-job">
                <div class="add-job-title">
                    Add Job
                </div>
                <div class="form-flex-structure">
                    <div class="form-structure">
                        <label for="job-name" class="input-name-style">Job Name</label>
                        <input type="text" class="input-style" id="job-name"/>
                    </div>
                    <div class="form-structure">
                        <label for="requirements" class="input-name-style">Company Name</label>
                        <select id="requirements" class="input-style">
                            <?php 
                                foreach($data as $name) {
                                    echo <<<HTML
                                        <option value={$name["nama"]}>{$name["nama"]}</option>
                                    HTML;
                                }
                            ?>
                        </select>
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
                <div class="form-flex-quill">
                    <label class="input-name-style">Description</label>
                    <div id="editor">
                    </div>
                </div>
                <div class="button-add-style">
                    <button type="submit" id="form-submit" class="button-style">Submit</button>
                </div>
            </form>
        </div>
    </div>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
  <script src="../../public/js/AddLowonganVacancy.js"></script>

  <!-- Initialize Quill editor -->
  <script>
  const quill = new Quill('#editor', {
      theme: 'snow'
  });
  </script>
</body>

</html>
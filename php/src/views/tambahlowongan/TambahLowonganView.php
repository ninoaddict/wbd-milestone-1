<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/public/css/preflight.css">
  <link rel="stylesheet" href="/public/css/globals.css">
  <link rel="stylesheet" href="/public/css/navbar.css">
  <link rel="stylesheet" href="/public/css/addvacancy.css">
  <link rel="stylesheet" href="/public/css/vacancy.css">
  <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet"/>
  <title>Add Job</title>
</head>

<body>
  <?php include dirname(__DIR__) . '/components/Navbar.php' ?>
  <main>
    <div class="content-separator">
        <div class="actual-container">
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
                        <label for="requirements" class="input-name-style">Requirements</label>
                        <input type="text" class="input-style" id="requirements"/>
                    </div>
                </div>
                <div class="form-flex-structure">
                    <div class="form-structure">
                        <label for="location" class="input-name-style">Location</label>
                        <input type="text" class="input-style" id="location"/>
                    </div>
                    <div class="form-structure">
                        <label for="requirements" class="input-name-style">Job Type</label>
                        <select name="job-type" class="input-style">
                            <option value="Full-Time">Full-Time</option>
                            <option value="Part-Time">Part-Time</option>
                            <option value="Contract">Contract</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="input-name-style">Description</label>
                    <div id="editor">

                    </div>
                </div>
                <div class="button-add-style">
                    <button type="submit" class="button-style">Submit</button>
                </div>
            </form>
        </div>
    </div>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

  <!-- Initialize Quill editor -->
  <script>
  const quill = new Quill('#editor', {
      theme: 'snow'
  });
  </script>
</body>

</html>
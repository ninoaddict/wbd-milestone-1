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
          <button type="input">Close Job</button>
        </div>
        <div class="delete-button">
          <button type="input">Delete Job</button>
        </div>
        <div class="add-button">
          <a href="../tambahlowongan">Add Job</a>
        </div>
      </div>
      <div class="actual-container">
        <section class="container-job">
          <h1><b class="job-title">Infrastructure Engineer</b></h1>
          <h2 class="descript-title">Description:</h2>
          <h3 class="job-description">
            Infrastructure Engineer adalah pekerjaan yang blah-blah-blah. 
            Ini adalah pekerjaan yang sangat bagus ya. Jadi saya mohon
            anda untuk kerja disini. Plis
          </h3>
          <h2 class="job-requirement">Job Requirement:</h2>
          <ol class="req-num">
            <li>Usia 22 tahun ke-atas</li>
            <li>Bersedia bekerja secara gratis</li>
            <li>Kayanya itu aja</li>
          </ol>
          <h2 class="job-requirement">Location:</h2>
          <h3>Lisbon, Portugal</h3>
          <h2 class="job-requirement">Job Type:</h2>
          <h3>Full-Time</h3>
        </section>
        <section class="container-taker">
          <h1><b class="job-title">Job Takers</b></h1>
          <div class="scrollable-div">
            <!-- Add content here -->
            <div class="container-person">
              <div class="person-name">
                Name: Patricio Estrello
              </div>
              <div class="status-and-details">
                <div class="container-status">
                  Status: Gay
                </div>
                <div class="details-link">
                  <a href="../detaillamaran">See Details</a>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </main>
</body>

</html>
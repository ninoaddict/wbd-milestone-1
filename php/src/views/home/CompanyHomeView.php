<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Homepage for company">
  <meta name="keywords" content="job, apply, vacancy, linkedin, Linkedin">
  <link rel="stylesheet" href="/public/css/preflight.css">
  <link rel="stylesheet" href="/public/css/globals.css">
  <link rel="stylesheet" href="/public/css/navbar.css">
  <link rel="stylesheet" href="/public/css/companyhome.css">
  <link rel="stylesheet" href="/public/css/toast.css">
  <link rel="stylesheet" href="/public/css/multiselect.css">
  <link rel="stylesheet" href="/public/css/footer.css">

  <title>Home</title>
</head>

<body>
  <?php include dirname(__DIR__) . '/components/Navbar.php' ?>
  <main>
    <section class="home-section">
      <div class="home-container">
        <div class="home-layout">
          <div class="sidebar">
            <div class="pseudo-card">
              <div>
                <img src="/public/images/bg-linkedin.svg" alt="" class="pseudo-img">
                <div class="pseudo-pp-container">
                <img src="/public/images/default-profile.jpg" alt="" class="pseudo-pp">
                </div>
              </div>
              <div class="pseudo-identity">
                <h1 class="pseudo-name"><?php echo $_SESSION['nama'] ?></h1>
                <h2 class="pseudo-email"><?php echo $_SESSION['email'] ?></h2>
              </div>
              <div class="add-btn-xl-container">
                <form class="form-btn-xl" action="/lowongan/add" method="get">
                  <button class="add-btn-xl">Add Vacancy</button>
                </form>
              </div>
            </div>
            <form id="search-form">
              <div class="search-container">
                <label class="icon-wrapper" for="query">
                  <svg class="icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                    fill="currentColor" class="search-svg" version="1.1" id="Capa_1" viewBox="0 0 488.4 488.4"
                    xml:space="preserve">
                    <g>
                      <g>
                        <path d="M0,203.25c0,112.1,91.2,203.2,203.2,203.2c51.6,0,98.8-19.4,134.7-51.2l129.5,129.5c2.4,2.4,5.5,3.6,8.7,3.6 
                          s6.3-1.2,8.7-3.6c4.8-4.8,4.8-12.5,0-17.3l-129.6-129.5c31.8-35.9,51.2-83,51.2-134.7c0-112.1-91.2-203.2-203.2-203.2 
                          S0,91.15,0,203.25z M381.9,203.25c0,98.5-80.2,178.7-178.7,178.7s-178.7-80.2-178.7-178.7s80.2-178.7,178.7-178.7 
                          S381.9,104.65,381.9,203.25z" />
                      </g>
                    </g>
                  </svg>
                </label>
                <input type="text" class="search-input" name="query" id="query" placeholder="Title or Company" <?php if (!empty($data['query'])) echo 'value=' . $data['query'] ?>>
              </div>
              <div class="filter-container">
                <div class="card mt">
                  <div class="filter-container">
                    <label class="filter-label">Job type</label>
                    <select name="job-type" id="job-type" data-placeholder="Select job type" multiple data-multi-select>
                      <option value="full-time" <?php if (!empty($data['jobType']) && in_array('full-time', $data['jobType'])) echo 'selected' ?>>Full-time</option>
                      <option value="part-time" <?php if (!empty($data['jobType']) && in_array('part-time', $data['jobType'])) echo 'selected' ?>>Part-time</option>
                      <option value="internship" <?php if (!empty($data['jobType']) && in_array('internship', $data['jobType'])) echo 'selected' ?>>Internship</option>
                    </select>
                  </div>

                  <div class="filter-container margin-location">
                    <p class="filter-label">Location type</p>
                    <select name="location-type" id="location-type" data-placeholder="Select location type" multiple
                      data-multi-select>
                      <option value="on-site" <?php if (!empty($data['locType']) && in_array('on-site', $data['locType'])) echo 'selected' ?>>On-site</option>
                      <option value="hybrid" <?php if (!empty($data['locType']) && in_array('hybrid', $data['locType'])) echo 'selected' ?>>Hybrid</option>
                      <option value="remote" <?php if (!empty($data['locType']) && in_array('remote', $data['locType'])) echo 'selected' ?>>Remote</option>
                    </select>
                  </div>

                  <div class="sort-container">
                    <label for="sort" class="sort-label">Sort by</label>
                    <div class="sort-input-container">
                      <select name="sort" id="sort" class="sort-select">
                        <option value="asc" class="sort-option" <?php if (!empty($data['order']) && $data['order'] == 'asc') echo 'selected' ?>>Oldest upload</option>
                        <option value="desc" class="sort-option" <?php if (empty($data['order']) || $data['order'] == 'desc') echo 'selected' ?>>Latest upload</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <main class="main" id="main">
            <div class="job-card-container" id="job-card-container">
            <?php foreach($data['jobs'] as $job):?>
              <div class="card job-card">
                <a href="/lowongan/<?php echo $job['lowongan_id'] ?>" class="job-title-link">
                  <h3 class="job-title"><?php echo $job['posisi'] ?></h3>
                </a>
                <div class="locntype">
                  <p class="job-location"><?php echo $job['nama'] ?></p>
                </div>
                <div class="datentype">
                  <p class="post-time"><?php echo ucfirst($job['jenis_pekerjaan']) ?> • <?php echo ucfirst($job['jenis_lokasi']) ?> </p>
                </div>
                <div>
                  <p class="times">Posted <?php echo $job['days_before'] ?> days ago</p>
                </div>
                <div class="delete-btn-container">
                  <button class="delete-btn" onclick="handleDelete(<?php echo $job['lowongan_id'] ?>)" aria-label="Delete button">
                    Delete
                  </button>
                  <form class="action-form" action="/lowongan/<?php echo $job['lowongan_id'] ?>/edit" action="GET">
                    <button class="edit-btn" aria-label="Edit button">
                      Edit
                    </button>
                  </form>
                </div>
              </div>
            <?php endforeach; ?>
            <?php if (empty($data['jobs']) || !count($data['jobs'])): ?>
              <div class="not-posted">
                <p class="not-posted-job">
                  You have not posted any jobs
                </p>
              </div>
            <?php endif; ?>
            </div>
            <nav class="pagination-nav" id="pagination-nav">
              <?php if ($data['maxPage'] > 0): ?>
              <ul class="pagination">
                <li>
                  <a href="/?jobtype=<?php echo implode(',', array: $data['jobType']) ?>&loctype=<?php echo implode(',', array: $data['locType']) ?>&sort=<?php echo $data['order'] ?>&query=<?php echo $data['query'] ?>&page=<?php echo max(1, $data['page'] - 1) ?>" class="page-link prev" aria-label="Previous page button">
                    <svg class="icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                      viewBox="0 0 6 10">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 1 1 5l4 4" />
                    </svg>
                  </a>
                </li>
                <?php for ($x = $data['lowerPage']; $x <= $data['upperPage']; $x++) : ?>
                  <li>
                    <a href="/?jobtype=<?php echo implode(',', array: $data['jobType']) ?>&loctype=<?php echo implode(',', array: $data['locType']) ?>&sort=<?php echo $data['order'] ?>&query=<?php echo $data['query'] ?>&page=<?php echo $x ?>" class="page-link<?php if($x == $data['page']) echo ' active'; ?>" aria-label="Numbered page button"><?php echo $x ?></a>
                  </li>
                <?php endfor; ?>
                <li>
                  <a href="/?jobtype=<?php echo implode(',', array: $data['jobType']) ?>&loctype=<?php echo implode(',', array: $data['locType']) ?>&sort=<?php echo $data['order'] ?>&query=<?php echo $data['query'] ?>&page=<?php echo min($data['maxPage'], $data['page'] + 1) ?>" class="page-link next" aria-label="Next page button">
                    <svg class="icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                      viewBox="0 0 6 10">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 9 4-4-4-4" />
                    </svg>
                  </a>
                </li>
              </ul>
              <?php endif; ?>
            </nav>
          </main>
          <div class="pseudo">
            <div class="card">
              <div class="top-job-title-container">
                <h1 class="top-job-title">Your most popular jobs</h1>
              </div>
              <div class="top-job-card-container">
              <?php foreach($data['top_lowongan'] as $top_job):?>
                <div class="tob-job-card">
                  <a href="/lowongan/<?php echo $top_job['lowongan_id'] ?>" class="underline">
                    <h1 class="top-job-card-position">
                      <?php echo $top_job['posisi'] ?>
                    </h1>
                  </a>
                  <h2 class="top-job-card-company">
                    <?php echo $top_job['nama'] ?> ─ <?php echo $top_job['lokasi'] ?>
                  </h2>
                </div>
              <?php endforeach; ?>
              <?php if (empty($data['top_lowongan']) || !count($data['top_lowongan'])): ?>
                <div class="not-exist">
                  <p class="not-exist-job">
                    You have not posted any jobs
                  </p>
                </div>
              <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <div class="add-btn-container">
    <div class="add-btn">
      <a href="/lowongan/add">
        <span class="plus-icon">&#43;</span>
      </a>
    </div>
  </div>
  <?php include dirname(__DIR__) . '/components/Footer.php' ?>
  <ul class="notifications"></ul>
</body>

<script src="/public/js/toast.js" defer></script>
<?php if (isset($successMessage)): ?>
  <script defer>
    window.addEventListener('load', (event) => {
      createToast('success', '<?php echo $successMessage ?>')
    });
  </script>
<?php endif; ?>
<script src="/public/js/multiselect.js"></script>
<script src="/public/js/companyhome.js"></script>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Homepage for company">
  <meta name="keywords" content="job, apply, vacancy, linkedin, verlinkt">
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
                  <p class="job-location"><?php echo $job['nama'] ?> ─ <?php echo ucfirst($job['jenis_lokasi']) ?></p>
                </div>
                <div class="datentype">
                  <p class="post-time"><?php echo ucfirst($job['jenis_pekerjaan']) ?> • Posted <?php echo $job['days_before'] ?> days ago</p>
                </div>
                <div class="delete-btn-container">
                  <button class="delete-btn" onclick="handleDelete(<?php echo $job['lowongan_id'] ?>)">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="24px" height="24px" fill="currentColor">    
                    <path d="M 14.984375 2.4863281 A 1.0001 1.0001 0 0 0 14 3.5 L 14 4 L 8.5 4 A 1.0001 1.0001 
                    0 0 0 7.4863281 5 L 6 5 A 1.0001 1.0001 0 1 0 6 7 L 24 7 A 1.0001 1.0001 0 1 0 24 5 L 22.513672 5 
                    A 1.0001 1.0001 0 0 0 21.5 4 L 16 4 L 16 3.5 A 1.0001 1.0001 0 0 0 14.984375 2.4863281 z M 6 9 L 7.7929688 
                    24.234375 C 7.9109687 25.241375 8.7633438 26 9.7773438 26 L 20.222656 26 C 21.236656 26 22.088031 25.241375 
                    22.207031 24.234375 L 24 9 L 6 9 z"/></svg>
                  </button>
                </div>
              </div>
            <?php endforeach; ?>
            </div>
            <nav class="pagination-nav" id="pagination-nav">
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
            </nav>
          </main>
          <div class="pseudo"></div>
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
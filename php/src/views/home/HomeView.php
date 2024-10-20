<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/public/css/preflight.css">
  <link rel="stylesheet" href="/public/css/globals.css">
  <link rel="stylesheet" href="/public/css/navbar.css">
  <link rel="stylesheet" href="/public/css/home.css">
  <link rel="stylesheet" href="/public/css/toast.css">
  <link rel="stylesheet" href="/public/css/multiselect.css">

  <title>Home</title>
</head>

<body>
  <?php include dirname(__DIR__) . '/components/Navbar.php' ?>
  <main>
    <section class="home-section">
      <div class="home-container">
        <div class="home-layout">
          <div class="sidebar">
            <form>
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
                <input type="text" class="search-input" name="query" id="query" placeholder="Title or Company">
              </div>
              <div class="filter-container">
                <div class="card mt">
                  <div class="filter-container">
                    <label class="filter-label">Job type</label>
                    <select name="job-type" id="job-type" data-placeholder="Select job type" multiple data-multi-select>
                      <option value="full-time">Full-time</option>
                      <option value="part-time">Part-time</option>
                      <option value="internship">Internship</option>
                    </select>
                  </div>

                  <div class="filter-container margin-location">
                    <p class="filter-label">Location type</p>
                    <select name="location-type" id="location-type" data-placeholder="Select location type" multiple
                      data-multi-select>
                      <option value="on-site">On-site</option>
                      <option value="hybrid">Hybrid</option>
                      <option value="remote">Remote</option>
                    </select>
                  </div>

                  <div class="sort-container">
                    <p for="sort" class="sort-label">Sort by</p>
                    <div class="sort-input-container">
                      <select name="sort" id="sort" class="sort-select">
                        <option value="asc" class="sort-option">Oldest upload</option>
                        <option value="desc" class="sort-option" selected="selected">Latest upload</option>
                      </select>
                    </div>
                  </div>

                  <div class="btn-container">
                    <button class="filter-btn">
                      Filter
                    </button>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <main class="main">
            <div class="card job-card">
              <a href="/lowongan/123" class="job-title-link">
                <h3 class="job-title">Software Engineer</h3>
              </a>
              <div class="locntype">
                <p class="job-location">Google ─ Mountain View, CA (On-site)</p>
              </div>
              <div class="datentype">
                <p class="post-time">Full-time | 2 days ago</p>
              </div>
            </div>

            <nav class="pagination-nav">
              <ul class="pagination">
                <li>
                  <a href="#" class="page-link prev">
                    <svg class="icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                      viewBox="0 0 6 10">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 1 1 5l4 4" />
                    </svg>
                  </a>
                </li>
                <li><a href="#" class="page-link">1</a></li>
                <li><a href="#" class="page-link">2</a></li>
                <li><a href="#" class="page-link active" aria-current="page">3</a></li>
                <li><a href="#" class="page-link">4</a></li>
                <li><a href="#" class="page-link">5</a></li>
                <li>
                  <a href="#" class="page-link next">
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
<script>
  const jobType = document.getElementById('job-type');
  const locationType = document.getElementById('location-type');

  function debounce(func, delay) {
    let debounceTimer;
    return function (...args) {
      const context = this;
      clearTimeout(debounceTimer);
      debounceTimer = setTimeout(() => func.apply(context, args), delay);
    };
  }

  function performSearch(event) {
    const query = event.target.value;
    console.log(query);
  }

  function performFilter(event) {
    console.log(multiSelectJob.selectedValues);
    // console.log(multiSelectLocation.selectedValues);
  }

  const debouncedSearch = debounce(performSearch, 500);
  const debounceFilter = debounce(performFilter, 1000);

  options = {
    onChange: debounceFilter,
  };

  const multiSelectJob = new MultiSelect(jobType, options);
  const multiSelectLocation = new MultiSelect(locationType, options);

  const searchInput = document.getElementById('query');
  searchInput.addEventListener('input', debouncedSearch);

  document.querySelectorAll('.card').forEach(card => {
    card.addEventListener('click', function () {
      const link = card.querySelector('a.job-title-link');
      if (link) {
        window.location.href = link.href;
      }
    });
  });
</script>

</html>
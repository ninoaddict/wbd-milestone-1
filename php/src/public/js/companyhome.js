const jobType = document.getElementById('job-type');
const locationType = document.getElementById('location-type');
const jobCardContainer = document.getElementById('job-card-container');
const paginationNav = document.getElementById('pagination-nav');
const searchInput = document.getElementById('query');
const sortByInput = document.getElementById('sort');

// function for debouncing
function debounce(func, delay) {
  let debounceTimer;
  return function (...args) {
    const context = this;
    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(() => func.apply(context, args), delay);
  };
}

// get url from form data
function getUrlFromForm() {
  const formElmt = document.getElementById('search-form');
  const formData = new FormData(formElmt);

  const jobTypeData = multiSelectJob.selectedValues;
  const locTypeData = multiSelectLocation.selectedValues;

  const jobTypeStr = jobTypeData.join(',');
  const locTypeStr = locTypeData.join(',');
  const query = formData.get('query');
  const sort = formData.get('sort');

  let url = '';
  if (jobTypeData.length > 0) {
    url += `jobtype=${jobTypeStr}`;
  }

  if (locTypeData.length > 0) {
    if (url !== '') url += '&';
    url += `loctype=${locTypeStr}`;
  }

  if (query) {
    if (url !== '') url += '&';
    url += `query=${query}`;
  }

  if (sort) {
    if (url !== '') url += '&';
    url += `sort=${sort}`;
  }

  return url;
}

function getUrlFromParams(url) {
  const urlParams = new URLSearchParams(url);
  urlParams.delete('page');
  return urlParams.toString();
}

// capitalize words
function capitalize(str) {
  return str.charAt(0).toUpperCase() + str.slice(1);
}

function updateContent(res, rawUrl) {
  const url = '/?' + rawUrl;
  let newMainContent = ''
  for (const job of res.jobs) {
    newMainContent += `
      <div class="card job-card">
        <a href="/lowongan/${job.lowongan_id}" class="job-title-link">
          <h3 class="job-title">${job.posisi}</h3>
        </a>
        <div class="locntype">
          <p class="job-location">${job.nama} ─ ${capitalize(job.jenis_lokasi)}</p>
        </div>
        <div class="datentype">
          <p class="post-time">${capitalize(job.jenis_pekerjaan)} • Posted ${job.days_before} days ago</p>
        </div>
        <div class="delete-btn-container">
          <button class="delete-btn" onclick="handleDelete(${job.lowongan_id})" aria-label="Delete button">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="24px" height="24px" fill="currentColor">    
            <path d="M 14.984375 2.4863281 A 1.0001 1.0001 0 0 0 14 3.5 L 14 4 L 8.5 4 A 1.0001 1.0001 
            0 0 0 7.4863281 5 L 6 5 A 1.0001 1.0001 0 1 0 6 7 L 24 7 A 1.0001 1.0001 0 1 0 24 5 L 22.513672 5 
            A 1.0001 1.0001 0 0 0 21.5 4 L 16 4 L 16 3.5 A 1.0001 1.0001 0 0 0 14.984375 2.4863281 z M 6 9 L 7.7929688 
            24.234375 C 7.9109687 25.241375 8.7633438 26 9.7773438 26 L 20.222656 26 C 21.236656 26 22.088031 25.241375 
            22.207031 24.234375 L 24 9 L 6 9 z"/></svg>
          </button>
        </div>
      </div>
    `;
  }
  jobCardContainer.innerHTML = newMainContent;

  let newContent =  '';
  if (res.maxPage > 0) {
    newContent += `
      <ul class="pagination">
        <li>
          <a href="${url}${rawUrl === '' ? '' : '&'}page=${Math.max(1, res.page - 1)}" class="page-link prev" aria-label="Previous page button">
            <svg class="icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
              viewBox="0 0 6 10">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M5 1 1 5l4 4" />
            </svg>
          </a>
        </li>
    `;
    for (let i = res.lowerPage; i <= res.upperPage; i++) {
      newContent += `
        <li>
          <a href="${url}${rawUrl === '' ? '' : '&'}page=${i}" class="page-link${i == res.page ? ' active' : ''}" aria-label="Numbered page button">${i}</a>
        </li>
      `;
    }
    newContent += `
        <li>
          <a href="${url}${rawUrl === '' ? '' : '&'}page=${Math.min(+res.page + 1, res.maxPage)}" class="page-link next" aria-label="Next page button">
            <svg class="icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
              viewBox="0 0 6 10">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 9 4-4-4-4" />
            </svg>
          </a>
        </li>
      </ul>`;
  }
  paginationNav.innerHTML = newContent;
}

function handleDelete(id) {
  // handle delete
  console.log(id);
}

function fetchContent(rawUrl, isPageExist) {
  let url = '/jobs?' + rawUrl;

  if (isPageExist) {
    rawUrl = getUrlFromParams('?' + rawUrl);
  }

  let xhr = new XMLHttpRequest();
  xhr.open('GET', url, true);
  xhr.onload = () => {
    jobCardContainer.innerHTML = '';
    if (xhr.status === 200) {
      const res = JSON.parse(xhr.response);
      updateContent(res, rawUrl);
    } else {
      console.log('error');
    }
  }

  xhr.onerror = () => {
    console.log('Something wrong');
  }

  xhr.send();
}

// function to perform search and filter
function performSearch() {
  const rawUrl = getUrlFromForm();
  const currUrl = '/?' + rawUrl;
  window.history.pushState(null, null, currUrl);
  fetchContent(rawUrl, false);
}

const debouncedSearch = debounce(performSearch, 800);

const options = {
  onChange: debouncedSearch,
};

const multiSelectJob = new MultiSelect(jobType, options);
const multiSelectLocation = new MultiSelect(locationType, options);

function getPopContent() {
  const currUrl = window.location.search;
  const params = currUrl.substring(1);
  fetchContent(params, true);

  const urlParams = new URLSearchParams(currUrl);

  document.getElementById('query').value = urlParams.get('query');
  document.getElementById('sort').value = urlParams.get('sort') ?? 'desc';
  const rawJobType = urlParams.get('jobtype');
  const rawLocType = urlParams.get('loctype');

  const jobType = rawJobType ? rawJobType.split(',') : [];
  const locType = rawLocType ? rawLocType.split(',') : [];

  let newJobVal = {};
  let newLocVal = {};

  const jobs = ['full-time', 'part-time', 'internship'];
  const locs = ['on-site', 'hybrid', 'remote'];

  for (const job of jobs) {
    newJobVal[job] = jobType.includes(job);
  }

  for (const loc of locs) {
    newLocVal[loc] = locType.includes(loc);
  }

  multiSelectJob.selectedValues = newJobVal;
  multiSelectLocation.selectedValues = newLocVal;
}

searchInput.addEventListener('input', debouncedSearch);
searchInput.addEventListener('keypress', (event) => {
  if (event.key == "Enter") {
    event.preventDefault();
  }
});

sortByInput.addEventListener('change', performSearch);
window.addEventListener('popstate', getPopContent);
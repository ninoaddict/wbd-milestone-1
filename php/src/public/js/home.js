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

function getInitialContent() {
  const currUrl = window.location.search;
  const params = currUrl.substring(1);
  fetchContent(params, true);
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

// add link for card
document.querySelectorAll('.card').forEach(card => {
  card.addEventListener('click', function () {
    const link = card.querySelector('a.job-title-link');
    if (link) {
      window.location.href = link.href;
    }
  });
});

window.addEventListener('DOMContentLoaded', getInitialContent);
window.addEventListener('popstate', getPopContent);
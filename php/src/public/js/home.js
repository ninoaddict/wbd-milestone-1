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
  const formElmt = document.getElementById('search-form');
  const formData = new FormData(formElmt);

  const jobTypeData = multiSelectJob.selectedValues;
  const locTypeData = multiSelectLocation.selectedValues;

  const jobTypeStr = jobTypeData.join(',');
  const locTypeStr = locTypeData.join(',');
  const query = formData.get('query');
  const sort = formData.get('sort');

  let url = '?';
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

  window.location.href = url;
}

const debouncedSearch = debounce(performSearch, 800);

const options = {
  onChange: debouncedSearch,
};

const multiSelectJob = new MultiSelect(jobType, options);
const multiSelectLocation = new MultiSelect(locationType, options);

const searchInput = document.getElementById('query');
searchInput.addEventListener('input', debouncedSearch);
searchInput.addEventListener('keypress', (event) => {
  if (event.key == "Enter") {
    event.preventDefault();
  }
})

// add link for card
document.querySelectorAll('.card').forEach(card => {
  card.addEventListener('click', function () {
    const link = card.querySelector('a.job-title-link');
    if (link) {
      window.location.href = link.href;
    }
  });
});
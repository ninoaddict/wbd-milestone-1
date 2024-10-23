const buttone = document.getElementById("form-submit");
const formInput = document.getElementById('uploadForm');

// TODO: handle error by giving toast

formInput.addEventListener("submit", function (e) {
  e.preventDefault();

  buttone.disabled = true;
  const jobName = document.getElementById("job-name").value;
  const companyName = document.getElementById("requirements").textContent;
  const locationEl = document.getElementById("location");
  const location = locationEl.options[locationEl.selectedIndex].value;
  const jobTypeEl = document.getElementById("job-type");
  const statusEl = document.getElementById("status");
  const files = document.getElementById("attachment-upload");
  const status = statusEl.options[statusEl.selectedIndex].value;
  const jobType = jobTypeEl.options[jobTypeEl.selectedIndex].value;
  var htmlContent = quill.root.innerHTML;

  if (!(jobName && location && status && jobType && htmlContent)) {
    // TODO: handler error using toast
    buttone.disabled = false;
    return;
  }

  const selectedFiles = files.files;

  var formData = new FormData();
  formData.append("position", jobName);
  formData.append("companyName", companyName);
  formData.append("location", location);
  formData.append("jobType", jobType);
  formData.append("status", status);
  formData.append("htmlContent", htmlContent);

  if (selectedFiles.length > 0) {
    for (let i = 0; i < selectedFiles.length; i++) {
      formData.append("files[]", selectedFiles[i]);
    }
  }

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "/lowongan/add", true);
  xhr.onload = function () {
    if (xhr.status === 200) {
      const res = JSON.parse(xhr.responseText);
      window.location.replace(res.message);
    } else {
      const res = JSON.parse(xhr.responseText);
      console.log(res.message);
    }
  };
  xhr.onerror = function () {
    console.log("Something is wrong");
  };
  xhr.send(formData);
  buttone.disabled = false;
});

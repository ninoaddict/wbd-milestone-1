const buttone = document.getElementById('form-submit');

buttone.addEventListener('click', function() {
    buttone.disabled = true;
    const jobName = document.getElementById('job-name').value;
    const companyName = document.getElementById('requirements').textContent;
    const locationEl = document.getElementById('location');
    const location = locationEl.options[locationEl.selectedIndex].value;
    const jobTypeEl = document.getElementById('job-type');
    const statusEl = document.getElementById('status');
    const files = document.getElementById('attachment-upload');
    const status = statusEl.options[statusEl.selectedIndex].value;
    const jobType = jobTypeEl.options[jobTypeEl.selectedIndex].value;
    var htmlContent = quill.root.innerHTML;

    if (!(jobName && location && status && jobType && htmlContent)) {
        console.log("I don't like my form empty bruh");
        buttone.disabled = false;
        return;
    }

    console.log(files);

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
            console.log(selectedFiles[i]);
            formData.append("files[]", selectedFiles[i]);
        }
    }

    for (const [key, value] of formData.entries()) {
        console.log(`${key}: ${value}`);
    }

    console.log(formData.getAll('files[]'));

    let xhr = new XMLHttpRequest();
    xhr.open('POST','/tambahlowongan', true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            const res = JSON.parse(xhr.responseText);
            console.log('Success:', res.message);
            window.location.replace(res.message);
        } else {
            // fail ajax
            const res = JSON.parse(xhr.responseText);
            console.log(res.message);
        }
    };
    xhr.onerror = function () {
        // fail ajax 2
        console.log("Something is wrong");
    };
    xhr.send(formData);
    buttone.disabled = false;
})
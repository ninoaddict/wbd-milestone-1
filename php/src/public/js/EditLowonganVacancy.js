document.addEventListener('DOMContentLoaded', function () {
    const buttone = document.getElementById('form-submit');
    const path = window.location.pathname;
    const segments = path.split('/');
    const id = segments.pop();

    buttone.addEventListener('click', function() {
        buttone.disabled = true;
        const jobName = document.getElementById('job-name').value;
        const companyName = document.getElementById('requirements').value;
        const locationEl = document.getElementById('location');
        const location = locationEl.options[locationEl.selectedIndex].value;
        const jobTypeEl = document.getElementById('job-type');
        const statusEl = document.getElementById('status');
        const status = statusEl.options[statusEl.selectedIndex].value;
        const jobType = jobTypeEl.options[jobTypeEl.selectedIndex].value;
        var htmlContent = quill.root.innerHTML;

        if (!(jobName && location && status && jobType && htmlContent)) {
            console.log("I don't like my form empty bruh");
            buttone.disabled = false;
            return;
        }

        var formData = new FormData();
        formData.append("position", jobName);
        formData.append("companyName", companyName);
        formData.append("location", location);
        formData.append("jobType", jobType);
        formData.append("status", status);
        formData.append("htmlContent", htmlContent);
        formData.append("lowongan_id", id);

        for (const [key, value] of formData.entries()) {
            console.log(`${key}: ${value}`);
        }

        let xhr = new XMLHttpRequest();
        xhr.open('POST','/editlowongan', true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                window.location.replace('/detaillowongan/'+id);
                console.log('Success:', xhr.responseText);
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
})
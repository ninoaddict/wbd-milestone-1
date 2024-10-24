const closer = document.getElementById("close-or-opener");
const deleter = document.getElementById("deleter");
const pdfButtone = document.getElementById("view-pdf");
const vidButtone = document.getElementById("view-vid");
const pdfVidContent = document.getElementById("pdf-vid-show");
const pdfEmbed = document.getElementById("pdf-embed");
const vidEmbed = document.getElementById("vid-embed");
const path = window.location.pathname;
const segments = path.split("/");
const id = segments.pop();
const editor = document.getElementById("editer");
const csv = document.getElementById("button-csv");
const title = document.getElementById("position").innerText;

// TODO: add error and success message

if (editor) {
  editor.href = "../lowongan/" + id + "/edit";
}

closer.addEventListener("click", function () {
  let dummy = new FormData();
  dummy.append("id", id);
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "/lowongan/closeopen", true);
  xhr.onload = function () {
    if (xhr.status === 200) {
      location.reload();
    } else {
      const res = JSON.parse(xhr.responseText);
      createToast("error", res.message);
    }
  };
  xhr.onerror = function () {
    createToast("error", "Something went wrong");
  };
  xhr.send(dummy);
});

deleter.addEventListener("click", function () {
  let xhr = new XMLHttpRequest();
  xhr.open("DELETE", `/lowongan/${id}/delete`, true);
  xhr.onload = function () {
    if (xhr.status === 200) {
      window.location.replace("/");
    } else {
      const res = JSON.parse(xhr.responseText);
      createToast("error", res.message);
    }
  };
  xhr.onerror = function () {
    createToast("error", "Something went wrong");
  };
  xhr.send();
});

csv.addEventListener("click", function () {
  let xhr = new XMLHttpRequest();
  xhr.open("GET", `/lowongan/${id}/applicants`, true);
  xhr.responseType = 'blob';
  xhr.onload = () => {
    if (xhr.status == 200) {
      const blob = xhr.response;
      const url = window.URL.createObjectURL(blob);
      const a = document.createElement('a');
      a.href = url;
      a.download = `${id}.csv`;
      document.body.appendChild(a);
      a.click();
      document.body.removeChild(a);
      window.URL.revokeObjectURL(url);
    } else {
      createToast("error", "Failed to download CSV.");
    }
  };
  xhr.onerror = function () {
    createToast("error", "Something went wrong");
  };
  xhr.send();
});

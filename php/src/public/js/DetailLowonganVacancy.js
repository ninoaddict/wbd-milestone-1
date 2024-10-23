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
      console.log("Success:", xhr.responseText);
    } else {
      const res = JSON.parse(xhr.responseText);
      console.log(res.message);
    }
  };
  xhr.onerror = function () {
    console.log("Something is wrong");
  };
  xhr.send(dummy);
});

deleter.addEventListener("click", function () {
  let xhr = new XMLHttpRequest();
  xhr.open("DELETE", `/lowongan/${id}/delete`, true);
  xhr.onload = function () {
    if (xhr.status === 200) {
      window.location.replace("/");
      console.log("Success:", xhr.responseText);
    } else {
      const res = JSON.parse(xhr.responseText);
      console.log(res.message);
    }
  };
  xhr.onerror = function () {
    console.log("Something is wrong");
  };
  xhr.send();
});

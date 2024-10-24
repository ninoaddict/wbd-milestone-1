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
const embedCSV = document.getElementById("embed-csv").innerHTML.trim();
const title = document.getElementById("position").innerText;

console.log(JSON.parse(embedCSV));
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
      createToast('error', res.message);
    }
  };
  xhr.onerror = function () {
    createToast('error', "Something went wrong");
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
      createToast('error', res.message);
    }
  };
  xhr.onerror = function () {
    createToast('error', "Something went wrong");
  };
  xhr.send();
});

csv.addEventListener("click", function() {
  const jsonCSVData = JSON.parse(embedCSV);
  if (jsonCSVData.length > 0) {
    const csvRows = [];
    for (let i = 0; i < jsonCSVData.length; i++) {
      csvSingle = {
        "name": jsonCSVData[i]['nama'],
        "position": title,
        "created_at": jsonCSVData[i]['created_at'],
        "cv_path": jsonCSVData[i]['cv_path'],
        "vid_path": jsonCSVData[i]['vid_path'],
        "status": jsonCSVData[i]['status']
      }
      csvRows.push(csvSingle);
    }
    const headers = Object.keys(csvRows[0]);
    const csvDatas = csvRows.map(obj => headers.map(header => obj[header]).join(","));
    const csv = [headers.join(","), ...csvDatas].join("\n");
    const blob = new Blob([csv],{type: "text/csv"});
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.setAttribute('href', url);
    a.setAttribute('download', 'data.csv');
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    window.URL.revokeObjectURL(url);
  } 
});

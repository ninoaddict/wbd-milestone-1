document.addEventListener('DOMContentLoaded', function () {
    const pdfButtone = document.getElementById('view-cv');
    const vidButtone = document.getElementById('view-vid');
    const pdfVidContent = document.getElementById('pdf-vid-show');
    const pdfEmbed = document.getElementById('pdf-embed');
    const vidEmbed = document.getElementById('video-embed');
    const downloader = document.getElementById('download');
    const seer = document.getElementById('see');

    if (pdfButtone) {
        pdfButtone.addEventListener('click', function() {
            console.log(pdfEmbed.innerText.split('/')[4]);
            pdfVidContent.innerHTML = '';
            const object = document.createElement('object');
            object.id = "pdf-styling"
            object.type = "application/pdf";
            object.data = pdfEmbed.innerText;
            object.width = "100%";
            object.height = "400";
            pdfVidContent.appendChild(object);
            downloader.href = pdfEmbed.innerText;
            seer.href = pdfEmbed.innerText;
            downloader.download = pdfEmbed.innerText.split('/')[4].trim();
        });
    }

    if (vidButtone) {
        vidButtone.addEventListener('click', function() {
            console.log(vidEmbed.innerText.split('/')[4]);
            pdfVidContent.innerHTML = '';
            const video = document.createElement('video');
            video.id = "vid-styling"
            video.style.width = "100%";
            video.height = "400";
            video.controls = true;
            const source = document.createElement('source');
            source.src = vidEmbed.innerText;
            source.type = "video/mp4";
            video.appendChild(source);
            pdfVidContent.appendChild(video);
            downloader.href = vidEmbed.innerText;
            seer.href = vidEmbed.innerText;
            downloader.download = vidEmbed.innerText.split('/')[4].trim();
        });
    }
});

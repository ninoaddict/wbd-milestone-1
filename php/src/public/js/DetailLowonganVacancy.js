document.addEventListener('DOMContentLoaded', function () {
    const closer = document.getElementById('close-or-opener');
    const deleter = document.getElementById('deleter');
    const path = window.location.pathname;
    const segments = path.split('/');
    const id = segments.pop();
    const editor = document.getElementById('editer');
    console.log(editor);

    if (editor) {
        console.log(editor);
        editor.href = "../editlowongan/" + id;
    }

    closer.addEventListener('click', function() {
        let dummy = new FormData();
        dummy.append('id', id);
        let xhr = new XMLHttpRequest();
        xhr.open('POST','/detaillowongan/closeopen', true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                location.reload();
                console.log('Success:', xhr.responseText);
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

    deleter.addEventListener('click', function() {
        let dummy = new FormData();
        dummy.append('id', id);
        let xhr = new XMLHttpRequest();
        xhr.open('POST','/detaillowongan/delete', true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                window.location.replace('/');
                console.log('Success:', xhr.responseText);
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
});

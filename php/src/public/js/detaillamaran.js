const quill = new Quill('#editor', {
  theme: 'snow',
  modules: {
    toolbar: [
      [{ 'header': [1, 2, false] }],
      ['bold', 'italic', 'underline'],
      ['link', 'blockquote', 'code-block'],
      [{ 'list': 'ordered' }, { 'list': 'bullet' }],
      [{ 'indent': '-1' }, { 'indent': '+1' }],
      [{ 'color': [] }, { 'background': [] }],
      [{ 'align': [] }],
    ]
  }
});

const updateStatusForm = document.getElementById('update-status-form');

function onSubmit(e) {
  e.preventDefault();
  console.log(quill.root.innerHTML);
}

updateStatusForm.addEventListener('submit', onSubmit);
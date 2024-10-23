const notifications = document.querySelector(".notifications");

const toastDetails = {
  timer: 5000,
  success: {
    icon: `<svg class="toast-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor">
    <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 
    0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/></svg>`,
  },
  error: {
    icon: `<svg class="toast-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor">
    <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 
    9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/></svg>`,
  },
  warning: {
    icon: `<svg class="toast-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor">
    <path d="M20.7 412.3c-3.1 5.3-4.7 11.2-4.7 17.3c0 19 15.4 34.4 34.4 34.4l411.2 0c19 0 34.4-15.4 34.4-34.4c0-6.1-1.6-12.1-4.7-17.3L290.3 67.7C283.2 55.5 270.1 48 256 
    48s-27.2 7.5-34.3 19.7L20.7 412.3zM6.9 404.2l201-344.6C217.9 42.5 236.2 32 256 32s38.1 10.5 48.1 27.6l201 344.6c4.5 7.7 6.9 16.5 6.9 25.4c0 27.8-22.6 50.4-50.4 50.4L50.4 
    480C22.6 480 0 457.4 0 429.6c0-8.9 2.4-17.7 6.9-25.4zM256 160c4.4 0 8 3.6 8 8l0 160c0 4.4-3.6 8-8 8s-8-3.6-8-8l0-160c0-4.4 3.6-8 8-8zM240 384a16 16 0 1 1 32 0 16 16 0 1 1 -32 0z"/></svg>`,
  },
}

const removeToast = (toast) => {
  toast.classList.add("hide")
  if (toast.timeoutId) clearTimeout(toast.timeoutId)
  setTimeout(() => toast.remove(), 500)
}

const createToast = (id, message) => {
  const { icon } = toastDetails[id]
  const toast = document.createElement("li")
  toast.className = `toast ${id}`
  toast.innerHTML = `<div class="column">
                         ${icon}
                         <span>${message}</span>
                      </div>
                      <div class='toast-close-container' onclick="removeToast(this.parentElement)">
                        <svg class="toast-icon" fill="currentColor" xmlns="http://www.w3.org/2000/svg" 
                        viewBox="0 100 384 512"><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 
                        86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 
                        0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 
                        0-45.3L237.3 256 342.6 150.6z"/></svg>
                      </div>`
  notifications.appendChild(toast)
  toast.timeoutId = setTimeout(() => removeToast(toast), toastDetails.timer)
}
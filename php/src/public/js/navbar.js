function handleToggle() {
  document.getElementById('profile-card').classList.toggle('hidden');
}

const profileToggle = document.getElementById('profile-toggle');
if (profileToggle) {
  profileToggle.addEventListener('click', handleToggle);
}
function handleToggle() {
  const profileCard = document.getElementById('profile-card');
  profileCard.classList.toggle('hidden');
}

function handleClickOutside(event) {
  const profileCard = document.getElementById('profile-card');
  const profileToggle = document.getElementById('profile-toggle-icon');
  
  if (!profileCard.contains(event.target) && !profileToggle.contains(event.target)) {
    profileCard.classList.add('hidden');
  }
}

const profileToggle = document.getElementById('profile-toggle-icon');
if (profileToggle) {
  profileToggle.addEventListener('click', handleToggle);
  document.addEventListener('click', handleClickOutside);
}
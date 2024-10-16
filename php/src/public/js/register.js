const registerForm = document.getElementById('register-form');
const regType = document.getElementById('reg-type');

function handleTypeChange(e) {
  const jobSeekerNav = document.getElementById('jobskr-nav');
  const compNav = document.getElementById('comp-nav');
  jobSeekerNav.classList.toggle('selected');
  compNav.classList.toggle('selected');

  const compForm = document.getElementById('company-form');
  compForm.classList.toggle('hidden');
}

function validateEmail(email) {
  if (!email) return 'Email is required';

  const isValidEmail = /^\S+@\S+$/g;
  if (!isValidEmail.test(email)) {
    return 'Please enter a valid email';
  }

  return '';
}

function validateField(field, fieldName) {
  if (!field) {
    return `${fieldName} is required`;
  }
  return '';
}

function validatePassword(password) {
  if (!password) return 'Password is required';

  if (password.length < 8) {
    return `Please enter a password that's at least 8 characters long`;
  }
  return '';
}

function validateConfirmPassword(password, confirmPassword) {
  if (!password || !confirmPassword || password !== confirmPassword) {
    return 'Passwords do not match';
  }
  return '';
}

async function onSubmit(e) {
  e.preventDefault();
  const submitButton = document.getElementById('submit-button');
  submitButton.disabled = true;
  submitButton.classList.toggle('loading');

  const formData = new FormData(registerForm);
  const name = formData.get('name');
  const email = formData.get('email');
  const password = formData.get('password');
  const confirmPassword = formData.get('confirm-password');
  const currType = regType.checked;

  let isValid = true;
  const arrayCheck = [['name', validateField(name, 'Name')], ['email', validateEmail(email)], ['password', validatePassword(password)], ['confirm-password', validateConfirmPassword(password, confirmPassword)]];

  if (currType) {
    const location = formData.get('location');
    const about = formData.get('about');
    arrayCheck.push(['location', validateField(location, 'Location')]);
    arrayCheck.push(['about', validateField(about, 'About')]);
  }

  for (let i = 0; i < arrayCheck.length; i++) {
    const currElmt = document.getElementById(arrayCheck[i][0]);
    console.log(arrayCheck[i][0]);
    console.log(arrayCheck[i][1]);
    document.getElementById(`${arrayCheck[i][0]}-error`).innerHTML = arrayCheck[i][1];
    if (arrayCheck[i][1]) {
      isValid = false;
      currElmt.classList.remove('normal-border');
      currElmt.classList.add('error-border');
    } else {
      currElmt.classList.add('normal-border');
      currElmt.classList.remove('error-border');
    }
  }

  let registerType = formData.get('reg-type') ?? 'jobseeker';
  formData.set('reg-type', registerType);

  submitButton.disabled = false;
  submitButton.classList.toggle('loading');
}

regType.addEventListener('change', handleTypeChange);
registerForm.addEventListener('submit', onSubmit);
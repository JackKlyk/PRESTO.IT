import 'bootstrap';

let sessionSuccess = document.getElementById("sessionSuccess");
let sessionEdit = document.getElementById("sessionEdit");
let sessionDelete = document.getElementById("sessionDelete");
let sessionRevisorSuccess = document.getElementById("sessionRevisorSuccess");
let sessionRevisorDelete = document.getElementById("sessionRevisorDelete");

// ! Nascondi il div dopo 3 secondi
setTimeout(function() {
    sessionSuccess.style.display = 'none';
}, 3000);

setTimeout(function() {
    sessionEdit.style.display = 'none';
}, 3000);

setTimeout(function() {
    sessionDelete.style.display = 'none';
}, 3000);

setTimeout(function() {
  sessionRevisorSuccess.style.display = 'none';
}, 3000);

setTimeout(function() {
  sessionRevisorDelete.style.display = 'none';
}, 3000);



// ! Show & Hidden Password
let passwordInput = document.getElementById('passwordInput');
let passwordConfirmInput = document.getElementById('passwordConfirmInput');
let showPasswordButton = document.getElementById('showPasswordButton');
let showConfirmPasswordButton = document.getElementById('showConfirmPasswordButton');

showPasswordButton.addEventListener('click', function () {
  if (passwordInput.type === 'password') {
    passwordInput.type = 'text';
    showPasswordButton.innerHTML = '<i class="bi bi-eye"></i>';
  } else {
    passwordInput.type = 'password';
    showPasswordButton.innerHTML = '<i class="bi bi-eye-slash"></i>';
  }
});

showConfirmPasswordButton.addEventListener('click', function () {
    if (passwordConfirmInput.type === 'password') {
      passwordConfirmInput.type = 'text';
      showConfirmPasswordButton.innerHTML = '<i class="bi bi-eye"></i>';
    } else {
      passwordConfirmInput.type = 'password';
      showConfirmPasswordButton.innerHTML = '<i class="bi bi-eye-slash"></i>';
    }
  });
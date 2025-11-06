/*=============== PASSWORD TOGGLE FUNCTION ===============*/
const setupPasswordToggles = () => {
  // Login page toggle
  const loginEye = document.querySelector('#loginPassword + .login__icon');
  const loginInput = document.getElementById('loginPassword');
  
  if (loginEye && loginInput) {
    loginEye.addEventListener('click', () => {
      loginInput.type = loginInput.type === 'password' ? 'text' : 'password';
      loginEye.classList.toggle('ri-eye-fill');
      loginEye.classList.toggle('ri-eye-off-fill');
    });
  }

  // Register page toggles
  const registerEye = document.querySelector('#registerPassword + .login__icon');
  const registerInput = document.getElementById('registerPassword');
  
  const registerConfirmEye = document.querySelector('#registerConfirmPassword + .login__icon');
  const registerConfirmInput = document.getElementById('registerConfirmPassword');

  if (registerEye && registerInput) {
    registerEye.addEventListener('click', () => {
      registerInput.type = registerInput.type === 'password' ? 'text' : 'password';
      registerEye.classList.toggle('ri-eye-fill');
      registerEye.classList.toggle('ri-eye-off-fill');
    });
  }

  if (registerConfirmEye && registerConfirmInput) {
    registerConfirmEye.addEventListener('click', () => {
      registerConfirmInput.type = registerConfirmInput.type === 'password' ? 'text' : 'password';
      registerConfirmEye.classList.toggle('ri-eye-fill');
      registerConfirmEye.classList.toggle('ri-eye-off-fill');
    });
  }
};

/*=============== INITIALIZE WHEN DOCUMENT LOADS ===============*/
document.addEventListener('DOMContentLoaded', setupPasswordToggles);
document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('login-form');
  const rutInput = document.getElementById('rut');
  const passwordInput = document.getElementById('password');
  const submitBtn = document.getElementById('submitBtn');

  form.addEventListener('submit', (e) => {
    if (!validarFormulario()) e.preventDefault();
  });

  rutInput.addEventListener('input', () => {
    formatearYValidarRUT(rutInput);
  });

  passwordInput.addEventListener('input', validarCampos);
});

function togglePassword() {
  const passwordInput = document.getElementById('password');
  const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
  passwordInput.setAttribute('type', type);
}

function formatearYValidarRUT(input) {
  const raw = input.value.replace(/\D/g, '');
  input.value = formatearRUT(raw);
  validarCampos();
}

function formatearRUT(rut) {
  if (rut.length < 2) return rut;
  const cuerpo = rut.slice(0, -1);
  const dv = rut.slice(-1);
  const cuerpoFormateado =
    cuerpo.length <= 7
      ? cuerpo.replace(/^(\d{1})(\d{3})(\d{3})$/, '$1.$2.$3')
      : cuerpo.replace(/^(\d{2})(\d{3})(\d{3})$/, '$1.$2.$3');
  return `${cuerpoFormateado}-${dv}`;
}

function validarFormulario() {
  const rut = document.getElementById('rut').value.trim();
  const password = document.getElementById('password').value;
  const rutError = document.getElementById('rut-error');
  const passwordError = document.getElementById('password-error');

  let valido = true;

  if (!validarRUT(rut)) {
    rutError.textContent = 'RUT inválido. Verifica el formato y dígito verificador.';
    valido = false;
  } else {
    rutError.textContent = '';
  }

  if (!validarPassword(password)) {
    passwordError.textContent =
      'Debe tener 8 caracteres, mayúscula, minúscula, número y símbolo.';
    valido = false;
  } else {
    passwordError.textContent = '';
  }

  return valido;
}

function validarCampos() {
  const rut = document.getElementById('rut').value.trim();
  const password = document.getElementById('password').value;
  const submitBtn = document.getElementById('submitBtn');

  const rutValido = validarRUT(rut);
  const passValida = validarPassword(password);

  submitBtn.disabled = !(rutValido && passValida);
}

function validarRUT(rut) {
  rut = rut.replace(/\./g, '').replace('-', '');
  if (rut.length < 8 || rut.length > 9) return false;

  const cuerpo = rut.slice(0, -1);
  let dv = rut.slice(-1).toUpperCase();

  let suma = 0;
  let multiplo = 2;

  for (let i = cuerpo.length - 1; i >= 0; i--) {
    suma += parseInt(cuerpo.charAt(i)) * multiplo;
    multiplo = multiplo < 7 ? multiplo + 1 : 2;
  }

  const dvEsperado = 11 - (suma % 11);
  let dvCalculado = dvEsperado === 11 ? '0' : dvEsperado === 10 ? 'K' : dvEsperado.toString();

  return dv === dvCalculado;
}

function validarPassword(password) {
  const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8}$/;
  return regex.test(password);
}
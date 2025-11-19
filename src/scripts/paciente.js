document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('pacienteForm');
  const guardarBtn = document.getElementById('guardarBtn');
  const regionSelect = document.getElementById('region');
  const comunaSelect = document.getElementById('comuna');

  form.addEventListener('input', validarFormulario);
  form.addEventListener('submit', (e) => {
    e.preventDefault();
    alert('Paciente guardado correctamente.');
  });

  document.getElementById('crearBtn').addEventListener('click', () => {
    alert('Modo creación activado.');
  });

  document.getElementById('editarBtn').addEventListener('click', () => {
    alert('Modo edición activado.');
  });

  regionSelect.addEventListener('change', cargarComunas);

  fetch('get_regiones.php')
    .then((res) => res.json())
    .then((data) => {
      data.forEach((region) => {
        const option = document.createElement('option');
        option.value = region;
        option.textContent = region;
        regionSelect.appendChild(option);
      });
    });

  function cargarComunas() {
    const region = regionSelect.value;
    comunaSelect.innerHTML = '';

    fetch(`get_comunas.php?region=${region}`)
      .then((res) => res.json())
      .then((data) => {
        data.forEach((comuna) => {
          const option = document.createElement('option');
          option.value = comuna;
          option.textContent = comuna;
          comunaSelect.appendChild(option);
        });
      });
  }

  function validarFormulario() {
    const nombre = document.getElementById('nombre').value.trim();
    const apellidos = document.getElementById('apellidos').value.trim();
    const direccion = document.getElementById('direccion').value.trim();
    const region = regionSelect.value;
    const comuna = comunaSelect.value;
    const mail = document.getElementById('mail').value.trim();
    const fono = document.getElementById('fono').value.trim();

    const mailValido = mail === '' || /^[^@\s]+@[^@\s]+\.[^@\s]+$/.test(mail);
    const fonoValido = fono === '' || /^\d+$/.test(fono);

    const camposObligatorios = nombre && apellidos && direccion && region && comuna;
    const contactoValido = mailValido && fonoValido && (mail || fono);

    guardarBtn.disabled = !(camposObligatorios && contactoValido);
  }
});
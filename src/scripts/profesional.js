document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('profesionalForm');
  const guardarBtn = document.getElementById('guardarBtn');
  const regionSelect = document.getElementById('region');
  const comunaSelect = document.getElementById('comuna');

  form.addEventListener('input', validarFormulario);
  form.addEventListener('submit', (e) => {
    e.preventDefault();
    alert('Profesional guardado correctamente.');
    // Aquí puedes agregar lógica para enviar los datos vía fetch o AJAX
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
    const rut = document.getElementById('rut').value.trim();
    const nombre = document.getElementById('nombre').value.trim();
    const apellidos = document.getElementById('apellidos').value.trim();
    const profesion = document.getElementById('profesion').value.trim();
    const registro = document.getElementById('registro').value.trim();
    const region = regionSelect.value;
    const comuna = comunaSelect.value;
    const fecha = document.getElementById('fecha_ingreso').value;
    const activo = document.querySelector('input[name="activo"]:checked');
    const mail = document.getElementById('mail').value.trim();

    const mailValido = mail === '' || /^[^@\s]+@[^@\s]+\.[^@\s]+$/.test(mail);
    const camposObligatorios =
      rut && nombre && apellidos && profesion && registro && region && comuna && fecha && activo;
    const contactoValido = mailValido;

    guardarBtn.disabled = !(camposObligatorios && contactoValido);
  }
});
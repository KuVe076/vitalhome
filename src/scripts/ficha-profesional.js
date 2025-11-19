document.addEventListener('DOMContentLoaded', () => {
  const rutProfesional = new URLSearchParams(window.location.search).get('rut');

  if (!rutProfesional) return;

  fetch(`get_ficha_profesional.php?rut=${rutProfesional}`)
    .then((res) => res.json())
    .then((data) => {
      document.getElementById('rut').textContent = data.rut;
      document.getElementById('nombre').textContent = data.nombre;
      document.getElementById('apellidos').textContent = data.apellidos;
      document.getElementById('profesion').textContent = data.profesion;
      document.getElementById('registro').textContent = data.registro_sis;
      document.getElementById('mail').textContent = data.mail || '—';
      document.getElementById('region').textContent = data.region;
      document.getElementById('comuna').textContent = data.comuna;
      document.getElementById('fecha').textContent = data.fecha_ingreso;
      document.getElementById('activo').textContent = data.activo ? 'SI' : 'NO';
      document.getElementById('motivo').textContent = data.motivo || '—';

      if (data.cv_path) {
        document.getElementById('cvHref').href = data.cv_path;
        document.getElementById('cvLink').style.display = 'block';
      }
    });
});
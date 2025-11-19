let profesionales = [];

document.addEventListener('DOMContentLoaded', async () => {
  await cargarFiltros();
  await cargarProfesionales();

  document.getElementById('region').addEventListener('change', filtrar);
  document.getElementById('comuna').addEventListener('change', filtrar);
  document.getElementById('profesion').addEventListener('change', filtrar);
});

async function cargarFiltros() {
  const regionRes = await fetch('get_regiones.php');
  const regiones = await regionRes.json();
  const regionSelect = document.getElementById('region');
  regiones.forEach((r) => {
    const opt = document.createElement('option');
    opt.value = r;
    opt.textContent = r;
    regionSelect.appendChild(opt);
  });

  const profesionRes = await fetch('get_profesiones.php');
  const profesiones = await profesionRes.json();
  const profesionSelect = document.getElementById('profesion');
  profesiones.forEach((p) => {
    const opt = document.createElement('option');
    opt.value = p;
    opt.textContent = p;
    profesionSelect.appendChild(opt);
  });
}

async function cargarComunas(region) {
  const comunaSelect = document.getElementById('comuna');
  comunaSelect.innerHTML = '<option value="">Todas las comunas</option>';
  if (!region) return;

  const res = await fetch(`get_comunas.php?region=${region}`);
  const comunas = await res.json();
  comunas.forEach((c) => {
    const opt = document.createElement('option');
    opt.value = c;
    opt.textContent = c;
    comunaSelect.appendChild(opt);
  });
}

async function cargarProfesionales() {
  const res = await fetch('get_profesionales.php');
  profesionales = await res.json();
  filtrar();
}

function filtrar() {
  const region = document.getElementById('region').value;
  const comuna = document.getElementById('comuna').value;
  const profesion = document.getElementById('profesion').value;

  if (region) cargarComunas(region);

  const filtrados = profesionales.filter((p) => {
    return (
      (!region || p.region === region) &&
      (!comuna || p.comuna === comuna) &&
      (!profesion || p.profesion === profesion)
    );
  });

  const tbody = document.querySelector('#tablaProfesionales tbody');
  tbody.innerHTML = '';

  const noData = document.getElementById('noData');
  if (filtrados.length === 0) {
    noData.style.display = 'block';
    return;
  }

  noData.style.display = 'none';

  filtrados.forEach((p) => {
    const row = document.createElement('tr');
    row.innerHTML = `
      <td><a href="ficha_profesional.html?rut=${encodeURIComponent(p.rut)}" target="_blank">${p.rut}</a></td>
      <td>${p.nombre}</td>
      <td>${p.apellidos}</td>
      <td>${p.profesion}</td>
      <td>${p.registro_sis}</td>
      <td>${p.region}</td>
      <td>${p.comuna}</td>
      <td>${p.fecha_ingreso}</td>
      <td>${p.activo ? 'SI' : 'NO'}</td>
    `;
    tbody.appendChild(row);
  });
}
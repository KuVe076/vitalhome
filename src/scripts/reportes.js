document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('formReporte');
  const tablaContainer = document.getElementById('tablaReporte');

  form.addEventListener('submit', async (e) => {
    e.preventDefault();

    const rut = document.getElementById('reporte_rut').value;
    const inicio = document.getElementById('reporte_inicio').value;
    const fin = document.getElementById('reporte_fin').value;
    const estado = document.getElementById('reporte_estado').value;

    const params = new URLSearchParams({ rut, inicio, fin, estado });
    const res = await fetch('/api/reportes.php?' + params.toString());
    const data = await res.json();

    const tabla = document.createElement('table');
    tabla.className = 'table table-bordered table-striped';
    tabla.innerHTML = `
      <thead>
        <tr>
          <th>Fecha</th>
          <th>Hora</th>
          <th>Paciente</th>
          <th>Estado</th>
          <th>Registrado por</th>
        </tr>
      </thead>
      <tbody>
        ${data
          .map(
            (r) => `
          <tr>
            <td>${r.fecha}</td>
            <td>${r.hora}</td>
            <td>${r.paciente_nombre} (${r.paciente_rut})</td>
            <td>${r.estado}</td>
            <td>${r.registrado_por}</td>
          </tr>
        `
          )
          .join('')}
      </tbody>
    `;

    tablaContainer.innerHTML = '';
    tablaContainer.appendChild(tabla);
  });
});
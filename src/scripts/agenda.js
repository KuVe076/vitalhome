document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('formReserva');
  const consultarBtn = document.getElementById('consultarBtn');

  form.addEventListener('submit', async (e) => {
    e.preventDefault();

    const data = {
      profesional_nombre: form.professional_nombre.value,
      profesional_rut: form.professional_rut.value,
      paciente_nombre: form.paciente_nombre.value,
      paciente_rut: form.paciente_rut.value,
      fecha: form.fecha.value,
      hora: form.hora.value,
      estado: 'activa',
      registrado_por: form.professional_nombre.value,
    };

    const res = await fetch('/api/index.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(data),
    });

    const result = await res.json();
    alert('Reserva creada con ID: ' + result.id);
    form.reset();
  });

  consultarBtn.addEventListener('click', async () => {
    const rut = document.getElementById('buscar_rut').value;
    const fecha = document.getElementById('buscar_fecha').value;
    const res = await fetch(`/api/index.php?profesional_rut=${rut}&fecha=${fecha}`);
    const data = await res.json();

    const contenedor = document.getElementById('resultados');
    contenedor.innerHTML = '<h5>Reservas encontradas:</h5>';

    if (data.length === 0) {
      contenedor.innerHTML += '<p>No hay reservas para esta fecha.</p>';
      return;
    }

    data.forEach((r) => {
      const div = document.createElement('div');
      div.className = 'slot';
      div.innerText = `${r.hora} - ${r.paciente_nombre} (${r.paciente_rut})`;
      contenedor.appendChild(div);
    });
  });
});
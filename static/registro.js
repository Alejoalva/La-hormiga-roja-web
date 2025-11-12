document.getElementById('formRegistro').addEventListener('submit', async function (e) {
  e.preventDefault();
  const nombre = document.getElementById('nombre').value;
  const email = document.getElementById('email').value;
  const password = document.getElementById('password').value;

  const respuesta = await fetch('php/registro.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ nombre, email, password })
  });

  const data = await respuesta.json();
  document.getElementById('mensaje').innerText = data.mensaje;
});

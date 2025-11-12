document.getElementById('formLogin').addEventListener('submit', async function (e) {
  e.preventDefault();
  const email = document.getElementById('email').value;
  const password = document.getElementById('password').value;

  const respuesta = await fetch('php/login.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ email, password })
  });

  const data = await respuesta.json();
  if (data.acceso === true) {
    window.location.href = 'cursos.html';
  } else {
    document.getElementById('mensaje').innerText = data.mensaje;
  }
});

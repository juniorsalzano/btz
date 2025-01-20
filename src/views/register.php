<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro</title>
  <link rel="stylesheet" href="/css/styles.css">
  <link rel="stylesheet" href="/css/register.css">
</head>
<body>
  <div class="register-container">
    <h1>Cadastro</h1>
    <form method="POST" action="/register">
      <label for="name">Nome:</label>
      <input type="text" id="name" name="name" required>
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>
      <label for="password">Senha:</label>
      <input type="password" id="password" name="password" required>
      <label for="zip_code">CEP:</label>
      <input type="text" id="zip_code" name="zip_code" required>
      <label for="address">Endereço:</label>
      <input type="text" id="address" name="address" required>
      <label for="neighborhood">Bairro:</label>
      <input type="text" id="neighborhood" name="neighborhood" required>
      <label for="city">Cidade:</label>
      <input type="text" id="city" name="city" required>
      <label for="state">Estado:</label>
      <input type="text" id="state" name="state" required>
      <button type="submit">Cadastrar</button>
    </form>
  </div>
  <script src="/js/main.js"></script>
  <script>
    document.getElementById('zip_code').addEventListener('blur', function() {
      const cep = this.value.replace(/\D/g, '');
      if (cep.length === 8) {
        fetch(`https://viacep.com.br/ws/${cep}/json/`)
          .then(response => response.json())
          .then(data => {
            if (!data.erro) {
              document.getElementById('address').value = data.logradouro;
              document.getElementById('neighborhood').value = data.bairro;
              document.getElementById('city').value = data.localidade;
              document.getElementById('state').value = data.uf;
            } else {
              alert('CEP não encontrado.');
            }
          })
          .catch(error => {
            console.error('Erro ao buscar o CEP:', error);
            alert('Erro ao buscar o CEP.');
          });
      } else {
        alert('CEP inválido.');
      }
    });
  </script>
</body>
</html>
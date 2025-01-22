<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="/css/home.css">
</head>

<body>
  <div class="container mt-5">
    <h2 class="text-center mb-4">Cadastro</h2>
    <form method="POST" action="/register">
      <div class="form-group">
        <label for="name">Nome:</label>
        <input type="text" class="form-control" id="name" name="name" required>
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="password">Senha:</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>
      <div class="form-group">
        <label for="zip_code">CEP:</label>
        <input type="text" class="form-control" id="zip_code" name="zip_code" required>
      </div>
      <div class="form-group">
        <label for="address">Endereço:</label>
        <input type="text" class="form-control" id="address" name="address" required>
      </div>
      <div class="form-group">
        <label for="neighborhood">Bairro:</label>
        <input type="text" class="form-control" id="neighborhood" name="neighborhood" required>
      </div>
      <div class="form-group">
        <label for="city">Cidade:</label>
        <input type="text" class="form-control" id="city" name="city" required>
      </div>
      <div class="form-group">
        <label for="state">Estado:</label>
        <input type="text" class="form-control" id="state" name="state" required>
      </div>
      <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="/js/cep.js"></script>
</body>

</html>
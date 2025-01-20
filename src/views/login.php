<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="/css/styles.css">
  <link rel="stylesheet" href="/css/login.css">
</head>
<body>
  <div class="login-container">
    <h1>Login</h1>
    <form method="POST" action="/login">
      <label for="username">Nome de usuário:</label>
      <input type="text" id="username" name="username" required>
      <label for="password">Senha:</label>
      <input type="password" id="password" name="password" required>
      <button type="submit">Login</button>
    </form>
    <p>Não tem uma conta? <a href="/register">Cadastre-se aqui</a></p>
  </div>
  <script src="/js/main.js"></script>
</body>
</html>
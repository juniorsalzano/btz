<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="/css/styles.css">
  <link rel="stylesheet" href="/css/login.css">
</head>
<body>
  <div class="login-container">
    <h1>Login</h1>
    <?php if (!empty($error)): ?>
      <div class="alert alert-danger" role="alert">
        <?php echo $error; ?>
      </div>
    <?php endif; ?>
    <form method="POST" action="/login">
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>
      <label for="password">Senha:</label>
      <input type="password" id="password" name="password" required>
      <button type="submit">Login</button>
    </form>
    <p>Não tem uma conta? <a href="/register">Cadastre-se aqui</a></p>
  </div>
  <script src="/js/main.js"></script>
</body>
</html>
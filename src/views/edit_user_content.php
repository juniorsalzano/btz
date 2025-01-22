<?php
if (isset($params['user'])) {
  $user = $params['user'];
  $isAdmin = isset($_SESSION['user_access_level']) && $_SESSION['user_access_level'] === 'A'; // Verificar se o usuário logado é um administrador
?>
  <?php if (isset($_GET['message'])): ?>
    <div class="alert alert-info">
      <?php echo htmlspecialchars($_GET['message']); ?>
    </div>
  <?php endif; ?>
  <form action="/update_user?id=<?php echo $user['id']; ?>" method="post">
    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
    <div class="form-group">
      <label for="name">Nome</label>
      <input type="text" class="form-control" id="name" name="name" value="<?php echo $user['name']; ?>" required>
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>" disabled>
    </div>
    <div class="form-group">
      <label for="zip_code">CEP</label>
      <input type="text" class="form-control" id="zip_code" name="zip_code" value="<?php echo $user['zip_code']; ?>" required>
    </div>
    <div class="form-group">
      <label for="address">Endereço</label>
      <input type="text" class="form-control" id="address" name="address" value="<?php echo $user['address']; ?>" required>
    </div>
    <div class="form-group">
      <label for="neighborhood">Bairro</label>
      <input type="text" class="form-control" id="neighborhood" name="neighborhood" value="<?php echo $user['neighborhood']; ?>" required>
    </div>
    <div class="form-group">
      <label for="city">Cidade</label>
      <input type="text" class="form-control" id="city" name="city" value="<?php echo $user['city']; ?>" required>
    </div>
    <div class="form-group">
      <label for="state">Estado</label>
      <input type="text" class="form-control" id="state" name="state" value="<?php echo $user['state']; ?>" required>
    </div>
    <div class="form-group">
      <label for="access_level">Nível de Acesso</label>
      <?php if ($isAdmin): ?>
        <select class="form-control" id="access_level" name="access_level" required>
          <option value="U" <?php echo $user['access_level'] === 'U' ? 'selected' : ''; ?>>Usuário</option>
          <option value="A" <?php echo $user['access_level'] === 'A' ? 'selected' : ''; ?>>Administrador</option>
        </select>
      <?php else: ?>
        <input type="text" class="form-control" id="access_level_display" value="<?php echo $user['access_level'] === 'A' ? 'Administrador' : 'Usuário'; ?>" disabled>
        <input type="hidden" name="access_level" value="<?php echo $user['access_level']; ?>">
      <?php endif; ?>
    </div>
    <button type="submit" class="btn btn-primary">Atualizar</button>
    <a href="/list_users" class="btn btn-secondary">Voltar</a>
  </form>
  <script src="/js/cep.js"></script>
<?php
} else {
  echo 'Usuário não encontrado.';
}
?>
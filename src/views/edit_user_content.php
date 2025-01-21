<section class="edit-user">
  <h2 class="text-center mb-4">Editar Informações do Usuário</h2>
  <form action="/update_user.php" method="post">
    <div class="form-group">
      <label for="username">Nome de Usuário</label>
      <input type="text" class="form-control" id="username" name="username" value="Nome Atual">
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" class="form-control" id="email" name="email" value="email@atual.com">
    </div>
    <button type="submit" class="btn btn-primary">Salvar</button>
  </form>
</section>
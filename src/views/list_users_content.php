<div class="container mt-5">
  <h2 class="text-center mb-4">Listar Usuários</h2>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($params['users'] as $user): ?>
        <tr>
          <td><?php echo $user['id']; ?></td>
          <td><?php echo $user['name']; ?></td>
          <td><?php echo $user['email']; ?></td>
          <td>
            <a href="/edit_user?id=<?php echo $user['id']; ?>" class="btn btn-primary">Editar</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
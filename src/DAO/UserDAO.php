<?php

require_once __DIR__ . '/../Database/Database.php';
require_once __DIR__ . '/../Models/User.php';

class UserDAO
{
  private $db;

  /**
   * Construtor da classe UserDAO.
   * Obtém a conexão com o banco de dados.
   */
  public function __construct()
  {
    $this->db = Database::getInstance()->getConnection();
  }

  /**
   * Cria um novo usuário no banco de dados.
   * 
   * @param User $user Objeto User a ser criado.
   * @return bool Retorna true se o usuário foi criado com sucesso, false caso contrário.
   */
  public function create(User $user)
  {
    $stmt = $this->db->prepare('INSERT INTO users (name, email, password, zip_code, address, neighborhood, city, state, access_level) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
    return $stmt->execute([
      $user->name,
      $user->email,
      $user->password,
      $user->zip_code,
      $user->address,
      $user->neighborhood,
      $user->city,
      $user->state,
      $user->access_level
    ]);
  }

  /**
   * Atualiza os dados de um usuário no banco de dados.
   * 
   * @param User $user Objeto User a ser atualizado.
   * @return bool Retorna true se o usuário foi atualizado com sucesso, false caso contrário.
   */
  public function updateUser(User $user)
  {
    $stmt = $this->db->prepare('UPDATE users SET name = ?, zip_code = ?, address = ?, neighborhood = ?, city = ?, state = ?, access_level = ? WHERE id = ?');
    return $stmt->execute([
      $user->name,
      $user->zip_code,
      $user->address,
      $user->neighborhood,
      $user->city,
      $user->state,
      $user->access_level,
      $user->id
    ]);
  }

  /**
   * Busca um usuário pelo email.
   * 
   * @param string $email Email do usuário.
   * @return array|false Retorna os dados do usuário como um array associativo ou false se não encontrado.
   */
  public function findByEmail($email)
  {
    $stmt = $this->db->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->execute([$email]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  /**
   * Busca um usuário pelo ID.
   * 
   * @param int $id ID do usuário.
   * @return array|false Retorna os dados do usuário como um array associativo ou false se não encontrado.
   */
  public function findById($id)
  {
    $stmt = $this->db->prepare('SELECT * FROM users WHERE id = ?');
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  /**
   * Busca todos os usuários que não são administradores.
   * 
   * @return array Retorna uma lista de usuários que não são administradores.
   */
  public function findAllNonAdminUsers()
  {
    $stmt = $this->db->prepare('SELECT * FROM users WHERE access_level != "A"');
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}

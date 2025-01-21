<?php

require_once __DIR__ . '/../Database/Database.php';
require_once __DIR__ . '/../Models/User.php';

/**
 * Classe UserDAO para gerenciar a interação com o banco de dados para a entidade User.
 */
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
   * @param User $user O objeto User a ser criado.
   * @return bool Retorna true se o usuário foi criado com sucesso, false caso contrário.
   */
  public function create(User $user)
  {
    $stmt = $this->db->prepare('INSERT INTO users (name, email, password, zip_code, address, neighborhood, city, state) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
    return $stmt->execute([
      $user->name,
      $user->email,
      $user->password,
      $user->zip_code,
      $user->address,
      $user->neighborhood,
      $user->city,
      $user->state
    ]);
  }

  public function findByEmail($email)
  {
    $stmt = $this->db->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->execute([$email]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }
}
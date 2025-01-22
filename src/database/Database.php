<?php

use Dotenv\Dotenv;

/**
 * Classe Database para gerenciar a conexão com o banco de dados.
 */
class Database
{
  private static $instance = null;
  private $conn;
  private $host;
  private $db_name;
  private $username;
  private $password;

  /**
   * Construtor da classe Database.
   * Carrega as variáveis de ambiente e valida as variáveis necessárias.
   */
  private function __construct()
  {
    $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
    $dotenv->load();

    $this->host = $_ENV['DB_HOST'] ?? 'localhost';
    $this->db_name = $_ENV['DB_NAME'] ?? '';
    $this->username = $_ENV['DB_USERNAME'] ?? '';
    $this->password = $_ENV['DB_PASSWORD'] ?? '';

    $this->validateEnvVariables();

    try {
      $this->conn = new PDO("mysql:host=$this->host;dbname=$this->db_name", $this->username, $this->password);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      die('Connection failed: ' . $e->getMessage());
    }
  }

  /**
   * Valida as variáveis de ambiente necessárias.
   * 
   * @throws Exception Se alguma variável de ambiente necessária estiver faltando.
   */
  private function validateEnvVariables()
  {
    if (empty($this->host)) {
      throw new Exception('DB_HOST não está definido no arquivo .env');
    }
    if (empty($this->db_name)) {
      throw new Exception('DB_NAME não está definido no arquivo .env');
    }
    if (empty($this->username)) {
      throw new Exception('DB_USERNAME não está definido no arquivo .env');
    }
  }

  /**
   * Obtém a instância única da classe Database.
   * 
   * @return Database Instância única da classe Database.
   */
  public static function getInstance()
  {
    if (self::$instance === null) {
      self::$instance = new Database();
    }
    return self::$instance;
  }

  /**
   * Obtém a conexão com o banco de dados.
   * 
   * @return PDO A conexão com o banco de dados.
   */
  public function getConnection()
  {
    return $this->conn;
  }

  /**
   * Fecha a conexão com o banco de dados.
   */
  public function close()
  {
    $this->conn = null;
  }

  /**
   * Executa uma consulta SQL.
   * 
   * @param string $sql Consulta SQL a ser executada.
   * @return PDOStatement Declaração PDO resultante da execução da consulta.
   */
  public function query($sql)
  {
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt;
  }

  /**
   * Obtém todos os resultados de uma consulta.
   * 
   * @param string $sql Consulta SQL a ser executada.
   * @return array Array associativo contendo todos os resultados da consulta.
   */
  public function fetchAll($sql)
  {
    $stmt = $this->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}
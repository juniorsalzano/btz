<?php

class HomeController
{
  /**
   * Método para renderizar a página inicial.
   */
  public function index()
  {
    require_once __DIR__ . '/../../src/views/home.php';
  }
}
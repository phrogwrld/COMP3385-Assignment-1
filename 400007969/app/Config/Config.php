<?php

namespace App\Config;

/**
 * A class for storing configuration values.
 */
final class Config {

  /**
   * The database configuration.
   *
   * @var array
   */
  private static array $database = [
    'host' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'user_management_system',
    'port' => 3306,
  ];

  /**
   * Gets the database configuration.
   *
   * @return array The database configuration.
   */
  public static function getDatabase(): array
  {
    return self::$database;
  }

  /**
   * Gets the database host.
   *
   * @return string The database host.
   */
  public static function getDatabaseHost(): string
  {
    return self::$database['host'];
  }

  /**
   * Gets the database username.
   *
   * @return string The database username.
   */
  public static function getDatabaseUsername(): string
  {
    return self::$database['username'];
  }

  /**
   * Gets the database password.
   *
   * @return string The database password.
   */
  public static function getDatabasePassword(): string
  {
    return self::$database['password'];
  }

  /**
   * Gets the database name.
   *
   * @return string The database name.
   */
  public static function getDatabaseName(): string
  {
    return self::$database['database'];
  }

  /**
   * Gets the database port.
   *
   * @return int The database port.
   */
  public static function getDatabasePort(): int
  {
    return self::$database['port'];
  }
}
<?php
// Simple DB check script: intenta conectar y cuenta administradores (no modifica nada)
require __DIR__ . '/../vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;

$env = parse_ini_file(__DIR__ . '/../.env', FALSE, INI_SCANNER_RAW);

// Fallback minimal config if parse fails
$dbConnection = $env['DB_CONNECTION'] ?? 'pgsql';
$dbHost = $env['DB_HOST'] ?? '127.0.0.1';
$dbPort = $env['DB_PORT'] ?? '5432';
$dbDatabase = $env['DB_DATABASE'] ?? '';
$dbUsername = $env['DB_USERNAME'] ?? '';
$dbPassword = $env['DB_PASSWORD'] ?? '';

echo "Comprobando conexión a la base de datos ({$dbConnection})...\n";

$capsule = new Capsule;
$capsule->addConnection([
    'driver'    => $dbConnection,
    'host'      => $dbHost,
    'port'      => $dbPort,
    'database'  => $dbDatabase,
    'username'  => $dbUsername,
    'password'  => $dbPassword,
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
]);

try {
    $capsule->getConnection()->getPdo();
    echo "Conexión OK\n";

    // Contar administradores (si existe la tabla)
    $count = 0;
    $schema = $capsule->getConnection()->getDoctrineSchemaManager();
    $tables = array_map('strtolower', $schema->listTableNames());
    if (in_array('administrador', $tables) || in_array('administradors', $tables)) {
        $count = $capsule->getConnection()->table('administrador')->count();
    }
    echo "Administradores en BD: {$count}\n";
} catch (\Throwable $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}

exit(0);

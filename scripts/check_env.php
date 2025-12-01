<?php
// Script simple para comprobar extensiones PDO y configuración mínima sin tocar la DB
echo "Verificando entorno PHP y extensiones necesarias...\n";
$checks = [
    'pdo' => extension_loaded('pdo'),
    'pdo_mysql' => extension_loaded('pdo_mysql'),
    'pdo_pgsql' => extension_loaded('pdo_pgsql'),
];

foreach ($checks as $ext => $ok) {
    echo sprintf("%s: %s\n", $ext, $ok ? 'OK' : 'FALTA');
}

echo "\nRevisar .env para DB_CONNECTION y credenciales. No se realiza conexión en este script.\n";

echo "Valores actuales (no sensibles se muestran):\n";
echo "DB_CONNECTION=" . getenv('DB_CONNECTION') . "\n";
echo "DB_HOST=" . getenv('DB_HOST') . "\n";
echo "DB_PORT=" . getenv('DB_PORT') . "\n";
echo "DB_DATABASE=" . getenv('DB_DATABASE') . "\n";

exit(0);

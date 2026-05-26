<?php


$hash = '$2y$10$EEzxBAX/4XzR.9rblTgWlOjmucGL6wfAdHlUMm.OZUqH/uEYiWR/G'; // hash que guardaste en DB
$pass = 'hola';

if (password_verify($pass, $hash)) {
    echo "✅ Contraseña correcta";
} else {
    echo "❌ Contraseña incorrecta";
}

php -r "echo password_hash('hola', PASSWORD_BCRYPT);"
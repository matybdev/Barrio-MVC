<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once 'config/database.php';
require_once 'funciones.php';

$db = conectarDB();

use Model\ActiveRecord;

ActiveRecord::setDB($db);
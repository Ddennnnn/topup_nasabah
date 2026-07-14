<?php

declare(strict_types=1);

use Illuminate\Support\Facades\DB;

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$cols = DB::select("SHOW COLUMNS FROM audit_logs");

foreach ($cols as $c) {
    $field = $c->Field ?? '';
    $type = $c->Type ?? '';
    $null = $c->Null ?? '';
    echo $field . ' | ' . $type . ' | Null=' . $null . PHP_EOL;
}


<?php

Yii::setAlias('config', __DIR__);

$db = require(__DIR__ . '/db.php');
$params = require(__DIR__ . '/params.php');

$aliases = require(__DIR__ . '/aliases.php');
foreach ($aliases as $alias => $path) {
    Yii::setAlias($alias, $path);
}

return [
    'timeZone' => 'Europe/Moscow',
    'modules' => [
        'data' => [
            'class' => 'app\data\Module',
            'layout' => '@app/backend/views/layouts/main',
        ],
        'config' => [
            'class' => 'app\modules\config\ConfigModule',
        ],
        'core' => [
            'class' => 'app\modules\core\CoreModule',
        ],
    ],
    'components' => [
        'db' => $db,
        'formatter' => [
            'class' => 'app\components\Formatter',
        ],
        'updateHelper' => [
            'class' => 'app\modules\core\helpers\UpdateHelper',
        ]
    ],
    'params' => $params,
];

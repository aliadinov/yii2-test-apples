<?php

namespace console\controllers;

use common\services\ApplesService;
use yii\console\Controller;

class ApplesController extends Controller
{
    protected ApplesService $applesService;

    public function __construct($id, $module, $config, ApplesService $applesService)
    {
        parent::__construct($id, $module, $config);

        $this->applesService = $applesService;
    }

    /**
     * php yii apples/mark-rotten
     */
    public function actionMarkRotten(): void
    {
        $count = $this->applesService->markRottenApples();
        echo "Сгнило $count яблок\n";
    }
}

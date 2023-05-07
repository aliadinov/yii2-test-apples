<?php

namespace backend\models\forms;

use common\models\Apple;
use common\services\ApplesService;
use yii\base\Model;

class EatAppleForm extends Model
{
    /** @var int */
    public $appleId;

    /** @var float $size */
    public $size;

    private ?Apple $apple = null;

    private ApplesService $applesService;

    public function __construct($config = [])
    {
        parent::__construct($config);

        $this->applesService = \Yii::$container->get(ApplesService::class);
    }

    public function rules(): array
    {
        return [
            [['appleId', 'size'], 'required'],
            ['appleId', 'checkAppleExistence'],
            ['size', 'number', 'min' => 0 , 'max' => 100, 'message' => 'Неверный размер куска'],
        ];
    }

    public function checkAppleExistence(): void
    {
        $this->apple = $this->applesService->finById($this->appleId);

        if (!$this->apple) {
            $this->addError('appleId', 'Яблоко не существует');
        }
    }

    public function getApple(): Apple
    {
        return $this->apple;
    }
}

<?php

namespace backend\models\forms;

use common\models\Apple;
use common\repositories\AppleRepository;
use yii\base\Model;

class FallAppleForm extends Model
{
    /** @var int|null $appleId */
    public $appleId = null;

    private ?Apple $apple = null;

    private AppleRepository $repository;

    public function __construct(AppleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function rules(): array
    {
        return [
            ['appleId', 'required'],
            ['appleId', 'checkAppleExistence']
        ];
    }

    public function checkAppleExistence(): void
    {
        $this->apple = $this->repository->finById($this->appleId);

        if (!$this->apple) {
            $this->addError('appleId', 'Яблоко не существует');
        }
    }

    public function getApple(): Apple
    {
        return $this->apple;
    }
}

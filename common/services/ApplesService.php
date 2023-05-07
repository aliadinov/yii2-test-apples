<?php

namespace common\services;

use common\models\Apple;
use common\models\enums\AppleColor;
use common\models\enums\AppleStatus;
use common\repositories\AppleRepository;
use yii\base\Exception;

class ApplesService
{
    private AppleRepository $repository;

    public function __construct(AppleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function generateRandomApples(): void
    {
        $count = rand(1, 20);
        for ($i = 1; $i <= $count; $i++) {
            $apple         = new Apple();
            $apple->color  = AppleColor::getRandomColor();
            $apple->status = AppleStatus::ON_TREE;

            $this->repository->save($apple);
        }
    }

    public function regenerateRandomApples(): void
    {
        $this->repository->deleteAll();
        $this->generateRandomApples();
    }

    /** @throws Exception */
    public function fallToGround(Apple $apple): void
    {
        if ($apple->status !== AppleStatus::ON_TREE) {
            throw new Exception('Только яблоко, висящее на дереве, может упасть');
        }

        $apple->status  = AppleStatus::ON_GROUND;
        $apple->fell_at = date('Y-m-d H:i:s', time());
        $this->repository->save($apple);
    }

    /** @throws Exception */
    public function eat(Apple $apple, float $size): void
    {
        if ($apple->status !== AppleStatus::ON_GROUND) {
            throw new Exception('Съесть можно только яблоко, лежащее на земля');
        }

        if ($size < 0 || $size > $apple->size) {
            throw new Exception('Нельзя откусить такой кусок от яблока');
        }

        $apple->size -= $size;
        $this->repository->save($apple);

        if ($apple->size <= 0) {
            $this->repository->delete($apple);
        }
    }
}
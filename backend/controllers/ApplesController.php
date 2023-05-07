<?php

namespace backend\controllers;

use backend\models\forms\EatAppleForm;
use backend\models\forms\FallAppleForm;
use common\services\ApplesService;
use yii\base\Exception;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;

class ApplesController extends Controller
{
    protected ApplesService $appleService;

    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'regenerate-random-apples', 'fall-to-ground', 'eat-apple', 'remove-apple'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'regenerate-random-apples' => ['post'],
                    'fall-to-ground' => ['post'],
                    'eat-apple' => ['post'],
                    'remove-Apple' => ['post'],
                ],
            ],
        ];
    }

    public function __construct($id, $module, $config, ApplesService $appleService)
    {
        parent::__construct($id, $module, $config);

        $this->appleService = $appleService;
    }

    public function actionIndex(): string
    {
        return $this->render('index', [
            'apples'          => $this->appleService->getAllApples(),
            'eatAppleForm'    => new EatAppleForm(),
            'fallAppleForm'   => new FallAppleForm(),
        ]);
    }

    public function actionRegenerateRandomApples(): array|Response
    {
        $success = false;

        try {
            $this->appleService->regenerateRandomApples();
            $success = true;
            $message = 'Яблоки успешно сгенерированы';
        } catch (Exception $e) {
            $message = $e->getMessage();
        }

        if (request()->isAjax) {
            return $this->ajaxResponse($success, $message);
        } else {
            session()->setFlash('success', $message);
            return $this->redirect('index');
        }
    }

    public function actionFallToGround(): array|Response
    {
        $success = false;

        $fallAppleForm = new FallAppleForm();
        if ($fallAppleForm->load(request()->post()) && $fallAppleForm->validate()) {
            try {
                $this->appleService->fallToGround($fallAppleForm->getApple());
                $success = true;
                $message = 'Яблоко успешно упало';
            } catch (Exception $e) {
                $message = $e->getMessage();
            }
        } else {
            $message = 'Ошибка валидации: ' . json_encode($fallAppleForm->errors, JSON_UNESCAPED_UNICODE);
        }

        if (request()->isAjax) {
            return $this->ajaxResponse($success, $message);
        } else {
            session()->setFlash($success ? 'success' : 'error', $message);
            return $this->redirect('index');
        }
    }

    public function actionEatApple(): array|Response
    {
        $success = false;

        $eatAppleForm = new EatAppleForm();
        if ($eatAppleForm->load(request()->post()) && $eatAppleForm->validate()) {
            try {
                $this->appleService->eat($eatAppleForm->getApple(), $eatAppleForm->size);
                $success = true;
                $message = 'Яблоко успешно откушено';
            } catch (Exception $e) {
                $message = $e->getMessage();
            }
        } else {
            $message = 'Ошибка валидации: ' . json_encode($eatAppleForm->errors, JSON_UNESCAPED_UNICODE);
        }

        if (request()->isAjax) {
            return $this->ajaxResponse($success, $message);
        } else {
            session()->setFlash($success ? 'success' : 'error', $message);
            return $this->redirect('index');
        }
    }

    protected function ajaxResponse(bool $success, string $message): array
    {
        response()->format = Response::FORMAT_JSON;

        return [
            'success' => $success,
            'html' => [
                'cssClass' => '.apples__wrapper',
                'layout'   => $this->renderPartial('index', [
                    'apples'          => $this->appleService->getAllApples(),
                    'eatAppleForm'    => new EatAppleForm(),
                    'fallAppleForm'   => new FallAppleForm(),
                ])
            ],
            'message' => $message,
        ];
    }
}

<?php

use yii\helpers\Url;
use yii\base\Application;
use yii\web\Request;
use yii\web\Response;
use yii\web\Session;

function url(array $params, bool $scheme = false): string
{
    return Url::to($params, $scheme);
}

function request(): Request
{
    return Yii::$app->request;
}

function response(): Response
{
    return Yii::$app->response;
}

function session(): Session
{
    return Yii::$app->session;
}

function app(): Application
{
    return Yii::$app;
}

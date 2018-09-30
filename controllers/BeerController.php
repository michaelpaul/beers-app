<?php

namespace app\controllers;

use app\models\Beer;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;

class BeerController extends ActiveController
{
    public $modelClass = 'app\models\Beer';

    /**
     * @return Beer
     * @throws NotFoundHttpException
     */
    public function actionRandom()
    {
        $beer = Beer::find()->random();
        if (!$beer) {
            throw new NotFoundHttpException('Beer\'s over!');
        }
        return $beer;
    }
}
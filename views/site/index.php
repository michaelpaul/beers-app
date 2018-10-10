<?php
/* @var $this yii\web\View */
/* @var $beer \app\models\Beer */

use yii\helpers\Html;

$this->title = Yii::$app->name;
$this->params['breadcrumbs'] = [];
?>
<div class="site-index">
    <div class="jumbotron">
        <h1 class="js-name"><?php echo Html::encode($beer->name); ?></h1>
        <p class="lead js-desc"><?php echo Html::encode($beer->description); ?></p>
        <p>Alcohol by volume: <span class="js-abv"><?php echo $beer->getAbvText(); ?></span></p>
        <p>Brewery Location: <span class="js-location"><?php echo Html::encode($beer->getBreweryLocationText()); ?></span></p>
        <p><a class="btn btn-lg btn-success js-another" href="<?php echo Yii::$app->getHomeUrl(); ?>">Get another round</a></p>
    </div>
</div>


<?php
/*use common\components\Html;*/
use yii\helpers\Html;

?>
<div>

    <h1>Ошибка!</h1>

    <?php
    if
    (
        isset(Yii::$app->user)
        && Yii::$app->user !== null
        && ($user = Yii::$app->user->identity) !== null
    )
    {
        echo Html::tag('p', $user->email);
    }

    if
    (
        isset(Yii::$app->user)
        && Yii::$app->user !== null
        && ($parenturl = Yii::$app->user->getReturnUrl()) !== null
        && !empty($parenturl)
        && $parenturl != '/'
    )
    {
        echo Html::tag('p', 'Parent URL: '.$parenturl);
    }

    if
    (
        ($url = Yii::$app->request->url) !== null
    )
    {
        echo Html::tag('p', 'URL: '.$url);
    }

    echo Html::tag('pre', $message);
    ?>
</div>
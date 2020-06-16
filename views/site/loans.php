<?php
use yii\grid\GridView;

/**
 * @var \yii\data\ActiveDataProvider $dataProvider
 */
?>

<h1 class="page-header">История займов</h1>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
//    'options'
    'columns' => [
        'id',
        [
            'attribute' => 'sum',
            'value' => function($model) {
                return number_format($model->sum, 0, '.', ' ');
            }
        ],
        'date',
        'period',
        [
            'label' => 'Ставка, %',
            'attribute' => 'percent',
        ],
        'created_at',

        [
            'class' => '\yii\grid\ActionColumn',
            'template' => '{view}',
            'contentOptions' => ['class' => 'text-center'],
            'buttonOptions' => ['class' => 'btn btn-xs btn-default']
        ]
    ]
]);
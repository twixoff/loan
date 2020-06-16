<?php
use yii\bootstrap\Html;
use kartik\slider\Slider;
use kartik\date\DatePicker;
use yii\bootstrap\ActiveForm;
?>

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h1 class="page-header">Расчет платежей</h1>

        <?php $form = ActiveForm::begin(); ?>
            <div class="row">
                <div class="col-sm-6">
                    <div style="max-width: 250px;">
                        <?= $form->field($model, 'date')->widget(DatePicker::classname(), [
                            'options' => ['placeholder' => 'Укажите дату...'],
                            'value' => date('Y-m-d', strtotime('+1 week')),
                            'language' => 'ru-RU',
                            'type' => DatePicker::TYPE_COMPONENT_APPEND,
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'dd-mm-yyyy'
                            ]
                        ]); ?>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <div style="padding-bottom: 8px;">
                            <label class="control-label"><?= $model->getAttributeLabel('sum') ?></label>
                        </div>
                        <b class="badge">1 000 000</b>
                        <?= Slider::widget([
                            'name' => (new ReflectionClass($model))->getShortName().'[sum]',
                            'value' => 1500000,
                            'pluginOptions' => [
                                'min' => 1000000,
                                'max' => 5000000,
                                'step' => 100000,
                            ],
                        ]) ?>
                        <b class="badge">5 000 000</b>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <div>
                            <label class="control-label"><?= $model->getAttributeLabel('period') ?></label>
                        </div>
                        <b class="badge">1</b>
                        <?= Slider::widget([
                                'name' => (new ReflectionClass($model))->getShortName().'[period]',
                                'value' => '5',
                                'pluginOptions' => [
                                    'min' => 1,
                                    'max' => 60,
                                    'step' => 1,
                                ],
                            ]) ?>
                        <b class="badge">60</b>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <div>
                            <label class="control-label"><?= $model->getAttributeLabel('percent') ?></label>
                        </div>
                        <b class="badge">10</b>
                        <?= Slider::widget([
                            'name' => (new ReflectionClass($model))->getShortName().'[percent]',
                            'value' => '15',
                            'pluginOptions' => [
                                'min' => 10,
                                'max' => 25,
                                'step' => 0.5,
                            ],
                        ]) ?>
                        <b class="badge">25</b>
                    </div>
                </div>
            </div>

            <div class="text-center" style="margin-top: 40px;">
                <?= Html::submitButton('Получить займ', ['class' => 'btn btn-primary'],
                    ['data-perfom' => 'Согласны с условиями?']) ?>
            </div>

        <?php ActiveForm::end() ?>
    </div>
</div>
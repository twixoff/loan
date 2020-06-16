<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%loans}}".
 *
 * @property int $id
 * @property string|null $date
 * @property int|null $sum
 * @property int|null $period
 * @property float|null $percent
 * @property string|null $payments
 * @property string|null $created_at
 */
class Loan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%loans}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sum', 'period', 'percent', 'date'], 'required'],
            [['date', 'created_at'], 'safe'],
            [['created_at'], 'default', 'value' => date('Y-m-d H:i:s')],
            [['sum', 'period'], 'integer'],
            [['percent'], 'number'],
            [['payments'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Дата выдачи',
            'sum' => 'Сумма займа',
            'period' => 'Срок займа',
            'percent' => 'Ставка, годовая',
            'payments' => 'График платежей',
            'created_at' => 'Дата создания',
        ];
    }
}

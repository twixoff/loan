<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%loans}}`.
 */
class m200615_192225_createLoansTable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%loans}}', [
            'id' => $this->primaryKey(),
            'date' => $this->dateTime(),
            'sum' => $this->integer(),
            'period' => $this->integer(),
            'percent' => $this->double(),
            'payments' => $this->text(),
            'created_at' => $this->timestamp()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%loans}}');
    }
}

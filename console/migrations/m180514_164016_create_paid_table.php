<?php

use yii\db\Migration;

/**
 * Handles the creation of table `paid`.
 */
class m180514_164016_create_paid_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('paid', [
            'id' => $this->primaryKey(),
			'paid' => $this->string()->null()->defaultValue(null),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('paid');
    }
}

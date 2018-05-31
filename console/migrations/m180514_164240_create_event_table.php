<?php

use yii\db\Migration;

/**
 * Handles the creation of table `event`.
 */
class m180514_164240_create_event_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('event', [
            'id' => $this->primaryKey(),
			'name' => $this->string()->null()->defaultValue(null),
			'description' => $this->text()->null()->defaultValue(null),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('event');
    }
}

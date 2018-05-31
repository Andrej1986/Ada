<?php

use yii\db\Migration;

/**
 * Handles the creation of table `calendar`.
 */
class m180514_164624_create_calendar_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('calendar', [
            'id' => $this->primaryKey(),
			'event_title' => $this->string(150)->null()->defaultValue(null),
			'event_date' => $this->date()->null()->defaultValue(null),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('calendar');
    }
}

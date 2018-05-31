<?php

use yii\db\Migration;

/**
 * Handles adding CategoryPaidDayAtLocation to table `event`.
 */
class m180517_162550_add_CategoryPaidDayAtLocation_column_to_event_table extends Migration
{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp()
	{
		$this->addColumn('event', 'category', $this->string()->null()->defaultValue(null));
		$this->addColumn('event', 'paid', $this->string()->null()->defaultValue(null));
		$this->addColumn('event', 'day', $this->date()->null()->defaultValue(null));
		$this->addColumn('event', 'at', $this->string()->null()->defaultValue(null));
		$this->addColumn('event', 'location', $this->string()->null()->defaultValue(null));
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown()
	{
		$this->dropColumn('event', 'category');
		$this->dropColumn('event', 'paid');
		$this->dropColumn('event', 'day');
		$this->dropColumn('event', 'at');
		$this->dropColumn('event', 'location');
	}
}

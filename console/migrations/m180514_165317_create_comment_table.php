<?php

use yii\db\Migration;

/**
 * Handles the creation of table `comment`.
 */
class m180514_165317_create_comment_table extends Migration
{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp()
	{
		$this->createTable('comment', [
			'id'       => $this->primaryKey(),
			'event_id' => $this->integer()->notNull(),
			'text'     => $this->text()->null()->defaultValue(null),
			'time'     => $this->timestamp(),
		]);

		$this->createIndex(
			'idx-comment-event_id',
			'comment',
			'event_id'
		);

		$this->addForeignKey(
			'fk-comment-event_id',
			'comment',
			'event_id',
			'event',
			'id',
			'CASCADE'
		);
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown()
	{
		$this->dropTable('comment');
	}
}

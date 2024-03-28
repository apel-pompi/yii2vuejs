<?php

use yii\db\Migration;

/**
 * Class m240328_055953_create_notes_tabel
 */
class m240328_055953_create_notes_tabel extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%notes}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(1024),
            'body' => $this->text(),
            'created_at' => $this->integer(11),
            'created_by' => $this->integer(11),
            'updated_at' => $this->integer(11),
        ]);

        // creates index for column `created_by`
        $this->createIndex(
            '{{%idx-notes-created_by}}',
            '{{%notes}}',
            'created_by'
        );

        // add foreign key for table `{{%users}}`
        $this->addForeignKey(
            '{{%fk-notes-created_by}}',
            '{{%notes}}',
            'created_by',
            '{{%users}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%users}}`
        $this->dropForeignKey(
            '{{%fk-notes-created_by}}',
            '{{%notes}}'
        );

        // drops index for column `created_by`
        $this->dropIndex(
            '{{%idx-notes-created_by}}',
            '{{%notes}}'
        );

        $this->dropTable('{{%notes}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240328_055953_create_notes_tabel cannot be reverted.\n";

        return false;
    }
    */
}

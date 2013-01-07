<?php

class m120129_122146_add_column_to_address extends CDbMigration
{
	
	public function safeUp()
	{
            $this->addColumn("{{address}}", 'type', 'varchar(255) NOT NULL');
	}

	public function safeDown()
	{
            $this->dropColumn("{{address}}", 'type');
	}
	
}
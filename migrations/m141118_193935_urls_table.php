<?php

use yii\db\Schema;
use yii\db\Migration;

class m141118_193935_urls_table extends Migration
{
    public function safeUp()
    {
    	$tableName = "tinyUrl";
    	$this->createTable($tableName,[
    		"id"=>"pk",
    		"url"=>Schema::TYPE_TEXT." NOT NULL",
    		"tiny"=>Schema::TYPE_STRING." NOT NULL"
    		]);
    	$this->createIndex("uniqueURL",$tableName,"url",true);
    	$this->createIndex("uniqueTiny",$tableName,"tiny",true);
    }

    public function safeDown()
    {
        $this->dropTable("tinyUrl");
    }
}

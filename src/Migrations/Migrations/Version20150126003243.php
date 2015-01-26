<?php
            namespace Migrations\Migrations;
            use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
        
class Version20150126003243 extends AbstractMigration
{
    
    public function diz($nome){
        echo $nome."\n";
    }
    public function up(Schema $schema)
    {

        $myTable = $schema->createTable('foo');
        $myTable->addColumn('id', 'integer', ['autoincrement'=>true]);
        $myTable->addColumn('bar', 'string', ['length' => 100]);
        $myTable->addColumn(
            'updated',
            'datetime',
            ['columnDefinition' => 'timestamp default current_timestamp on update current_timestamp']
        );
        
        $myTable->setPrimaryKey(['id']);
    }
        
    public function down(Schema $schema)
    {
        
    }
}
    
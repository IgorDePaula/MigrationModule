<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Migrations for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Migrations\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Doctrine\DBAL\Migrations\MigrationsVersion;
use Doctrine\DBAL\Migrations\Tools\Console\Command as MigrationsCommand;
use Doctrine\DBAL\Migrations\Version;
use Doctrine\DBAL\Migrations\Configuration\Configuration;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\ORM\Tools\SchemaTool;
use Doctrine\DBAL\Migrations\MigrationsVersion;
use Doctrine\DBAL\Migrations\Tools\Console\Command as MigrationsCommand;
class IndexController extends AbstractActionController
{

    private $em;

    public function indexAction()
    {
        $version = date('YmdHis');
        $file = '<?php
                 namespace Migrations\Migrations;
                 use Doctrine\DBAL\Migrations\AbstractMigration;
                 use Doctrine\DBAL\Schema\Schema;
        
                 class Version%d extends AbstractMigration
                 {
                   public function up(Schema $schema)
                   {
         
                   }
        
                  public function down(Schema $schema)
                  {
        
                  }
                }';
        $dir = realpath(__DIR__ . '/../') . '/Migrations/';
        if (! is_dir($dir)) {
            
            mkdir($dir);
        }
        file_put_contents($dir . "Version{$version}.php", sprintf($file, $version));
        // echo $dir;
        
        echo ("Version {$version} created!\n");
        return array();
    }

    public function getEntityManager()
    {
        if (! $this->em) {
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->em;
    }

    public function upAction()
    {
        $request = $this->getRequest();
        $version = $request->getParam('VERSION');
        $c = new Configuration($this->getServiceLocator()->get('doctrine.connection.orm_default'));
        $migr = "Migrations\Migrations\Version{$version}";
       
        $v = new Version($c,'1.0.0',$migr);
        $class = new $migr($v);
     
        
        $class->up(new Schema());
        $class->diz("Gostoso");
       
        return array();
    }
}

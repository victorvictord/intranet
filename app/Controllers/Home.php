<?php namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		generate_classes();
		//return view('welcome_message');
	}

	//--------------------------------------------------------------------
	/**
   * generate entity objects automatically from mysql db tables
   * @return none
   */
  function generate_classes(){     
       
    $this->em->getConfiguration()
             ->setMetadataDriverImpl(
                new DatabaseDriver(
                        $this->em->getConnection()->getSchemaManager()
                )
    );
 
    $cmf = new DisconnectedClassMetadataFactory();
    $cmf->setEntityManager($this->em);
    $metadata = $cmf->getAllMetadata();     
    $generator = new EntityGenerator();
     
    $generator->setUpdateEntityIfExists(true);
    $generator->setGenerateStubMethods(true);
    $generator->setGenerateAnnotations(true);
    $generator->generate($metadata, APPPATH."models/Entities");
     
  }

}

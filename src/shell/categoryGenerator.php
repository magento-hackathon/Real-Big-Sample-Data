<?php

require_once( dirname( $_SERVER['argv'][0] ) . '/abstract.php' );


class Mage_Shell_Category_Generator extends Mage_Shell_Abstract
{
	public $dryrun;
	public $template;
	public $rootCategories;
	public $categoryRecursion;

	public function setDefaults(){

		
		
		//Setting the defaults - Perhaps out of scope, should be in model?
		$this->dryrun = false;
		$this->template = "category-base.xml";
		$this->rootCategories = 1;
		$this->categoryRecursion = 1;
	}
    /**
     * Run script
     *
     */
    public function run()
    {
    	//Composer Autoload
    	require_once(Mage::getBaseDir('base') . '/vendor/autoload.php' );    	
    	
    	//Set Defaults
    	$this->setDefaults();
    	
    	$executedRun = false;   //Check against, instead of using if/else on args
    	
        $args = $this->_parseArgs(); // args can be non-linear
        
        $_categoryGenerator = Mage::getSingleton('generator/categories');
        
        if ($this->dryrun) {
        	echo "Dry run initiated.\n";
        	$_categoryGenerator->setDryRun(true);
        }

       //Check Template
        //$_categoryGenerator->setTemplate($this->template);
        
        // Settings
        //$_categoryGenerator->setRootCategories($this->rootCategories);
        //$_categoryGenerator->setCategoryRecursion($this->categoryRecursion);
        
        //Run generator
        //$executedRun =  $_categoryGenerator->generate();
        
        
        $executedRun = true;  // Set to true, now help wont trigger.
        
        // Fallback to some helpful help message
        if(!$executedRun)
        {
            echo $this->usageHelp();
            print_r($args);
        }
    }

    /**
     * Parse through the args, build an array and parse in any details.
     *
     * @return array
     */
    protected function _parseArgs() {
    	$args = array_slice(
    			array_filter( $_SERVER['argv'],
    					create_function( '$e',
    							'return $e != \'--\';' ) ),
    			1 );
    	
    	// Bring settings in - There has to be a cleaner way of doing this!
    	foreach($args as $_arg){
    		//strip the leading --
    		if(substr($_arg,0,2) == "--") $_arg = substr($_arg,2);
    		
    		// $_arg[0] is the "command"
    		// $_arg[1] is the "value"
    		$_arg = explode("=",$_arg);
    		
    		if($_arg[0] == "-n"){
    			$this->dryrun = true;
    		}
    		
    		//bring in settings against existing class properties if they exist
    		if(key_exists($_arg[0],$this)){
    			$this->$_arg[0] = $_arg[1];
    		}
  			
    	}

    	
    	return $args;
    }    
    
    /**
     * Retrieve Usage Help Message
     *
     */
    public function usageHelp()
    {
        return <<<USAGE
Usage:  php -f categoryGenerator.php -- [options]

  -n                Make this not really happen
  help                    This help

USAGE;
    }
}

$shell = new Mage_Shell_Category_Generator();
$shell->run();


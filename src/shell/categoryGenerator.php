<?php

require_once( dirname( $_SERVER['argv'][0] ) . '/abstract.php' );

class Mage_Shell_Category_Generator extends Mage_Shell_Abstract
{
	public $dryrun;
	public $template;
	public $rootCategories;
	public $categoryRecursion;

	public function __construct(){
		//Setting the defaults
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
    	$executedRun = false;   //Check against, instead of using if/else on args
    	
        $args = $this->_parseArgs(); // args can be non-linear
        
        
        if ($this->dryrun) {
        	$executedRun = true;  // Set to true, now help wont trigger.
        	echo "Dry run initiated.\n";
        	print_r($this);
        	
        	exit;
        }
        
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


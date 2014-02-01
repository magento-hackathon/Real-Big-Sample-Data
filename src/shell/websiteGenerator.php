<?php

require_once( dirname( $_SERVER['argv'][0] ) . '/abstract.php' );

class Mage_Shell_Website_Generator extends Mage_Shell_Abstract
{

    /**
     * Run script
     *
     */
    public function run()
    {
    	$args = $this->_parseArgs();
        if ($args[0] == "stub") {
        	print_r($args);
        } else {
            echo $this->usageHelp();

        }
    }

    /**
     * Get the real cleaned argv
     *
     * @return array
     */
    protected function _parseArgs() {
    	$args = array_slice(
    			array_filter( $_SERVER['argv'],
    					create_function( '$e',
    							'return $e != \'--\';' ) ),
    			1 );
    	return $args;
    }    
    
    
    /**
     * Retrieve Usage Help Message
     *
     */
    public function usageHelp()
    {
        return <<<USAGE
Usage:  php -f websiteGenerator.php -- [options]

  stub                    Example
  help                          This help
USAGE;
    }
}

$shell = new Mage_Shell_Website_Generator();
$shell->run();


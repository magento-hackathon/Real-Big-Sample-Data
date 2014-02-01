<?php

require_once 'abstract.php';

class Mage_Shell_Products_Generator extends Mage_Shell_Abstract
{

    /**
     * Run script
     *
     */
    public function run()
    {
        if ($this->getArg('stub')) {

        } else {
            echo $this->usageHelp();
        }
    }

    /**
     * Retrieve Usage Help Message
     *
     */
    public function usageHelp()
    {
        return <<<USAGE
Usage:  php -f productsGenerator.php -- [options]

  stub                    Example
  help                          This help
USAGE;
    }
}

$shell = new Mage_Shell_Products_Generator();
$shell->run();


<?php 
class Magehack_Bigdata_Model_Categories extends Mage_ImportExport_Model_Import
{
	public $dryrun;
	
    protected function _construct()
    {
    	$this->dryrun = false;
    }
    
    public function setDryRun(){
    	$this->dryrun = true;
    }
    

}
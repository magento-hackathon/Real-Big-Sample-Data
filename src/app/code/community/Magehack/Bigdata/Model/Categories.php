<?php 
class Magehack_Bigdata_Model_Categories extends Mage_ImportExport_Model_Import
{
	public $dryrun;
	public $rootCategories; 
	public $categoryRecursion;
	public $generatorTemplate;
	public $error;
	
    protected function _construct()
    {
    	$this->dryrun = false;
    	$this->error = array();
    }
    
    public function setDryRun(){
    	$this->dryrun = true;
    }
    
    public function setRootCategories($rootCategories){
    	if(!is_int($rootCategories)) $rootCategories = 1;
    	$this->rootCategories = $rootCategories;
    }
    
    public function setCategoryRecursion($categoryRecursion){
    	if(!is_int($categoryRecursion)) $categoryRecursion = 1;
    	$this->categoryRecursion = $categoryRecursion;
    }
    
    public function setTemplate($template){
    	$baseFile = Mage::getBaseDir('var')."/import/bigdata/category-base.xml";
    	$file = Mage::getBaseDir('var')."/import/bigdata/".$template;
    	if(file_exists($file)){
    		$this->generatorTemplate = simplexml_load_file($file);
    		print_r($this->generatorTemplate);
    	}else{
    		$this->error[] = "Cannot Load XML Template";
    	}
    }
    
    public function generate(){
    	//Time to make some categories
    	
    }

}
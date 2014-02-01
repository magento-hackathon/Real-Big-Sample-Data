<?php 
class Magehack_Bigdata_Model_Categories extends Mage_ImportExport_Model_Import
{
	public $dryrun;
	public $rootCategories; 
	public $categoryRecursion;
	public $generatorTemplate;
	public $generatorTemplateType;
	
	private $lastParent;
	private $categoryPath;
	
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
    		$this->generatorTemplate = json_decode(json_encode(simplexml_load_file($file)), TRUE);
    		$this->generateTemplateType = $this->generatorTemplate['root']['@attributes']['type'];
    	}else{
    		$this->error[] = "Cannot Load XML Template";
    	}
    }
    
    public function generate(){
    	//Time to make some categories
    	
    	// Two Root Types: flat or dynamic
    	if($this->generateTemplateType == "flat"){
    		echo "Generating from Flat Template \n";
    		$this->_flatGenerate();
    	}elseif($this->generateTemplateType == "dynamic"){
    		echo "Generating from Dynamic Template \n";
    		echo "-- not implemented\n";
    		//$this->_dynamicGenerate();
    	}
    	
    }

    private function _flatGenerate(){
    	$baseCategory = $this->generatorTemplate['root'];
    	$c = 0;
    	//Loop Through categories, adding w/ children
    	while($c < $this->rootCategories){
    		$this->lastParent = 0;  // Used in _createCategory		
    		$this->categoryPath = '1';  // Used in _createCategory		
    		$this->_createCategory($baseCategory);
    		$c++;
    	}

    }

    private function _createCategory($category){
    	$_category = Mage::getModel('catalog/category');
    	$_category->setStoreId(Mage::app()->getStore()->getId());

    	//Name
    	if(!isset($category['@attributes']['name']) || substr($category['@attributes']['name'],0,5) == "fake:"){
    		$_category->setName("random");
    	}else{
    		$_category->setName($category['@attributes']['name']);
    	}
    	  	
    	//is_active
    	if(!isset($category['@attributes']['is_active']) ||substr($category['@attributes']['is_active'],0,5) == "fake:"){
    		$_category->setIsActive(1);
    	}else{
    		$_category->setIsActive(1);
    	}
    	   	
    	//is_anchor
    	if(!isset($category['@attributes']['is_anchor']) ||substr($category['@attributes']['is_anchor'],0,5) == "fake:"){
    		$_category->setIsAnchor(1);
    	}else{
    		$_category->setIsAnchor(0);
    	}
    	    	
    	//Description
        if(!isset($category['@attributes']['description']) ||substr($category['@attributes']['description'],0,5) == "fake:"){
    		$_category->setDescription("random");
    	}else{
    		$_category->setDescription($category['@attributes']['description']);
    	}

    	// URL Key  - set to name for now
    	$_category->setUrlKey($cat['name']); //url to access this category
    	
    	//$category->setPath($parentCategory->getPath())
    	$_category->setPath('1');
   	
    	
    	$_category->save();

    	    	
    }

    
}
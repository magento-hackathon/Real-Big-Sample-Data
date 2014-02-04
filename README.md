Hackathon Big Sample Data (EXPERIMENTAL)
===================

Introduction
------------
This module has been conceived during the **Magento Hackathon 2014** (31st Jan - 1st Feb). Read more on the Hackathon site: http://www.mage-hackathon.de/upcoming/online-hackathon-worldwide-31st-jan-1st-feb.html

The goal of this is to create a series of functions to generate sample data for testing. Really big datasets can be generated using templates and some randomizing and iteration. These can be created and then exported and used for the testing.

The module will likely have some dependant extensions. Additionally we are looking to integrate with n98-magerun, so the development scripts are just an aid to that end.

**Planned Datasets**
* many many categories whith more then 5 levels of depth. lets say 1k+ categories
* configurable products with several options ( in the end 1 configurable = 10k+ simples {20�10�4�6�3}
* multiple websites/stores/storeviews ( should end in 1k storeviews )


**Categories:**
Categories generator will generate a structure based on the random data or a template category tree of "normal store categories". Some iteration will be needed to create "root categories" in addition to a template, or tree with some variance. Categories should be the first part to be done, as the website generator will need root categories. 

**Websites/Stores/Store Views:**
Websites, Stores, Store Views will generate the data that is needed to create the stores and will accept a few variables that control the number of stores, and the number of store views. Other settings that need to be considered are the root category, and any system configuration settings.
Additionally it would be nice to set currency and language on some sets of the store views, as well as add some variance to the settings that are saved in system configuration.

**Products:**
Products should use: https://github.com/avstudnitz/AvS_FastSimpleImport
Some modification will need to be made to create a pool of random names and data. It would be nice to have images, but it may not be needed.
FastSimpleImport can easily accomodate the various product types that are needed.


Generator Templates
------------
XML templates with attributes will allow settings for the generators.

**Categories Template:**
```
<?xml version="1.0"?>
<categories>
	<root>
		<category name="Furniture" is_active="true" description="loremText" meta_title="randomText:32" meta_description="loremText">
			<category name="Living Room" is_active="true" description="loremText" meta_title="randomText:32" meta_description="loremText"></category>
			<category name="Bedroom" is_active="true" description="loremText" meta_title="randomText:32" meta_description="loremText"></category>
		</category>
		[snip]
		<category name="Ebooks" is_active="true" description="loremText" meta_title="randomText:32" meta_description="loremText"></category>
	</root>
</categories>
```
This is the basic category structure from the Magento Sample Dataset. The idea is to match the attributes against the category attribute. In some cases I have added things like loremText or randomText. These will be caught by the generator and set up the way the category will be created.



Installation
------------
To install this module you need modman Module Manager: https://github.com/colinmollenhour/modman

After having installed modman on your system, you can clone this module on your Magento root folder by typing the following commands:

```
$ modman init
$ modman clone giturl here please
```

Configuration
-------------
No configuration in magento backend. Template files(XML) for datasets will be used for settings on the various datasets.


Dependancy List
------------
Faker is a PHP library that generates fake data for you: https://github.com/fzaninotto/Faker  (Thanks flyingmana for pointing it out)


Usage
-----
Coming Soon.

COMPATIBILITY
-------------
Here follows the list of versions the module has been tested on:

* Magento CS v 1.8.0.0

Note: if a version different from the ones listed above doesn't compare, it doesn't necessarily mean that the module won't work on that. If you try the module on different version and it works, please notify the author in order to update the compatibility list. It will be appreciated.

RELEASE NOTES
-------------
* 1.0.0 - the first implementation

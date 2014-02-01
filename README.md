ORIGINAL REQUEST:
Mainly for performance research I would like to have a real real big dataset which covers all imaginably performance edge cases.
some of them are:
* many many categories whith more then 5 levels of depth. lets say 1k+ categories
* configurable products with several options ( in the end 1 configurable = 10k+ simples {20×10×4×6×3}
* multiple websites/stores/storeviews ( should end in 1k storeviews )
Its ok(and suggested) if it ends in a script, which randomly creates this into files readable by an Importer, as this would speed up the generation and the importer can care in the end of optimize the saving to magento.

---------------------
During Development we are going to have three shell scripts, one for each of the items above. They will live in shell/ and if we keep them light we can integrate into n98-magerun easily, later after the hackathon.

Categories generator will generate a structure based on the random data or a template category tree of "normal store categories". Some iteration will be needed to create "root categories" in addition to a template, or tree with some variance. Categories should be the first part to be done, as the website generator will need root categories. 

Websites, Stores, Store Views will generate the data that is needed to create the stores and will accept a few variables that control the number of stores, and the number of store views. Other settings that need to be considered are the root category, and any system configuration settings.
Additionally it would be nice to set currency and language on some sets of the store views, as well as add some variance to the settings that are saved in system configuration. 

Products should use: https://github.com/avstudnitz/AvS_FastSimpleImport
Some modification will need to be made to create a pool of random names and data. It would be nice to have images, but it may not be needed.
FastSimpleImport can easily accomodate the various product types that are needed.

As for variance and randomization, we should look to find something VERY light that can be used for all of the functions

---------------------
OTHER STUFF:
Orders,quotes,sales rules, and so on were all suggested. Due to the scope of the hackathon these will have to be added later.

It would be great to see this work as part of n98-magerun. Fabrizo helped find us a few leads on how to create the extension for n98.
http://alanstorm.com/developing_commands_for_n98-magerun

https://github.com/netz98/n98-magerun/blob/master/src/N98/Magento/Command/Customer/CreateDummyCommand.php

http://blog.muench-worms.de/n98-magerun-modulsystem/



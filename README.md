# Techshop Custom Product Review Module

 - [Features](#features)
 - [Installation](#installation)
 - [Configuration](#configuration)
 - [Screenshots](#screenshots)


## Features
 - Enable/Disable custom form Customer Product Review feature

## Installation
### Zip file
 - Unzip the zip file in `app/code` ;
 - The folder structure after unzip should look like: `app/code/Techshop/ProductReview`
 - Run `php bin/magento module:enable Techshop_ProductReview` to enable module;
 - Run `php bin/magento setup:upgrade` ;
 - Flush cache with running `php bin/magento cache:flush` ;

## Configuration
### Store Configuration
 - Go to the configuration path: `Stores -> Settings -> Configuration -> Techshop -> Customer Product Review`;
 - Enable the feature;
 - Clear the cache to reflect the changes: `System -> Tools -> Cache Management -> Flush Magento Cache`;

 ## Screenshots
 ### Tab menu
 ![plot](./assets/feature_1.png)

### Configuration
 ![plot](./assets/feature_2.png)
 

 ### All Reviews
 ![plot](./assets/feature_3.png)
 
 ### Frontend Form
 ![plot](./assets/feature_4.png)
 
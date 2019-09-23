# Customer Testimonials
A magento 2 customer testimonials module.
### Requirements
* PHP >= 7.1.0
* Magento 2.3
### Installation
* Copy the folder to `app/code` directory in your Magento 2 project. If the directory doesn't exist, create it.
* Run the following commands in your terminal after you `cd` to your Magento installation:
    * `$ php bin/magento setup:upgrade`
    * `$ php bin/magento setup:di:compile`.
    * `$ php bin/magento cache:clean`.
* After the installation, login to the admin panel and add some testimonials. You'll find a link above Settings, click it, then you'll be able to add, edit, toggle status, and delete testimonials.
* To preview the changes in the frontstore, navigate to `{storefront_url}/customer-testimonials`.

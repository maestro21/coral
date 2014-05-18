Coral Club Hamburg
=====

Coral Club Hamburg - http://coral-gold-hamburg.de/ - website created on Maestro Lite (v3) engine. This website is simple information website that has lots of information about Coral Club - health, products, etc and simple online store. It has several modules - Pages, News, Products, Programs, Orders. It has also Order form (http://www.coral-gold-hamburg.de/register/ ) allowing user to register in Coral Club and order some products.
This repository has all necessary files to launch website and database schema.
Website content and products, pages and images are not included in this repository for obvious reason, but you can create it by yourself.

Installation
------
1. Download this repository
2. Create database and execute db/schema.sql
3. Set up your website and database settings in settings.php in root directory
4. Log in through 'adm' url (i.e. http://localhost/coral/adm). Password is 'admin'
5. Work

Maestro Lite Engine
------
Maestro Lite (v3) was created for simple websites that don't require complex logic. Most of websites on Internet have only pages and sometimes news. They don't even have user login\registration. To create such website you don't need complex logic with OOP modules, etc. Maestro Lite was created for the purposes of making such simple pages and was already used in some.
Following basic principle 'less code - more result', Maestro Lite is ultralight and easy-to-use engine with total weight ca 200 kb. It has the simplest logic possible, yet allowing to create more complex websites than just 'few static pages plus news'. 

Architecture
-----
Architecture is quiet simple and primitive:
* index.php is Front Controller calling modules(model) and passing data to templates(view)  
* modules(model) are in folder 'modules'. Unlike Maestro v1 and Maestro v2, there is no masterclass and modules are not object. Instead, they follow Drupal-style logic and are just fuctions. If you make call 'http://yoursite.com/module/action/params' then function 'module_action' would be called from 'modules/module.php' with your params.
* tpl - place where templates(views) are stored. 

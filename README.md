LiHoCoS
=======

**Li**fe and **Ho**me **Co**ntrolling **S**ystem - a universal web application (PHP + MySQL) for controlling your smart home and managing your household

> Visit [http://lihocos.de](http://lihocos.de) for more information

> Try it: [http://demo.lihocos.de](http://demo.lihocos.de)

## Features
LiHoCoS is mainly split, as its name implies, into two parts
* Life
  * Here is all about managing and analyzing your lifes data
  * We use so many things today where data arises, but the bad thing is, nearly everything comes with its own ecosystem.
LiHoCoS is here to keep this data in a single place and make it analyzable in context of other things and **in a private environment**.
* Home
  * This is all about smart home
  * Control your devices, regardless from which manufacturer, LiHoCoS can control everything - thanks to its "Everyhting is done by a plugin"-system
  * Another thing here is household management.

### Plugin based system
LiHoCoS is only the "shell", it just manages the objects and evaluates the data.
When it comes to connecting to other system to retrieve data or controlling physical things (smart home), everything is done by a plugin.
So LiHoCoS is the universal application for everyhting. :D

### Default plugins
LiHoCoS is currently shipped with the following plugins, which were mainly created because I use the appropriate  thing/system:
* Home/Blinds: [Rademacher HomePilot](http://homepilot.rademacher.de/)
* Home/Doors: [HomeMatic (BidCoS)](http://www.homematic.com/)
* Home/Lights: [TellStick](http://www.telldus.se/products/tellstick)
* Home/Sensors: [TellStick](http://www.telldus.se/products/tellstick)
* Home/Windows: [HomeMatic (BidCoS)](http://www.homematic.com/)

### Project status
LiHoCoS was just created, so there are not too many features so far.
The first development step was focused on the (plugin) framework and smart home features.
But now the features can and will come. :)

### License
The MIT License (MIT)

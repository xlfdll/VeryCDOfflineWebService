# VeryCD Offline Web Service
A simple web app similar to old VeryCD / SimpleCD site

<p align="center">
  <img src="https://github.com/xlfdll/xlfdll.github.io/raw/master/images/projects/VeryCDOfflineWebService/VeryCDOfflineWebService-Index.png"
       alt="VeryCD Offline Web Service - Index Page"
       width="256">
  <img src="https://github.com/xlfdll/xlfdll.github.io/raw/master/images/projects/VeryCDOfflineWebService/VeryCDOfflineWebService-Search.png"
       alt="VeryCD Offline Web Service - Search Page"
       width="256">
  <img src="https://github.com/xlfdll/xlfdll.github.io/raw/master/images/projects/VeryCDOfflineWebService/VeryCDOfflineWebService-Item.png"
       alt="VeryCD Offline Web Service - Item Page"
       width="256">
</p>

## System Requirements
* Server
  * Any web servers that support PHP 5.6+, with SQLite3 extension enabled

* Client
  * Any web browsers that supports HTML5

## Usage
Before use, a converted SQLite database, converted from SimpleCD Desktop app, must be placed in **/storage** directory.

  * It is possible to locate the database outside the default /storage directory by changing settings in **/include/helpers/config.php**
  * The database can be converted from SimpleCD Desktop format by using [SimpleCDDatabaseConverter](https://github.com/xlfdll/SimpleCDDatabaseConverter) utility
  * **The original and converted database files are not provided in this repository**

If everything is set up correctly, the pages similar to above screenshots should show up. Type a keyword to start a search.

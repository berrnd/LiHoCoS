Do every step from your current version to (including) the one you want to upgrade to

### Version ???
* Manually replace the "function __autoload($class)" at the end of your application/config.php file with "include __DIR__ . '/global-include.php';" (or merge your config file with application/config-dist.php)
* Execute this SQL statement
    CREATE TABLE blind_positions (id int(11) NOT NULL AUTO_INCREMENT, blind_id int(11) NOT NULL, name varchar(100) COLLATE latin1_german1_ci NOT NULL, position tinyint(4) DEFAULT '0', PRIMARY KEY (`id`)) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;
* Info: Removed http://lihocos.tld/plugin/pull_blind_states and http://lihocos.tld/plugin/pull_sensors, now just call http://lihocos.tld/cron

### Version 0.1.2
* Execute this SQL statement
    ALTER TABLE cameras CHANGE current_image_url snapshot_url VARCHAR(1000) CHARACTER SET latin1 COLLATE latin1_german1_ci NULL DEFAULT NULL;
Do every step from your current version to (including) the one you want to upgrade to

### Version ???
* Manually replace the "function __autoload($class)" at the end of your application/config.php file with "include __DIR__ . '/global-include.php';" (or merge your config file with application/config-dist.php)

### Version 0.1.2
* Execute this SQL statement
	ALTER TABLE cameras CHANGE current_image_url snapshot_url VARCHAR(1000) CHARACTER SET latin1 COLLATE latin1_german1_ci NULL DEFAULT NULL;
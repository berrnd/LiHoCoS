Do every step from your current version to (including) the one you want to upgrade to

### Version 0.1.2
* Execute this SQL statement
	`ALTER TABLE cameras CHANGE current_image_url snapshot_url VARCHAR(1000) CHARACTER SET latin1 COLLATE latin1_german1_ci NULL DEFAULT NULL;`
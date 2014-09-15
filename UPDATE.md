Do every step from your current version to (including) the one you want to upgrade to

### Version NEXT
* Execute these SQL statements
```
CREATE TABLE location_history (id int(11) NOT NULL AUTO_INCREMENT, timestamp DATETIME NOT NULL, latitude DECIMAL(10, 8) NOT NULL, longitude DECIMAL(11, 8) NOT NULL, accuracy DECIMAL(18, 3) NULL, PRIMARY KEY (id), UNIQUE KEY IX_location_history (timestamp, latitude, longitude)) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;
UPDATE settings SET name = 'home_latitude' WHERE name = 'latitude';
UPDATE settings SET name = 'home_longitude' WHERE name = 'longitude';
ALTER TABLE macros DROP INDEX name, ADD UNIQUE IX_macros (name);
ALTER TABLE macro_actions ADD INDEX IX_macro_actions (macro_id);
ALTER TABLE sensors ADD location_type VARCHAR(10) DEFAULT 'INSIDE' AFTER type;
CREATE TABLE calendar_internal (date DATE COLLATE latin1_german1_ci NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;
ALTER TABLE calendar_internal ADD INDEX IX_calendar_internal (date);
CREATE VIEW calendar AS SELECT date, YEAR(date) AS year, MONTH(date) AS month, DAY(date) AS day FROM calendar_internal;
DELIMITER ;;
CREATE PROCEDURE populate_calendar(dateStart DATE, dateEnd DATE)
BEGIN
    WHILE dateStart <= dateEnd DO
        INSERT INTO calendar_internal (date) VALUES (dateStart);
        SET dateStart = DATE_ADD(dateStart, INTERVAL 1 DAY);
    END WHILE;
END;;
DELIMITER ;
CALL populate_calendar('2000-01-01', '2099-12-31');
CREATE VIEW location_history_existing_days AS SELECT DATE(timestamp) AS date_timestamp, MAX(ID) AS id FROM location_history GROUP BY DATE(timestamp);
CREATE VIEW location_history_missing_days AS SELECT c.date FROM calendar c LEFT JOIN location_history_existing_days lh ON c.date = lh.date_timestamp WHERE lh.id IS NULL AND c.date < CURRENT_DATE() AND c.date > DATE_ADD(CURRENT_DATE(), INTERVAL -6 MONTH);
```

### Version 0.1.5
* Execute these SQL statements
```
CREATE TABLE macros (id int(11) NOT NULL AUTO_INCREMENT, name varchar(100) COLLATE latin1_german1_ci NOT NULL, description varchar(500) COLLATE latin1_german1_ci NOT NULL, PRIMARY KEY (id), UNIQUE KEY name (name)) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;
CREATE TABLE macro_actions (id int(11) NOT NULL AUTO_INCREMENT, macro_id int(11) NOT NULL, name varchar(100) COLLATE latin1_german1_ci NOT NULL, description varchar(500) COLLATE latin1_german1_ci DEFAULT NULL, type varchar(20) COLLATE latin1_german1_ci NOT NULL, parameters varchar(1000) COLLATE latin1_german1_ci DEFAULT NULL, PRIMARY KEY (id)) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;
ALTER TABLE users ADD api_key VARCHAR(1000) NULL, ADD UNIQUE (api_key);
ALTER TABLE users ADD UNIQUE INDEX username (username);
```
* Info: Plugin boot functions can now be executed with this url: ```http://lihocos.tld/api/common/boot?api-key=API_KEY_OF_A_USER```

### Version 0.1.4
* Manually replace the ```function __autoload($class)``` at the end of your application/config.php file with ```include __DIR__ . '/global-include.php';``` (or merge your config file with application/config-dist.php)
* Execute this SQL statement
```
CREATE TABLE blind_positions (id int(11) NOT NULL AUTO_INCREMENT, blind_id int(11) NOT NULL, name varchar(100) COLLATE latin1_german1_ci NOT NULL, position tinyint(4) DEFAULT '0', PRIMARY KEY (id)) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;
```
* Info: Removed ```http://lihocos.tld/plugin/pull_blind_states``` and ```http://lihocos.tld/plugin/pull_sensors```, now just call ```http://lihocos.tld/cron```

### Version 0.1.2
* Execute this SQL statement
```
ALTER TABLE cameras CHANGE current_image_url snapshot_url VARCHAR(1000) CHARACTER SET latin1 COLLATE latin1_german1_ci NULL DEFAULT NULL;
```

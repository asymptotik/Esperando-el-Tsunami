<?php
	$sql = array();
	$sql[] = "CREATE TABLE IF NOT EXISTS wp_screenings_events (
	  `id` INT NOT NULL AUTO_INCREMENT ,
	  `active` VARCHAR(45) NULL ,
	  `status` INT NULL ,
	  `film` VARCHAR(128) NOT NULL ,
	  `place` VARCHAR(128) NOT NULL ,
	  `address` VARCHAR(255) NULL ,
	  `show_address` VARCHAR(45) NULL ,
	  `city` VARCHAR(128) NULL ,
	  `zipcode` VARCHAR(18) NULL ,
	  `country` VARCHAR(45) NULL ,
	  `dateandtime` DATETIME NULL ,
	  `max` INT NULL ,
	  `additional` TEXT NULL ,
	  `name` VARCHAR(128) NULL ,
	  `email` VARCHAR(255) NULL ,
	  `phone` VARCHAR(28) NULL ,
	  `password` VARCHAR(255) NULL ,
	  `imageurl` VARCHAR(192) NULL ,
	  PRIMARY KEY (`id`) ,
	  UNIQUE INDEX `id_UNIQUE` (`id` ASC));";
	
	$sql[] = "CREATE TABLE IF NOT EXISTS wp_screenings_attending (
	  `id` INT NOT NULL AUTO_INCREMENT ,
	  `wp_screenings_events_id` INT NOT NULL ,
	  `email` VARCHAR(255) NULL ,
	  `name` VARCHAR(255) NULL ,
	  `message` TEXT NULL ,
	  `attendants` INT NULL ,
	  PRIMARY KEY (`id`, `wp_screenings_events_id`) ,
	  INDEX `fk_wp_screenings_attending_wp_screenings_events` (`wp_screenings_events_id` ASC) ,
	  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
	  CONSTRAINT `fk_wp_screenings_attending_wp_screenings_events`
	    FOREIGN KEY (`wp_screenings_events_id` )
	    REFERENCES `wp_screenings_events` (`id` )
	    ON DELETE NO ACTION
	    ON UPDATE NO ACTION);";
	
	$sql[] = "SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;";

require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

foreach ($sql as $query)
{
	dbDelta($query);
}
?>
<?php

function lc_install_concert_database()
{
		global $wpdb;
	
		$sql = array();
	
		$concerts_events_table_name = $wpdb->prefix . "concerts_events";
		$concerts_attending_table_name = $wpdb->prefix . "concerts_attending";
		$concerts_regions_table_name = $wpdb->prefix . "concerts_regions";
	  $concerts_countries_table_name = $wpdb->prefix . "concerts_countries";
		$concerts_region_schedule_table_name = $wpdb->prefix . "concerts_region_schedule";
		
		// active 1 = active 0 = inactive
		// status 1 = booked 0 = open
		// deleted 1 = removed

		$sql[] = "CREATE TABLE IF NOT EXISTS " . $concerts_regions_table_name . " (
	  `id` INT NOT NULL,
	  `name` VARCHAR(45) NULL ,
	  PRIMARY KEY (`id`));";
		
		$sql [] = "INSERT INTO " . $concerts_regions_table_name . " (id, name) VALUES 
		(1, 'South America'),
	  (2, 'Central America and The Caribbean'),
		(3, 'North America'),
		(4, 'Europe'),
		(5, 'Asia'),
		(6, 'Africa'),
		(7, 'Middle East'),
		(8, 'Oceania')";
		
		$sql[] = "CREATE TABLE IF NOT EXISTS " . $concerts_countries_table_name . " (
	  `id` INT NOT NULL,
	  `region_id` INT NOT NULL,
	  `name` VARCHAR(45) NULL,
	  PRIMARY KEY (`id`));";
		
		$the_id = 1;
		$sql [] = "INSERT INTO " . $concerts_countries_table_name . " (id, region_id, name) VALUES
		(" . $the_id++ . ", 1, 'Argentina'),
		(" . $the_id++ . ", 1, 'Bolivia'),
		(" . $the_id++ . ", 1, 'Brazil'),
		(" . $the_id++ . ", 1, 'Chile'),
		(" . $the_id++ . ", 1, 'Colombia'),
		(" . $the_id++ . ", 1, 'Ecuador'),
		(" . $the_id++ . ", 1, 'French Guiana'),
		(" . $the_id++ . ", 1, 'Guyana'),
		(" . $the_id++ . ", 1, 'Paraguay'),
		(" . $the_id++ . ", 1, 'Peru'),
		(" . $the_id++ . ", 1, 'Suriname'),
		(" . $the_id++ . ", 1, 'Uruguay'),
		(" . $the_id++ . ", 1, 'Venezuela'),
		(" . $the_id++ . ", 2, 'Belize'),
		(" . $the_id++ . ", 2, 'Costa Rica'),
		(" . $the_id++ . ", 2, 'El Salvador'),
		(" . $the_id++ . ", 2, 'Guatemala'),
		(" . $the_id++ . ", 2, 'Honduras'),
		(" . $the_id++ . ", 2, 'Mexico'),
		(" . $the_id++ . ", 2, 'Nicaragua'),
		(" . $the_id++ . ", 2, 'Panama'),
		(" . $the_id++ . ", 2, 'Anguilla'),
		(" . $the_id++ . ", 2, 'Antigua and Barbuda'),
		(" . $the_id++ . ", 2, 'Aruba'),
		(" . $the_id++ . ", 2, 'Bahamas'),
		(" . $the_id++ . ", 2, 'Barbados'),
		(" . $the_id++ . ", 2, 'British Virgin Islands'),
		(" . $the_id++ . ", 2, 'Cayman Islands'),
		(" . $the_id++ . ", 2, 'Cuba'),
		(" . $the_id++ . ", 2, 'Dominica'),
		(" . $the_id++ . ", 2, 'Dominican Republic'),
		(" . $the_id++ . ", 2, 'Grenada'),
		(" . $the_id++ . ", 2, 'Guadeloupe'),
		(" . $the_id++ . ", 2, 'Haiti'),
		(" . $the_id++ . ", 2, 'Jamaica'),
		(" . $the_id++ . ", 2, 'Martinique'),
		(" . $the_id++ . ", 2, 'Monserrat'),
		(" . $the_id++ . ", 2, 'Netherlands Antilles'),
		(" . $the_id++ . ", 2, 'Puerto Rico'),
		(" . $the_id++ . ", 2, 'St. Kitts and Nevis'),
		(" . $the_id++ . ", 2, 'Saint Lucia'),
		(" . $the_id++ . ", 2, 'Saint Vincent and the Grenadines'),
		(" . $the_id++ . ", 2, 'Trinidad and Tobago'),
		(" . $the_id++ . ", 2, 'Turks and Caicos Islands'),
		(" . $the_id++ . ", 2, 'Virgin Islands (US)'),
		(" . $the_id++ . ", 3, 'Bermuda'),
		(" . $the_id++ . ", 3, 'Canada'),
		(" . $the_id++ . ", 3, 'Greenland'),
		(" . $the_id++ . ", 3, 'Saint Pierre and Miquelon'),
		(" . $the_id++ . ", 3, 'United States'),
		(" . $the_id++ . ", 4, 'Albania'),
		(" . $the_id++ . ", 4, 'Andorra'),
		(" . $the_id++ . ", 4, 'Austria'),
		(" . $the_id++ . ", 4, 'Belarus'),
		(" . $the_id++ . ", 4, 'Belgium'),
		(" . $the_id++ . ", 4, 'Bosnia'),
		(" . $the_id++ . ", 4, 'Bulgaria'),
		(" . $the_id++ . ", 4, 'Croatia'),
		(" . $the_id++ . ", 4, 'Cyprus'),
		(" . $the_id++ . ", 4, 'Czech Republic'),
		(" . $the_id++ . ", 4, 'Denmark'),
		(" . $the_id++ . ", 4, 'Estonia'),
		(" . $the_id++ . ", 4, 'Faroe Islands'),
		(" . $the_id++ . ", 4, 'Finland'),
		(" . $the_id++ . ", 4, 'France'),
		(" . $the_id++ . ", 4, 'Germany'),
		(" . $the_id++ . ", 4, 'Gibraltar'),
		(" . $the_id++ . ", 4, 'Greece'),
		(" . $the_id++ . ", 4, 'Guerney and Alderney'),
		(" . $the_id++ . ", 4, 'Hungary'),
		(" . $the_id++ . ", 4, 'Iceland'),
		(" . $the_id++ . ", 4, 'Ireland'),
		(" . $the_id++ . ", 4, 'Italy'),
		(" . $the_id++ . ", 4, 'Jersey'),
		(" . $the_id++ . ", 4, 'Kosovo'),
		(" . $the_id++ . ", 4, 'Latvia'),
		(" . $the_id++ . ", 4, 'Liechtenstein'),
		(" . $the_id++ . ", 4, 'Lithuania'),
		(" . $the_id++ . ", 4, 'Luxembourg'),
		(" . $the_id++ . ", 4, 'Macedonia'),
		(" . $the_id++ . ", 4, 'Malta'),
		(" . $the_id++ . ", 4, 'Man, Island of'),
		(" . $the_id++ . ", 4, 'Moldova'),
		(" . $the_id++ . ", 4, 'Monaco'),
		(" . $the_id++ . ", 4, 'Montenegro'),
		(" . $the_id++ . ", 4, 'Netherlands'),
		(" . $the_id++ . ", 4, 'Norway'),
		(" . $the_id++ . ", 4, 'Poland'),
		(" . $the_id++ . ", 4, 'Portugal'),
		(" . $the_id++ . ", 4, 'Romania'),
		(" . $the_id++ . ", 4, 'Russia'),
		(" . $the_id++ . ", 4, 'San Marino'),
		(" . $the_id++ . ", 4, 'Serbia'),
		(" . $the_id++ . ", 4, 'Slovakia'),
		(" . $the_id++ . ", 4, 'Slovenia'),
		(" . $the_id++ . ", 4, 'Spain'),
		(" . $the_id++ . ", 4, 'Svalbard and Jan Mayen Islands'),
		(" . $the_id++ . ", 4, 'Sweden'),
		(" . $the_id++ . ", 4, 'Switzerland'),
		(" . $the_id++ . ", 4, 'Turkey'),
		(" . $the_id++ . ", 4, 'Ukraine'),
		(" . $the_id++ . ", 4, 'United Kingdom'),
		(" . $the_id++ . ", 4, 'Vatican City State (Holy See)'),
		(" . $the_id++ . ", 5, 'Afganistan'),
		(" . $the_id++ . ", 5, 'Armenia'),
		(" . $the_id++ . ", 5, 'Azerbaijan'),
		(" . $the_id++ . ", 5, 'Bangladesh'),
		(" . $the_id++ . ", 5, 'Bhutan'),
		(" . $the_id++ . ", 5, 'Brunei Darussalam'),
		(" . $the_id++ . ", 5, 'Cambodia'),
		(" . $the_id++ . ", 5, 'China'),
		(" . $the_id++ . ", 5, 'Georgia'),
		(" . $the_id++ . ", 5, 'Hong Kong'),
		(" . $the_id++ . ", 5, 'India'),
		(" . $the_id++ . ", 5, 'Indonesia'),
		(" . $the_id++ . ", 5, 'Japan'),
		(" . $the_id++ . ", 5, 'Kazakhstan'),
		(" . $the_id++ . ", 5, 'Korea, North'),
		(" . $the_id++ . ", 5, 'Korea, South'),
		(" . $the_id++ . ", 5, 'Kyrgyzstan'),
		(" . $the_id++ . ", 5, 'Laos'),
		(" . $the_id++ . ", 5, 'Macao'),
		(" . $the_id++ . ", 5, 'Malaysia'),
		(" . $the_id++ . ", 5, 'Maldives'),
		(" . $the_id++ . ", 5, 'Mongolia'),
		(" . $the_id++ . ", 5, 'Myanmar (ex-Burma)'),
		(" . $the_id++ . ", 5, 'Nepal'),
		(" . $the_id++ . ", 5, 'Pakistan'),
		(" . $the_id++ . ", 5, 'Phillipines'),
		(" . $the_id++ . ", 5, 'Singapore'),
		(" . $the_id++ . ", 5, 'Sri Lanka (ex-Ceilan)'),
		(" . $the_id++ . ", 5, 'Taiwan'),
		(" . $the_id++ . ", 5, 'Tajikistan'),
		(" . $the_id++ . ", 5, 'Thailand'),
		(" . $the_id++ . ", 5, 'Timor Leste (West)'),
		(" . $the_id++ . ", 5, 'Turkmenistan'),
		(" . $the_id++ . ", 5, 'Uzbekistan'),
		(" . $the_id++ . ", 5, 'Vietnam')";
		
		$sql[] = "CREATE TABLE IF NOT EXISTS " . $concerts_region_schedule_table_name . " (
	  `id` INT NOT NULL AUTO_INCREMENT,
	  `region_id` INT NOT NULL,
	  `name` VARCHAR(45) NULL,
	  `desc` VARCHAR(255) NULL,
	  `startdate` DATE NOT NULL,
	  `enddate` DATE NOT NULL,
	  PRIMARY KEY (`id`),
	  INDEX `" . $wpdb->prefix . "fk_concerts_region_id` (`region_id` ASC),
	  CONSTRAINT `" . $wpdb->prefix . "fk_concerts_region_schedule_region_id`
	    FOREIGN KEY (`region_id`)
	    REFERENCES `" . $concerts_regions_table_name . "` (`id` )
	    ON DELETE NO ACTION
	    ON UPDATE NO ACTION);";
		
		$rows = $wpdb->get_var($wpdb->prepare('SELECT COUNT(*) FROM ' . $concerts_region_schedule_table_name));
		if($rows == 0)
		{
			$sql [] = "INSERT INTO " . $concerts_region_schedule_table_name . " (region_id, name, startdate, enddate) VALUES
			(1, 'South America', '2011-10-01', '2011-10-30'),
			(1, 'South America', '2011-11-01', '2011-11-30'),
			(2, 'Central America', '2012-03-01', '2012-03-15'),
			(3, 'North America', '2012-03-08', '2012-03-30'),
			(3, 'North America', '2012-04-01', '2012-04-30'),
			(3, 'North America', '2012-07-01', '2012-07-15'),
			(3, 'North America', '2012-08-15', '2012-08-30'),
			(3, 'North America', '2012-09-01', '2012-09-30'),
			(4, 'Europe', '2012-05-01', '2012-05-30'),
			(4, 'Europe', '2012-06-01', '2012-06-15'),
			(4, 'Europe', '2012-07-15', '2012-07-30'),
			(4, 'Europe', '2012-08-01', '2012-08-15'),
			(5, 'Asia', '2012-09-01', '2012-09-30'),
			(5, 'Asia', '2012-10-01', '2012-10-15');";
		}
		
		 $table = "CREATE TABLE IF NOT EXISTS " . $concerts_events_table_name . " (
	  `id` INT NOT NULL AUTO_INCREMENT,
	  `active` TINYINT NOT NULL DEFAULT 0,
	  `status` TINYINT NOT NULL DEFAULT 0,
	  `place` VARCHAR(128) NOT NULL,
	  `address` VARCHAR(255) NULL,
	  `show_address` TINYINT NULL,
	  `city` VARCHAR(128) NULL,
	  `postalcode` VARCHAR(18) NULL,
	  `region_id` INT NULL,
	  `country_id` INT NULL,
	  `country` VARCHAR(45) NULL,
	  `dateandtime` DATETIME NULL,
	  `max` INT NULL,
	  `additional` TEXT NULL,
	  `name` VARCHAR(128) NULL,
	  `email` VARCHAR(255) NULL,
	  `phone` VARCHAR(28) NULL,
	  `password` VARCHAR(255) NULL,
	  `imageurl` VARCHAR(192) NULL,
	  PRIMARY KEY (`id`),
	  CONSTRAINT `" . $wpdb->prefix . "fk_concerts_events_region_id`
	    FOREIGN KEY (`region_id` )
	    REFERENCES `" . $concerts_regions_table_name . "` (`id` )
	    ON DELETE NO ACTION
	    ON UPDATE NO ACTION);";
		
		 echo $table;
		 
		 $sql[] = $table;
		 
	  $sql[] = "CREATE TABLE IF NOT EXISTS " . $concerts_attending_table_name . " (
	  `id` INT NOT NULL AUTO_INCREMENT,
	  `events_id` INT NOT NULL,
	  `email` VARCHAR(255) NULL,
	  `name` VARCHAR(255) NULL,
	  `message` TEXT NULL,
	  `attendants` INT NULL,
	  PRIMARY KEY (`id`, `events_id`),
	  INDEX `" . $wpdb->prefix . "fk_concerts_attending_concerts_events` (`events_id` ASC),
	  CONSTRAINT `" . $wpdb->prefix . "fk_concerts_attending_events_id`
	    FOREIGN KEY (`events_id` )
	    REFERENCES `" . $concerts_events_table_name . "` (`id` )
	    ON DELETE NO ACTION
	    ON UPDATE NO ACTION);";
	  
		
		$sql[] = "SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;";

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	
	foreach ($sql as $query)
	{
		dbDelta($query);
	}
}
?>

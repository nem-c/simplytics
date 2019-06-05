Database migrations

```
CREATE TABLE `simplytics_visit` (
	`id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	`long_ip` INT(11) NULL DEFAULT NULL,
	`cookie` VARCHAR(32) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`domain` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`uri` VARCHAR(200) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`device` TINYINT(1) NULL DEFAULT NULL,
	`user_agent` VARCHAR(200) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`source` VARCHAR(4) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`created_at` DATETIME NULL DEFAULT NULL,
	PRIMARY KEY (`id`),
	INDEX `long_ip` (`long_ip`),
	INDEX `source` (`source`),
	INDEX `created_at` (`created_at`)
) COLLATE='utf8_unicode_ci' ENGINE=InnoDB;

```

```
CREATE TABLE `simplytics_visit_meta` (
	`event` TINYINT(1) NULL DEFAULT NULL,
	`visit_id` BIGINT(20) UNSIGNED NOT NULL DEFAULT '0',
	`meta_name` VARCHAR(20) NOT NULL DEFAULT '' COLLATE 'utf8_unicode_ci',
	`meta_value` VARCHAR(20) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	INDEX `meta_name` (`meta_name`, `meta_value`),
	INDEX `visit_id` (`visit_id`),
	CONSTRAINT `simplytics_visit_meta_ibfk_1` FOREIGN KEY (`visit_id`) REFERENCES `simplytics_visit` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
) COLLATE='utf8_unicode_ci' ENGINE=InnoDB;
```

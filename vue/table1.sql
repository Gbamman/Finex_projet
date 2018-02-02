 <?php
	ALTER TABLE 'contrat' ADD 'datevalidation' date DEFAULT NULL,'datereglement' date DEFAULT NULL,'numbordvalide' varchar(100) DEFAULT NULL,`numbordregle` varchar(100) DEFAULT NULL;
	ALTER TABLE 'synchronisationnum' ADD  'numproduction' int(11) NOT NULL DEFAULT '1','numreglement' int(11) NOT NULL DEFAULT '1';
ALTER TABLE users
ALTER TABLE 'calme' ADD COLUMN `count` SMALLINT(6) NOT NULL AFTER `lastname`,
ADD COLUMN `log` VARCHAR(12) NOT NULL AFTER `count`,
ADD COLUMN `status` INT(10) UNSIGNED NOT NULL AFTER `log`;
ALTER TABLE `calme` ADD COLUMN `counts` SMALLINT(6) NOT NULL AFTER `lastname`, ADD COLUMN `logs` VARCHAR(12) NOT NULL AFTER `count`, ADD COLUMN `status` INT(10) UNSIGNED NOT NULL AFTER `log`;
ALTER TABLE `calme` ADD COLUMN `numbordregle` varchar(100) DEFAULT NULL AFTER `lastname`, ADD COLUMN `numbordvalide` varchar(100) DEFAULT NULL AFTER `lastname`, ADD COLUMN `datereglement` date DEFAULT NULL AFTER `lastname`, ADD COLUMN `datevalidation` date DEFAULT NULL AFTER `lastname`
ALTER TABLE `contrat` ADD COLUMN `numbordregle` varchar(100) DEFAULT NULL AFTER `referencecredit`, ADD COLUMN `numbordvalide` varchar(100) DEFAULT NULL AFTER `referencecredit`, ADD COLUMN `datereglement` date DEFAULT NULL AFTER `referencecredit`, ADD COLUMN `datevalidation` date DEFAULT NULL AFTER `referencecredit`;
ALTER TABLE `synchronisationnum` ADD COLUMN 'numreglement' int(11) NOT NULL DEFAULT '1' AFTER `utilisateurs`, ADD COLUMN 'numproduction' int(11) NOT NULL DEFAULT '1' AFTER `utilisateurs`;
?>

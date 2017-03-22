ALTER TABLE `dm_bill` ADD `staff_id` INT NULL AFTER `patient_id`;

INSERT INTO `karl_derma`.`dm_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`) VALUES (NULL, 'staff', 'administration', '110', 'staff/index', NULL, 'Staff', 'prescription');
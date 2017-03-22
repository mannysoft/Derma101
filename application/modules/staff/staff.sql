ALTER TABLE `dm_bill` ADD `staff_id` INT NULL AFTER `patient_id`;

INSERT INTO `dm_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`) VALUES (NULL, 'staff', 'administration', '110', 'staff/index', NULL, 'Staff', 'prescription');

INSERT INTO `dm_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`) VALUES (NULL, 'assignments', 'administration', '110', 'assignments/index', NULL, 'Treatment Assignments', 'prescription');

INSERT INTO `dm_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`) VALUES (NULL, 'commissions', 'administration', '110', 'commissions/index', NULL, 'Commissions', 'prescription');
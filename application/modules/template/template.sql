INSERT INTO %db_prefix%modules (module_name, module_display_name,module_description, module_status) VALUES ('template','Receipt Template', 'Receipt Template', '1');
INSERT INTO %db_prefix%navigation_menu (menu_name,parent_name,menu_order,menu_url,menu_icon,menu_text,required_module) VALUES ( 'receipt_template', 'administration', '500', 'template/index', NULL, 'Receipt Templates', 'template');
UPDATE %db_prefix%modules SET module_version = '0.0.2' WHERE module_name = 'template';
UPDATE %db_prefix%modules SET module_version = '0.0.3' WHERE module_name = 'template';
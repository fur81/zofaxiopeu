<?php
global $values;
$values['query'] = array(

		/** -- usuarios -- */
		'getUserById' => 'SELECT id, username, realname, email, access_level, login_count, last_visit
						 FROM mantis_user_table WHERE id = %value%;',
		
		/** -- cuentas de usuarios -- */
		'createAccount' => 'INSERT INTO mantis_user_table(username, realname, email, password, enabled, protected,
								access_level, login_count, lost_password_request_count,failed_login_count,
								cookie_string, last_visit, date_created) VALUES (%values%);',

		'findAccountByUsername' => 'SELECT id FROM mantis_user_table WHERE username = %value%;',

		'addAccountToProject' => 'INSERT INTO mantis_project_user_list_table(project_id, user_id, access_level) VALUES (%values%);',
		
		/** -- categorias de usuarios -- */
		'addUserCategory' => 'INSERT INTO mantis_user_category(name) VALUES (%values%);',
		'getUserCategories' => 'SELECT id, name FROM mantis_user_category ORDER BY id;',
		'removeUserCategory' => 'DELETE FROM mantis_user_category WHERE id = %value%;',
		'getUsersNotInCategory' => 'SELECT id, realname FROM mantis_user_table WHERE id NOT IN (
									SELECT user_id FROM mantis_user_category_table WHERE user_category_id = %value%)
									AND access_level = 55',
		'getUsersInCategory' => 'SELECT id, realname FROM mantis_user_table WHERE id IN (
									SELECT user_id FROM mantis_user_category_table WHERE user_category_id = %value%)
									AND access_level = 55',
		'addUserToCategory' => 'INSERT INTO mantis_user_category_table(user_id, user_category_id) VALUES (%values%)',
		'removeUserToCategory' => 'DELETE FROM mantis_user_category_table WHERE user_id = %userId% AND user_category_id = %categoryId%',
		
		/** -- proyectos -- */
		'getProjectName' => 'SELECT name FROM mantis_project_table WHERE id = %value%;',
		'getDeveloperUsersByProject' => 'SELECT  user_id, realname FROM mantis_user_table 
										INNER JOIN mantis_project_user_list_table ON user_id = id
										WHERE project_id = %value% AND mantis_project_user_list_table.access_level = 55;',
		'getSubprojects' => 'SELECT child_id AS subprojectId FROM mantis_project_hierarchy_table WHERE parent_id = %value%',
		'getProjectNoAsigned' => 'SELECT id FROM mantis_project_table WHERE enabled = 1 AND id NOT IN (
									SELECT project_id FROM mantis_project_user_list_table WHERE user_id = %value%)',
		
		/** -- incidencias -- */
		'getIssuesWithHistoryCount' => 'SELECT COUNT(count) AS total FROM ( 
											SELECT COUNT(*) AS count FROM mantis_bug_history_table INNER JOIN (
											SELECT id FROM mantis_bug_table WHERE project_id = %value%) AS bugs 
											ON bug_id = bugs.id WHERE (type = 26 OR type = 25) 
											GROUP BY bug_id HAVING count % 2 = 1) AS result',

		/** -- historial de incidencias -- */
		'getLastHistoryBug' => 'SELECT * FROM mantis_bug_history_table WHERE bug_id = %value% ORDER BY id DESC LIMIT 1',
		'addHistoryBug' => 'INSERT INTO mantis_bug_history_table(user_id, bug_id, field_name, old_value, new_value, type, date_modified) 
							VALUES (%values%)',
		'getHistoriesBugTag' => 'SELECT COUNT(bug_id) AS totalRows FROM mantis_bug_history_table WHERE bug_id = %value% AND 
								(type = 25 OR type = 26)',

		/** -- temporal data -- */
		'createTemporalData' => 'INSERT INTO mantis_temp_table(data) VALUES ("%value%");',
		'updateTemporalData' => 'UPDATE mantis_temp_table SET data="%value%" WHERE id = %idData%;',
		'removeTemporalData' => 'DELETE FROM mantis_temp_table WHERE id = %idData%;',
		'getTemporalData' => 'SELECT data FROM mantis_temp_table WHERE id= %idData%;'
);

?>
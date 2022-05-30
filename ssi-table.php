<?php

function tablo()
{
	global $cmsFunc;
	$ignore_list = ['created_at', 'updated_at', 'deleted_at', 'company_id'];
	echo "
		if (\$_SERVER['REQUEST_METHOD'] === 'POST')
		{			
			\$insert_key = '';
			\$insert_value = '';
	
			\$modify_value = '';
			";	

	if (isset($_REQUEST['tablo']))
	{	
		$table = $_REQUEST['tablo'];
		$dbresult = $cmsFunc['db_query']('', "SHOW COLUMNS FROM  {db_prefix}$table");
		$Submit = "";
		$Submit2 = "";	
		$Modify = "";
			
		while ($row = $cmsFunc['db_fetch_assoc']($dbresult))
		{

			$field = $row['Field'];
			if(in_array($field, $ignore_list))
				continue;
			$type = $row['Type'];
			$param = "\$_REQUEST['$field'];";
			$paramtext = "\$cmsFunc['htmlspecialchars'](\$_REQUEST['$field'], ENT_QUOTES);";

			echo "
			if(isset(\$_REQUEST['$field']))
			{";

			if(strpos($type, "int") !== false)
			{
			echo "
				\$$field = (int) $param
				";

				$Submit .= "$$field, ";
				$Submit2 .= "'$field', ";
				$Modify .= "$$field = '$field', ";
			}
			elseif(strpos($type, "text") !== false)
			{
			echo "
				\$$field = $paramtext
				";

				$Submit .= "$$field, ";
				$Submit2 .= "'$field', ";
				$Modify .= "$$field = '$field', ";				
			}
			elseif(strpos($type, "varchar") !== false)
			{
			echo "
				\$$field = $paramtext
				";

				$Submit .= "$$field, ";
				$Submit2 .= "'$field', ";
				$Modify .= "$$field = '$field', ";				
			}
			elseif(strpos($type, "double") !== false)
			{
			echo "
				\$$field = (double) $param
				";

				$Submit .= "$$field, ";
				$Submit2 .= "'$field', ";
				$Modify .= "$$field = '$field', ";				
			}
			elseif(strpos($type, "timestamp") !== false)
			{
			echo "
				\$$field = date('Y-m-d H:i:s');
				";

				$Submit .= "$$field, ";
				$Submit2 .= "'$field', ";
				$Modify .= "$$field = '$field', ";				
			}
			else
				echo $type;
			
			echo "
				\$insert_key .= \"$field, \";
				\$insert_value .= \"'\$$field', \";

				\$modify_value .= \"$field = '\$$field', \";			
			}";		
		}

		$Submit = substr($Submit, 0, -2);
		$Submit2 = substr($Submit2, 0, -2);
		$Modify = substr($Modify, 0, -2);

		$cmsFunc['db_free_result']($dbresult);	
			echo "
			if(isset(\$_REQUEST['form_action']))";
			echo "
				\$form_action = \$cmsFunc['htmlspecialchars'](\$_REQUEST['form_action'], ENT_QUOTES);
				";
			
			echo "
			else
				\$form_action = 'bos';		

			switch (\$form_action)
			{
				case 'Submit':
					\$created_at = date('Y-m-d H:i:s');
			
					\$insert_key .= \"created_at, \";
					\$insert_value .= \"'\$created_at', \";	

					\$insert_key = substr(\$insert_key, 0, -2);
					\$insert_value = substr(\$insert_value, 0, -2);

					\$cmsFunc['db_query']('', \"
					INSERT INTO {db_prefix}$table 
					(\$insert_key) 
					VALUES(\$insert_value)
					\");
					
					\$id =  \$cmsFunc['db_insert_id']('{db_prefix}$table ', 'id');

					break;

				case 'Modify':
					\$updated_at = date('Y-m-d H:i:s');
			
					\$modify_value .= \"updated_at = '\$updated_at', \";

					\$modify_value = substr(\$modify_value, 0, -2);
				
					\$cmsFunc['db_query']('', \"
					UPDATE {db_prefix}$table SET \$modify_value
					WHERE id=\$id\");

					break;
					
				case 'Delete':
					\$deleted_at = date('Y-m-d H:i:s');
					\$modify_value .= \"deleted_at = '\$deleted_at', \";

					\$modify_value = substr(\$modify_value, 0, -2);
					\$cmsFunc['db_query']('', \"
					UPDATE {db_prefix}$table SET \$modify_value
					WHERE id=\$id\");
					//\$cmsFunc['db_query']('', \"DELETE FROM {db_prefix}$table WHERE id=\$id\");

					break;
			}

			";
	}
	echo "
		}
		else
		{
			
		}";		
	
}



function tablo2()
{
	global $cmsFunc;
	echo "
		if (\$_SERVER['REQUEST_METHOD'] === 'POST')
		{";	

	if (isset($_REQUEST['tablo']))
	{	
		$table = $_REQUEST['tablo'];
		$dbresult = $cmsFunc['db_query']('', "SHOW COLUMNS FROM  {db_prefix}$table");
		$Submit = "";
		$Submit2 = "";	
		$Modify = "";
			
		while ($row = $cmsFunc['db_fetch_assoc']($dbresult))
		{
			$field = $row['Field'];
			$type = $row['Type'];
			$param = "\$_REQUEST['$field'];";
			$paramtext = "\$cmsFunc['htmlspecialchars'](\$_REQUEST['$field'], ENT_QUOTES);";

			echo "
			if(isset(\$_REQUEST['$field']))
			{";

			if(strpos($type, "int") !== false)
			{
				echo "
				\$$field = (int) $param
				";

				$Submit .= "$$field, ";
				$Submit2 .= "'$field', ";
				$Modify .= "$$field = '$field', ";
			}
			elseif(strpos($type, "text") !== false)
			{
				echo "
				\$$field = $paramtext
				";

				$Submit .= "$$field, ";
				$Submit2 .= "'$field', ";
				$Modify .= "$$field = '$field', ";				
			}
			elseif(strpos($type, "varchar") !== false)
			{
				echo "
				\$$field = $paramtext
				";

				$Submit .= "$$field, ";
				$Submit2 .= "'$field', ";
				$Modify .= "$$field = '$field', ";				
			}
			elseif(strpos($type, "double") !== false)
			{
				echo "
				\$$field = (double) $param
				";

				$Submit .= "$$field, ";
				$Submit2 .= "'$field', ";
				$Modify .= "$$field = '$field', ";				
			}
			elseif(strpos($type, "timestamp") !== false)
			{
				echo "
				\$$field = date('Y-m-d H:i:s');
				";

				$Submit .= "$$field, ";
				$Submit2 .= "'$field', ";
				$Modify .= "$$field = '$field', ";				
			}
			else
				echo $type;
			
			echo '
			}';		
		}
	
		$Submit = substr($Submit, 0, -2);
		$Submit2 = substr($Submit2, 0, -2);
		$Modify = substr($Modify, 0, -2);		

		$cmsFunc['db_free_result']($dbresult);	
			echo "
			if(isset(\$_REQUEST['action']))";
			echo "
				\$action = \$cmsFunc['htmlspecialchars'](\$_REQUEST['action'], ENT_QUOTES);
				";
			
			echo "
			else
				\$action = 'bos';


			switch (\$action)
			{
				case 'Submit':
					\$cmsFunc['db_query']('', \"
					INSERT INTO {db_prefix}$table 
					($Submit) 
					VALUES($Submit2)
					\");
					
					\$id =  \$cmsFunc['db_insert_id']('{db_prefix}$table ', 'id');

					break;

				case 'Modify':
				
					\$cmsFunc['db_query']('', \"
					UPDATE {db_prefix}$table SET $Modify
					WHERE id=\$id\");

					break;
					
				case 'Delete':
					\$cmsFunc['db_query']('', \"DELETE FROM {db_prefix}$table WHERE id=\$id\");

					break;
			}
			";
	}
	echo "
		}
		else
		{
			
		}";	
}

?>
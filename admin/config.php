<?php
/*
	admin/config.php
	
	access: admin users only

	Allows administrators to change system-wide settings stored in the config table. Note that only a selection
	of configuration options are provided - some are hidden since user's shouldn't be messing with them.

	Full details are avaliable in the product documentation including information about hidden settings and when
	it's acceptable to adjust them.

	An example is the options to set storage locations, or the options to enable/disable email support which can be
	security risk if enabled on demo or untrusted systems.
*/

class page_output
{
	var $obj_form;


	function check_permissions()
	{
		return user_permissions_get("admin");
	}

	function check_requirements()
	{
		// nothing to do
		return 1;
	}


	function execute()
	{
		/*
			Define form structure
		*/
		
		$this->obj_form = New form_input;
		$this->obj_form->formname = "config";
		$this->obj_form->language = $_SESSION["user"]["lang"];

		$this->obj_form->action = "admin/config-process.php";
		$this->obj_form->method = "post";


		// default codes
		$structure = NULL;
		$structure["fieldname"]			= "ACCOUNTS_AP_INVOICENUM";
		$structure["type"]			= "input";
		$this->obj_form->add_input($structure);
		
		$structure = NULL;
		$structure["fieldname"]			= "ACCOUNTS_AR_INVOICENUM";
		$structure["type"]			= "input";
		$this->obj_form->add_input($structure);

		$structure = NULL;
		$structure["fieldname"]			= "ACCOUNTS_GL_TRANSNUM";
		$structure["type"]			= "input";
		$this->obj_form->add_input($structure);

		$structure = NULL;
		$structure["fieldname"]			= "ACCOUNTS_QUOTES_NUM";
		$structure["type"]			= "input";
		$this->obj_form->add_input($structure);

		$structure = NULL;
		$structure["fieldname"]			= "CODE_ACCOUNT";
		$structure["type"]			= "input";
		$this->obj_form->add_input($structure);

		$structure = NULL;
		$structure["fieldname"]			= "CODE_CUSTOMER";
		$structure["type"]			= "input";
		$this->obj_form->add_input($structure);
		
		$structure = NULL;
		$structure["fieldname"]			= "CODE_PRODUCT";
		$structure["type"]			= "input";
		$this->obj_form->add_input($structure);

		$structure = NULL;
		$structure["fieldname"]			= "CODE_PROJECT";
		$structure["type"]			= "input";
		$this->obj_form->add_input($structure);

		$structure = NULL;
		$structure["fieldname"]			= "CODE_VENDOR";
		$structure["type"]			= "input";
		$this->obj_form->add_input($structure);


		// invoicing options
		$structure = NULL;
		$structure["fieldname"]			= "ACCOUNTS_SERVICES_ADVANCEBILLING";
		$structure["type"]			= "input";
		$this->obj_form->add_input($structure);

		$structure = NULL;
		$structure["fieldname"]			= "ACCOUNTS_TERMS_DAYS";
		$structure["type"]			= "input";
		$this->obj_form->add_input($structure);

		$structure = NULL;
		$structure["fieldname"]			= "ACCOUNTS_INVOICE_AUTOEMAIL";
		$structure["type"]			= "checkbox";
		$structure["options"]["label"]		= "Tick to have service invoices automatically emailed to customers when created.";
		$this->obj_form->add_input($structure);



		// currency options
		$structure = NULL;
		$structure["fieldname"]			= "CURRENCY_DEFAULT_NAME";
		$structure["type"]			= "input";
		$this->obj_form->add_input($structure);
		
		$structure = NULL;
		$structure["fieldname"]			= "CURRENCY_DEFAULT_SYMBOL";
		$structure["type"]			= "input";
		$this->obj_form->add_input($structure);


		// timesheet options
		$structure = NULL;
		$structure["fieldname"]			= "TIMESHEET_BOOKTOFUTURE";
		$structure["type"]			= "checkbox";
		$structure["options"]["label"]		= "Allow users to book time to dates in the future";
		$this->obj_form->add_input($structure);
	
	
		// security options
		$structure = NULL;
		$structure["fieldname"]			= "UPLOAD_MAXBYTES";
		$structure["type"]			= "input";
		$this->obj_form->add_input($structure);
		
		$structure = NULL;
		$structure["fieldname"]			= "BLACKLIST_ENABLE";
		$structure["type"]			= "checkbox";
		$structure["options"]["label"]		= "Enable to prevent brute-force login attempts";
		$this->obj_form->add_input($structure);

		$structure = NULL;
		$structure["fieldname"]			= "BLACKLIST_LIMIT";
		$structure["type"]			= "input";
		$this->obj_form->add_input($structure);





		// audit locking
		$structure = NULL;
		$structure["fieldname"]			= "ACCOUNTS_INVOICE_LOCK";
		$structure["type"]			= "input";
		$this->obj_form->add_input($structure);
		
		$structure = NULL;
		$structure["fieldname"]			= "ACCOUNTS_GL_LOCK";
		$structure["type"]			= "input";
		$this->obj_form->add_input($structure);
			
		$structure = NULL;
		$structure["fieldname"]			= "JOURNAL_LOCK";
		$structure["type"]			= "input";
		$this->obj_form->add_input($structure);

		$structure = NULL;
		$structure["fieldname"]			= "TIMESHEET_LOCK";
		$structure["type"]			= "input";
		$this->obj_form->add_input($structure);




		// company details
		$structure = NULL;
		$structure["fieldname"]			= "COMPANY_NAME";
		$structure["type"]			= "input";
		$this->obj_form->add_input($structure);
	
		$structure = NULL;
		$structure["fieldname"]			= "COMPANY_CONTACT_EMAIL";
		$structure["type"]			= "input";
		$this->obj_form->add_input($structure);
	
		$structure = NULL;
		$structure["fieldname"]			= "COMPANY_CONTACT_PHONE";
		$structure["type"]			= "input";
		$this->obj_form->add_input($structure);
	
		$structure = NULL;
		$structure["fieldname"]			= "COMPANY_CONTACT_FAX";
		$structure["type"]			= "input";
		$this->obj_form->add_input($structure);
	
		$structure = NULL;
		$structure["fieldname"]			= "COMPANY_ADDRESS1_STREET";
		$structure["type"]			= "textarea";
		$this->obj_form->add_input($structure);
	
		$structure = NULL;
		$structure["fieldname"]			= "COMPANY_ADDRESS1_CITY";
		$structure["type"]			= "input";
		$this->obj_form->add_input($structure);
	
		$structure = NULL;
		$structure["fieldname"]			= "COMPANY_ADDRESS1_STATE";
		$structure["type"]			= "input";
		$this->obj_form->add_input($structure);

		$structure = NULL;
		$structure["fieldname"]			= "COMPANY_ADDRESS1_COUNTRY";
		$structure["type"]			= "input";
		$this->obj_form->add_input($structure);

		$structure = NULL;
		$structure["fieldname"]			= "COMPANY_ADDRESS1_ZIPCODE";
		$structure["type"]			= "input";
		$this->obj_form->add_input($structure);

		$structure = NULL;
		$structure["fieldname"]			= "COMPANY_PAYMENT_DETAILS";
		$structure["type"]			= "textarea";
		$this->obj_form->add_input($structure);
	
	
	
	
		
		$structure = NULL;
		$structure["fieldname"] 	= "COMPANY_LOGO";
		$structure["type"]		= "file";
		$this->obj_form->add_input($structure);
	
		$structure = NULL;
		$structure["fieldname"] 	= "COMPANY_LOGO_MSG";
		$structure["type"]		= "message";
		$structure["defaultvalue"]	= "Note: You only need to upload a logo once or when you want to replace it with a new logo. The logo will be used on PDF files generated by the billing system such as invoices.";
		$this->obj_form->add_input($structure);


	
	
		// app and file paths
		$structure = NULL;
		$structure["fieldname"]			= "APP_PDFLATEX";
		$structure["type"]			= "input";
		$this->obj_form->add_input($structure);
	


		// dangerous options
		if ($GLOBALS["config"]["dangerous_conf_options"] == "enabled")
		{
			$structure = NULL;
			$structure["fieldname"]			= "EMAIL_ENABLE";
			$structure["type"]			= "checkbox";
			$structure["options"]["label"]		= "Enable or disable the ability to send emails. If you don't trust users not to try using the system to spam people (eg: if this is a demo system) then it is highly recommended to disable this option.";
			$this->obj_form->add_input($structure);
	
			$structure = NULL;
			$structure["fieldname"]			= "DATA_STORAGE_METHOD";
			$structure["type"]			= "radio";
			$structure["values"]			= array("database", "filesystem");
			$this->obj_form->add_input($structure);
	
			$structure = NULL;
			$structure["fieldname"]			= "DATA_STORAGE_LOCATION";
			$structure["type"]			= "input";
			$this->obj_form->add_input($structure);
		}

	

		// submit section
		$structure = NULL;
		$structure["fieldname"]			= "submit";
		$structure["type"]			= "submit";
		$structure["defaultvalue"]		= "Save Changes";
		$this->obj_form->add_input($structure);
		
		
		// define subforms
		$this->obj_form->subforms["config_company"]		= array("COMPANY_NAME", "COMPANY_CONTACT_EMAIL", "COMPANY_CONTACT_PHONE", "COMPANY_CONTACT_FAX", "COMPANY_ADDRESS1_STREET", "COMPANY_ADDRESS1_CITY","COMPANY_ADDRESS1_STATE","COMPANY_ADDRESS1_COUNTRY", "COMPANY_ADDRESS1_ZIPCODE", "COMPANY_PAYMENT_DETAILS", "COMPANY_LOGO", "COMPANY_LOGO_MSG");
		$this->obj_form->subforms["config_defcodes"]		= array("ACCOUNTS_AP_INVOICENUM", "ACCOUNTS_AR_INVOICENUM", "ACCOUNTS_GL_TRANSNUM", "ACCOUNTS_QUOTES_NUM", "CODE_ACCOUNT", "CODE_CUSTOMER", "CODE_VENDOR", "CODE_PRODUCT", "CODE_PROJECT");
		$this->obj_form->subforms["config_accounts"]		= array("ACCOUNTS_SERVICES_ADVANCEBILLING", "ACCOUNTS_TERMS_DAYS", "ACCOUNTS_INVOICE_AUTOEMAIL");
		$this->obj_form->subforms["config_timesheet"]		= array("TIMESHEET_BOOKTOFUTURE");
		$this->obj_form->subforms["config_currency"]		= array("CURRENCY_DEFAULT_NAME", "CURRENCY_DEFAULT_SYMBOL");
		$this->obj_form->subforms["config_auditlocking"]	= array("ACCOUNTS_INVOICE_LOCK", "ACCOUNTS_GL_LOCK", "JOURNAL_LOCK", "TIMESHEET_LOCK");
		$this->obj_form->subforms["config_security"]		= array("BLACKLIST_ENABLE", "BLACKLIST_LIMIT", "UPLOAD_MAXBYTES");
		$this->obj_form->subforms["config_paths"]		= array("APP_PDFLATEX");

		if ($GLOBALS["config"]["dangerous_conf_options"] == "enabled")
		{
			$this->obj_form->subforms["config_dangerous"]	= array("EMAIL_ENABLE", "DATA_STORAGE_LOCATION", "DATA_STORAGE_METHOD");
		}
		
		$this->obj_form->subforms["submit"]			= array("submit");

		if ($_SESSION["error"]["message"])
		{
			// load error datas
			$this->obj_form->load_data_error();
		}
		else
		{
			// fetch all the values from the database
			$sql_config_obj		= New sql_query;
			$sql_config_obj->string	= "SELECT name, value FROM config ORDER BY name";
			$sql_config_obj->execute();
			$sql_config_obj->fetch_array();

			foreach ($sql_config_obj->data as $data_config)
			{
				$this->obj_form->structure[ $data_config["name"] ]["defaultvalue"] = $data_config["value"];
			}

			unset($sql_config_obj);
		}
	}



	function render_html()
	{
		// Title + Summary
		print "<h3>CONFIGURATION</h3><br>";
		print "<p>This page allows you to adjust the application configuration. Make sure you understand any options before adjusting them - refer to the product manual for help information.</p>";
	
		// display the form
		$this->obj_form->render_form();
	}

	
}

?>
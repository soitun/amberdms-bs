<?php
/*
	user/login.php

	provides the user login interface
*/



class page_output
{
	var $obj_form;


	function check_permissions()
	{
		if (user_online())
		{
			log_write("error", "You are already logged in, there is no need to revisit the login page.");
			return 0;
		}
		else
		{
			return 1;
		}
	}

	function check_requirements()
	{
		// nothing todo
		return 1;
	}



	function execute()
	{
		/*
			Make sure that the user's old session has been totally cleaned up
			otherwise some very strange errors and logon behaviour can occur
		*/
		$_SESSION["user"] = array();


		/*
			Define Login Form
		*/
		$this->obj_form = New form_input;

		$this->obj_form->formname = "login";

		$this->obj_form->action = "user/login-process.php";
		$this->obj_form->method = "post";
		

		// general
		if ($GLOBALS["config"]["instance"] == "hosted")
		{
			$structure = NULL;
			$structure["fieldname"] 	= "instance_amberdms_bs";
			$structure["type"]		= "input";
			$this->obj_form->add_input($structure);
		}

		$structure = NULL;
		$structure["fieldname"] 	= "username_amberdms_bs";
		$structure["type"]		= "input";
		$this->obj_form->add_input($structure);
		
		$structure = NULL;
		$structure["fieldname"] 	= "password_amberdms_bs";
		$structure["type"]		= "password";
		$this->obj_form->add_input($structure);
		

		// submit button
		$structure = NULL;
		$structure["fieldname"] 	= "submit";
		$structure["type"]		= "submit";
		$structure["defaultvalue"]	= "Login";
		$this->obj_form->add_input($structure);
		

		// load any data returned due to errors
		$this->obj_form->load_data_error();
	}



	function render_html()
	{
		// heading
		print "<h3>SYSTEM LOGIN:</h3>";
		print "<p>Please enter your username and password to login to the Amberdms Billing System.</p>";

		// javascript notification
		print "<noscript>";
		print "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"5\"><tr>";
		print "<td bgcolor=\"#ffc274\">";
		print "<p><b>We have detected that you have the javascript capabilities of your browser turned off.</b><br><br>";
		print "The Amberdms Billing System will work without javascript, but will not provide the best experience. We highly recommend you use this website with a Javascript-enabled browser.";
		print "</p>";
		print "</td>";
		print "</tr></table>";
		print "</noscript>";

		// display the form
		$this->obj_form->render_form();


		// troubleshoot page
		print "<p id=\"troublestart\"><br><br><a href=\"#\" onclick=\"obj_show('trouble'); obj_hide('troublestart');\"><b>Unable to login? Click here for help</b></a></p>";
		print "<div id=\"trouble\">";
		print "<br><br><br><hr>";
		
		if ($_SERVER["SERVER_NAME"] == "www.amberdms.com")
		{
			// different error message for amberdms hosted billing system instances
			print "<h3>LOGIN TROUBLE?</h3>";
			print "<p>If you have forgotten your password, or are having other login problems, please refer to your system administrator.</p>";
			print "<p>In the event your system administrator is unable to resolve your issue, please contact <a href=\"mailto:support@amberdms.com\">support@amberdms.com</a> for assistance.</p>";
			print "</div>";

		}
		else
		{
			// non-amberdms instances
			print "<h3>LOGIN TROUBLE?</h3>";
			print "<p>If you have forgotten your password, please refer to your system administrator or read the Amberdms Billing User Guide for details on how to reset account passwords.</p>";
			print "</div>";
		}

		print "<script type=\"text/javascript\">";
		print "obj_hide('trouble');";
		print "</script>";
	}
	
} // end of page_output class


?>

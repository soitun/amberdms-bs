<?php
/*
	vendors/journal-download-process.php
	
	access: vendors_view (read-only)

	Allows the download of a file attached to the journal.
*/

// includes
include_once("../include/config.php");
include_once("../include/amberphplib/main.php");


if (user_permissions_get('vendors_view'))
{
	$journalid	= security_script_input('/^[0-9]*$/', $_GET["customid"]);
	$fileid 	= security_script_input('/^[0-9]*$/', $_GET["fileid"]);

	// check that the journal entry exists
	if (!$journalid)
	{
		$_SESSION["error"]["message"][] = "No journal ID supplied";
	}
	
	if (!$fileid)
	{
		$_SESSION["error"]["message"][] = "No file ID supplied";
	}


	/*
		Now we verify that the file belongs to a valid journal, and that the journal
		does belong to a vendor.

		This prevent a malicious user from using this page to fetch other files
		belonging to other journals or vendors.
	*/

	// get the ID of the journal from the file ID
	$customid = sql_get_singlevalue("SELECT customid as value FROM file_uploads WHERE id='$fileid'");

	if (!$customid)
	{
		$_SESSION["error"]["message"][] = "No record for this file found in the database.";
	}
	else
	{

		// make sure the custom ID of the file matches the journal ID
		if ($customid != $journalid)
		{
			$_SESSION["error"]["message"][] = "Error: File customid and journal ID do not match";
		}
		else
		{
			// make sure the journal entry belongs to a vendor
			$vendorid = sql_get_singlevalue("SELECT customid as value FROM journal WHERE journalname='vendors' AND id='$journalid'");

			if (!$vendorid)
			{
				$_SESSION["error"]["message"][] = "Unable to match the provided journal entry to a vendor journal.";
			}
		}
	}

	

	/*
		Produce output - either output request file content,
		or take the user to a message page to view errors.
	*/
	if ($_SESSION["error"]["message"])
	{
		header("Location: ../index.php?page=message.php");
		exit(0);
	}
	else
	{
		// output file data
		$file_obj = New file_process;

		$file_obj->fetch_information_by_id($fileid);
		$file_obj->render_filedata();
	}


} // end of if logged in
else
{
	error_render_noperms();
	header("Location: ../index.php?page=message.php");
	exit(0);
}

?>
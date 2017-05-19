<?

/**
* 
*/
class AjaxHandler
{
	
	function __construct()
	{
		# code...
	}

	function GetChapitres()
	{
		Config::load_class("View")

		$id_matiere=$_GET['m'];

		chapitres_select_view($id_matiere);
	}
}
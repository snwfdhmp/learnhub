<?

/**
* 
*/
class Tag
{
	
	function __construct()
	{
		# code...
	}
	
	//
	//Tag::a("Cliquez ici", array("href"=>"#"))
	public static function __callStatic($name, $arguments) { // "a", array("Cliquez ici : ", array("href" => "#"))
		if(!is_array($arguments[0]))
			$inner=array_splice($arguments,0,1)[0]; //array(array("href" => "#"))
		else
			$inner="";
		$attr_html = "";
		if(is_array($arguments)) {
			$prop_iter = new CachingIterator(new ArrayIterator($arguments));
			foreach ($prop_iter as $prop => $value) {
				$attr_html .= key($value).'="';
				if(is_array($value)) {
					$attr_iter = new CachingIterator(new ArrayIterator($value));
					foreach ($attr_iter as $set_attr) {
						$attr_html .= $set_attr;
						if($attr_iter->hasNext())
							$attr_html.=' ';
					}
					$attr_html .= '"';
				}
				else {
					$attr_html .= $attr.'"';
				}
				if($prop_iter->hasNext())
					$attr_html .= ' ';
			}
		}
		return "<$name $attr_html>$inner</$name>";
	}
}
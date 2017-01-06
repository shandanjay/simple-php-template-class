<?php
/**
 * 
 * @author Dan Jay <shandanjay@gmail.com>
 * Created On 03/07/2015
 *
 */
class Template {
	var $filename;
	var $TEMPLATE;

	public function __construct($filefullpath) {
				
		if(file_exists($filefullpath)){
			$this->filename = $filefullpath;
		}else{
				throw new Exception("Template File Not Exist => ". $filefullpath );
		}
	}

	public function mk($filename) {
		$this->filename = $filename;
		return $this->make();
	}
	
	public function make($TEMPLATE) {
		$this->template = $TEMPLATE;
		$file = $this->filename;
		$fh_skin = fopen($file, 'r');
		$skin = @fread($fh_skin, filesize($file));
		fclose($fh_skin);
		
		return $this->parse($skin);
	}
	
	private function parse($skin) {
		
		$_TEMPLATE = $this->template;
		
		$skin = preg_replace_callback('/{\$([a-zA-Z0-9_]+)}/', function($matches) use ($_TEMPLATE){ return (isset($_TEMPLATE[$matches[1]])?$_TEMPLATE[$matches[1]]:"");}, $skin);
		
		//$skin = preg_replace_callback('/{\$([a-zA-Z0-9_]+)}/', create_function('$matches', 'global $TEMPLATE; return (isset($TEMPLATE[$matches[1]])?$TEMPLATE[$matches[1]]:"");'), $skin);
	
		return $skin;
	}
	
	public static function parse_if($skin, $var) {
	
		$skin = preg_replace_callback('#\{if\s(.+?)}(.+?)\{/if}#s', function($matches) use ($var) { return (str_replace("#", "", $matches[1])==$var)?$matches[2]:""; }, $skin);
	
		return $skin;
	}
}
?>

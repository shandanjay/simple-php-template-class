<?php
use PHPUnit\Framework\TestCase;

class TemplateTest extends TestCase
{
	protected $template;
	protected $path;

	/**
	 **	@expectedException Exception
	 **/	
	public function __construct()
	{
		global $file;
		$this->path = $file;
		$this->template = new Template($file);
	}
	public function testTemplateFileNameNull()	{

		$this->assertNotNull($this->path, "File name is null");
	}
	public function testTemplateFileNameString()	{

		$this->assertInternalType('string',$this->path, "File name is not a string");
	}
	public function testTemplateFileExists()	{

		$this->assertFileExists($this->path, "File does not exists");
	}
	public function testTemplateFileReadable()	{

		$this->assertIsReadable($this->path, "File is not readable");
	}

}

<?php namespace thiagoalessio\TesseractOCR\Tests\Unit;

use thiagoalessio\TesseractOCR\Tests\Common\TestCase;
use thiagoalessio\TesseractOCR\TesseractOCR;
use thiagoalessio\TesseractOCR\Tests\Unit\TestableCommand;

class TesseractOCRTest extends TestCase
{
	public function beforeEach()
	{
		$this->tess = new TesseractOCR(null, new TestableCommand('image.png'));
	}

	public function testSimplestUsage()
	{
		$expected = '"tesseract" "image.png" stdout';
		$actual = $this->tess->command;
		$this->assertEquals("$expected", "$actual");
	}

	public function testCustomExecutablePath()
	{
		$expected = '"/custom/path/to/tesseract" "image.png" stdout';
		$actual = $this->tess->executable('/custom/path/to/tesseract')->command;
		$this->assertEquals("$expected", "$actual");
	}

	public function testDefiningOptions()
	{
		$expected = '"tesseract" "image.png" stdout -l eng hocr';
		$actual = $this->tess->lang('eng')->format('hocr')->command;
		$this->assertEquals("$expected", "$actual");
	}

	public function testWhitelistSingleStringArgument()
	{
		$expected = '"tesseract" "image.png" stdout -c "tessedit_char_whitelist=abcdefghij"';
		$actual = $this->tess->whitelist('abcdefghij')->command;
		$this->assertEquals("$expected", $actual);
	}

	public function testWhitelistMultipleStringArguments()
	{
		$expected = '"tesseract" "image.png" stdout -c "tessedit_char_whitelist=abcdefghij"';
		$actual = $this->tess->whitelist('ab', 'cd', 'ef', 'gh', 'ij')->command;
		$this->assertEquals("$expected", "$actual");
	}

	public function testWhitelistSingleArrayArgument()
	{
		$expected = '"tesseract" "image.png" stdout -c "tessedit_char_whitelist=abcdefghij"';
		$actual = $this->tess->whitelist(range('a', 'j'))->command;
		$this->assertEquals("$expected", "$actual");
	}

	public function testWhitelistMultipleArrayArguments()
	{
		$expected = '"tesseract" "image.png" stdout -c "tessedit_char_whitelist=abcdefghij"';
		$actual = $this->tess->whitelist(range('a', 'e'), range('f', 'j'))->command;
		$this->assertEquals("$expected", "$actual");
	}

	public function testWhitelistMixedArguments()
	{
		$expected = '"tesseract" "image.png" stdout -c "tessedit_char_whitelist=0123456789abcdefghij"';
		$actual = $this->tess->whitelist(range(0, 9), 'abcd', range('e', 'j'))->command;
		$this->assertEquals("$expected", "$actual");
	}

	public function testDefiningConfigPairs()
	{
		$expected = '"tesseract" "image.png" stdout '
			.'-c "load_system_dawg=F" '
			.'-c "tessedit_create_pdf=1"';
		$actual = $this->tess->loadSystemDawg('F')->tesseditCreatePdf(1)->command;
		$this->assertEquals("$expected", "$actual");
	}

	public function testDefiningConfigFile()
	{
		$expected = '"tesseract" "image.png" stdout tsv';
		$actual = $this->tess->configFile('tsv')->command;
		$this->assertEquals("$expected", "$actual");
	}

	// @deprecated
	public function testDefiningFormat()
	{
		$expected = '"tesseract" "image.png" stdout tsv';
		$actual = $this->tess->format('tsv')->command;
		$this->assertEquals("$expected", "$actual");
	}

	public function testDigits()
	{
		$expected = '"tesseract" "image.png" stdout digits';
		$actual = $this->tess->digits()->command;
		$this->assertEquals("$expected", "$actual");
	}

	public function testHocr()
	{
		$expected = '"tesseract" "image.png" stdout hocr';
		$actual = $this->tess->hocr()->command;
		$this->assertEquals("$expected", "$actual");
	}

	public function testPdf()
	{
		$expected = '"tesseract" "image.png" stdout pdf';
		$actual = $this->tess->pdf()->command;
		$this->assertEquals("$expected", "$actual");
	}

	public function testQuiet()
	{
		$expected = '"tesseract" "image.png" stdout quiet';
		$actual = $this->tess->quiet()->command;
		$this->assertEquals("$expected", "$actual");
	}

	public function testTsv()
	{
		$expected = '"tesseract" "image.png" stdout tsv';
		$actual = $this->tess->tsv()->command;
		$this->assertEquals("$expected", "$actual");
	}

	public function testTxt()
	{
		$expected = '"tesseract" "image.png" stdout txt';
		$actual = $this->tess->txt()->command;
		$this->assertEquals("$expected", "$actual");
	}

	public function testThreadLimit()
	{
		$expected = 'OMP_THREAD_LIMIT=4 "tesseract" "image.png" stdout';
		$actual = $this->tess->threadLimit(4)->command;
		$this->assertEquals("$expected", "$actual");
	}
}

<?php 
//require_once 'src/TesseractOCR.php';


class Option
{
	public static function psm($psm)
	{
		return function($version) use ($psm) {
			return (version_compare($version, 4, '>=') ? '-' : '')."-psm $psm";
		};
	}

	public static function oem($oem)
	{
		return function($version) use ($oem) {
			self::checkMinVersion('3.05', $version, 'oem');
			return "--oem $oem";
		};
	}

	public static function userWords($path)
	{
		return function($version) use ($path) {
			self::checkMinVersion('3.04', $version, 'user-words');
			return '--user-words "'.addcslashes($path, '\\"').'"';
		};
	}

	public static function userPatterns($path)
	{
		return function($version) use ($path) {
			self::checkMinVersion('3.04', $version, 'user-patterns');
			return '--user-patterns "'.addcslashes($path, '\\"').'"';
		};
	}

	public static function tessdataDir($path)
	{
		return function() use ($path) {
			return '--tessdata-dir "'.addcslashes($path, '\\"').'"';
		};
	}

	public static function lang()
	{
		$languages = func_get_args();
		return function() use ($languages) {
			return '-l '.join('+', $languages);
		};
	}

	public static function config($var, $value)
	{
		return function() use($var, $value) {
			$snakeCase = function($str) {
				return strtolower(preg_replace('/([A-Z])+/', '_$1', $str));
			};
			$pair = $snakeCase($var).'='.$value;
			return '-c "'.addcslashes($pair, '\\"').'"';
		};
	}

	public static function checkMinVersion($minVersion, $currVersion, $option)
	{
		if (!version_compare($currVersion, $minVersion, '<')) return;
		$msg = "$option option is only available on Tesseract $minVersion or later.";
		$msg.= PHP_EOL."Your version of Tesseract is $currVersion";
		throw new \Exception($msg);
	}
}

class Command
{
	public $executable = 'tesseract';
	public $options = [];
	public $configFile;
	public $threadLimit;
	private $image;

	public function __construct($image)
	{
		$this->image = $image;
	}

	public function build() { return "$this"; }

	public function __toString()
	{
		$cmd = [];
		if ($this->threadLimit) $cmd[] = "OMP_THREAD_LIMIT={$this->threadLimit}";
		$cmd[] = self::escape($this->executable);
		$cmd[] = self::escape($this->image);
		$cmd[] = 'stdout';

		$version = $this->getTesseractVersion();

		foreach ($this->options as $option) {
			$cmd[] = is_callable($option) ? $option($version) : "$option";
		}
		if ($this->isVersion303()) $this->configFile = 'quiet';
		if ($this->configFile) $cmd[] = $this->configFile;

		return join(' ', $cmd);
	}

	private function isVersion303()
	{
		$version = $this->getTesseractVersion();
		return version_compare($version, '3.03', '>=')
			&& version_compare($version, '3.04', '<');
	}

	protected function getTesseractVersion()
	{
		exec(self::escape($this->executable).' --version 2>&1', $output);
		return explode(' ', $output[0])[1];
	}

	private static function escape($str)
	{
		return '"'.addcslashes($str, '\\"').'"';
	}
}


class TesseractOCR
{
	public $command;
	public function __construct($image, $command=null)
	{
		$this->command = $command ?: new Command($image);
	}
	public function run()
	{
		exec("{$this->command}", $output);
		return trim(join(PHP_EOL, $output));
	}
	public function executable($executable)
	{
		$this->command->executable = $executable;
		return $this;
	}
	public function configFile($configFile)
	{
		$this->command->configFile = $configFile;
		return $this;
	}
	public function threadLimit($limit)
	{
		$this->command->threadLimit = $limit;
		return $this;
	}
	// @deprecated
	public function format($fmt) { return $this->configFile($fmt); }
	public function whitelist()
	{
		$concat = function ($arg) { return is_array($arg) ? join('', $arg) : $arg; };
		$whitelist = join('', array_map($concat, func_get_args()));
		$this->command->options[] = Option::config('tessedit_char_whitelist', $whitelist);
		return $this;
	}
	public function __call($method, $args)
	{
		if ($this->isConfigFile($method)) return $this->configFile($method);
		if ($this->isOption($method)) {
			$option = $this->getOptionClassName().'::'.$method;
			$this->command->options[] = call_user_func_array($option, $args);
			return $this;
		}
		$this->command->options[] = Option::config($method, $args[0]);
		return $this;
	}
	private function isConfigFile($name)
	{
		return in_array($name, ['digits', 'hocr', 'pdf', 'quiet', 'tsv', 'txt']);
	}
	private function isOption($name)
	{
		return in_array($name, get_class_methods($this->getOptionClassName()));
	}
	private function getOptionClassName()
	{
		return __NAMESPACE__.'\\Option';
	}
}

$tesseract = new TesseractOCR('text.png');
$text = $tesseract->recognize();
echo "The recognized text is:", $text;
$tesseract = new TesseractOCR('text.png');
$text = $tesseract->run();
echo '<pre>';
var_dump($tesseract); 
echo '</pre>';
echo PHP_EOL, "The recognized text is:", $text, PHP_EOL;

?>
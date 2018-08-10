***Get all texts from images using php OCR***

Include HTTP/Request2.php library.

Include **Net/URL2.php** :

<?php
class Net_URL2
{

    const OPTION_STRICT = 'strict';
    const OPTION_USE_BRACKETS = 'use_brackets';

    const OPTION_DROP_SEQUENCE = 'drop_sequence';
    const OPTION_ENCODE_KEYS = 'encode_keys';

     const OPTION_SEPARATOR_INPUT = 'input_separator';
    const OPTION_SEPARATOR_OUTPUT = 'output_separator';

    private $_options = array(
        self::OPTION_STRICT           => true,
        self::OPTION_USE_BRACKETS     => true,
        self::OPTION_DROP_SEQUENCE    => true,
        self::OPTION_ENCODE_KEYS      => true,
        self::OPTION_SEPARATOR_INPUT  => '&',
        self::OPTION_SEPARATOR_OUTPUT => '&',
        );

    private $_scheme = false;

    private $_userinfo = false;
    private $_host = false;
    private $_port = false;
    private $_path = '';
    private $_query = false;
    private $_fragment = false;

    public function __construct($url, array $options = array())
    {
        foreach ($options as $optionName => $value) {
            if (array_key_exists($optionName, $this->_options)) {
                $this->_options[$optionName] = $value;
            }
        }

        $this->parseUrl($url);
    }
    public function __set($var, $arg)
    {
        $method = 'set' . $var;
        if (method_exists($this, $method)) {
            $this->$method($arg);
        }
    }

    public function __get($var)
    {
        $method = 'get' . $var;
        if (method_exists($this, $method)) {
            return $this->$method();
        }

        return false;
    }
    public function getScheme()
    {
        return $this->_scheme;
    }
    public function setScheme($scheme)
    {
        $this->_scheme = $scheme;
        return $this;
    }
    public function getUser()
    {
        return $this->_userinfo !== false
            ? preg_replace('(:.*$)', '', $this->_userinfo)
            : false;
    }
    public function getPassword()
    {
        return $this->_userinfo !== false
            ? substr(strstr($this->_userinfo, ':'), 1)
            : false;
    }
    public function getUserinfo()
    {
        return $this->_userinfo;
    }
    public function setUserinfo($userinfo, $password = false)
    {
        if ($password !== false) {
            $userinfo .= ':' . $password;
        }

        if ($userinfo !== false) {
            $userinfo = $this->_encodeData($userinfo);
        }

        $this->_userinfo = $userinfo;
        return $this;
    }

    public function getHost()
    {
        return $this->_host;
    }
    public function setHost($host)
    {
        $this->_host = $host;
        return $this;
    }
    public function getPort()
    {
        return $this->_port;
    }

    public function setPort($port)
    {
        $this->_port = $port;
        return $this;
    }
    public function getAuthority()
    {
        if (false === $this->_host) {
            return false;
        }

        $authority = '';

        if (strlen($this->_userinfo)) {
            $authority .= $this->_userinfo . '@';
        }

        $authority .= $this->_host;

        if ($this->_port !== false) {
            $authority .= ':' . $this->_port;
        }

        return $authority;
    }
    public function setAuthority($authority)
    {
        $this->_userinfo = false;
        $this->_host     = false;
        $this->_port     = false;

        if ('' === $authority) {
            $this->_host = $authority;
            return $this;
        }

        if (!preg_match('(^(([^@]*)@)?(.+?)(:(\d*))?$)', $authority, $matches)) {
            return $this;
        }

        if ($matches[1]) {
            $this->_userinfo = $this->_encodeData($matches[2]);
        }

        $this->_host = $matches[3];

        if (isset($matches[5]) && strlen($matches[5])) {
            $this->_port = $matches[5];
        }
        return $this;
    }

    public function getPath()
    {
        return $this->_path;
    }

    public function setPath($path)
    {
        $this->_path = $path;
        return $this;
    }

    public function getQuery()
    {
        return $this->_query;
    }

    public function setQuery($query)
    {
        $this->_query = $query;
        return $this;
    }

    public function getFragment()
    {
        return $this->_fragment;
    }

    public function setFragment($fragment)
    {
        $this->_fragment = $fragment;
        return $this;
    }
    public function getQueryVariables()
    {
        $separator   = $this->getOption(self::OPTION_SEPARATOR_INPUT);
        $encodeKeys  = $this->getOption(self::OPTION_ENCODE_KEYS);
        $useBrackets = $this->getOption(self::OPTION_USE_BRACKETS);
       $return  = array();
        for ($part = strtok($this->_query, $separator);
            strlen($part);
            $part = strtok($separator)
        ) {
            list($key, $value) = explode('=', $part, 2) + array(1 => '');

            if ($encodeKeys) {
                $key = rawurldecode($key);
            }
            $value = rawurldecode($value);

            if ($useBrackets) {
                $return = $this->_queryArrayByKey($key, $value, $return);
            } else {
                if (isset($return[$key])) {
                    $return[$key]  = (array) $return[$key];
                    $return[$key][] = $value;
                } else {
                    $return[$key] = $value;
                }
            }
        }

        return $return;
    }

    /**
     * Parse a single query key=value pair into an existing php array
     *
     * @param string $key   query-key
     * @param string $value query-value
     * @param array  $array of existing query variables (if any)
     *
     * @return mixed
     */
    private function _queryArrayByKey($key, $value, array $array = array())
    {
        if (!strlen($key)) {
            return $array;
        }

        $offset = $this->_queryKeyBracketOffset($key);
        if ($offset === false) {
            $name = $key;
        } else {
            $name = substr($key, 0, $offset);
        }

        if (!strlen($name)) {
            return $array;
        }

        if (!$offset) {
            // named value
            $array[$name] = $value;
        } else {
            // array
            $brackets = substr($key, $offset);
            if (!isset($array[$name])) {
                $array[$name] = null;
            }
            $array[$name] = $this->_queryArrayByBrackets(
                $brackets, $value, $array[$name]
            );
        }

        return $array;
    }
    private function _queryArrayByBrackets($buffer, $value, array $array = null)
    {
        $entry = &$array;

        for ($iteration = 0; strlen($buffer); $iteration++) {
            $open = $this->_queryKeyBracketOffset($buffer);
            if ($open !== 0) {
                // Opening bracket [ must exist at offset 0, if not, there is
                // no bracket to parse and the value dropped.
                // if this happens in the first iteration, this is flawed, see
                // as well the second exception below.
                if ($iteration) {
                    break;
                }
                // @codeCoverageIgnoreStart
                throw new Exception(
                    'Net_URL2 Internal Error: '. __METHOD__ .'(): ' .
                    'Opening bracket [ must exist at offset 0'
                );
                // @codeCoverageIgnoreEnd
            }

            $close = strpos($buffer, ']', 1);
            if (!$close) {
                // this error condition should never be reached as this is a
                // private method and bracket pairs are checked beforehand.
                // See as well the first exception for the opening bracket.
                // @codeCoverageIgnoreStart
                throw new Exception(
                    'Net_URL2 Internal Error: '. __METHOD__ .'(): ' .
                    'Closing bracket ] must exist, not found'
                );
                // @codeCoverageIgnoreEnd
            }

            $index = substr($buffer, 1, $close - 1);
            if (strlen($index)) {
                $entry = &$entry[$index];
            } else {
                if (!is_array($entry)) {
                    $entry = array();
                }
                $entry[] = &$new;
                $entry = &$new;
                unset($new);
            }
            $buffer = substr($buffer, $close + 1);
        }

        $entry = $value;

        return $array;
    }
      private function _queryKeyBracketOffset($key)
    {
        if (false !== $open = strpos($key, '[')
            and false === strpos($key, ']', $open + 1)
        ) {
            $open = false;
        }

        return $open;
    }

    public function setQueryVariables(array $array)
    {
        if (!$array) {
            $this->_query = false;
        } else {
            $this->_query = $this->buildQuery(
                $array,
                $this->getOption(self::OPTION_SEPARATOR_OUTPUT)
            );
        }
        return $this;
    }

    public function setQueryVariable($name, $value)
    {
        $array = $this->getQueryVariables();
        $array[$name] = $value;
        $this->setQueryVariables($array);
        return $this;
    }

    public function unsetQueryVariable($name)
    {
        $array = $this->getQueryVariables();
        unset($array[$name]);
        $this->setQueryVariables($array);
    }

    public function getURL()
    {
        // See RFC 3986, section 5.3
        $url = '';

        if ($this->_scheme !== false) {
            $url .= $this->_scheme . ':';
        }

        $authority = $this->getAuthority();
        if ($authority === false && strtolower($this->_scheme) === 'file') {
            $authority = '';
        }

        $url .= $this->_buildAuthorityAndPath($authority, $this->_path);

        if ($this->_query !== false) {
            $url .= '?' . $this->_query;
        }

        if ($this->_fragment !== false) {
            $url .= '#' . $this->_fragment;
        }

        return $url;
    }

    private function _buildAuthorityAndPath($authority, $path)
    {
        if ($authority === false) {
            return $path;
        }

        $terminator = ($path !== '' && $path[0] !== '/') ? '/' : '';

        return '//' . $authority . $terminator . $path;
    }

    public function __toString()
    {
        return $this->getURL();
    }

    public function getNormalizedURL()
    {
        $url = clone $this;
        $url->normalize();
        return $url->getURL();
    }

    public function normalize()
    {
        // See RFC 3986, section 6

        // Scheme is case-insensitive
        if ($this->_scheme) {
            $this->_scheme = strtolower($this->_scheme);
        }

        // Hostname is case-insensitive
        if ($this->_host) {
            $this->_host = strtolower($this->_host);
        }

        // Remove default port number for known schemes (RFC 3986, section 6.2.3)
        if ('' === $this->_port
            || $this->_port
            && $this->_scheme
            && $this->_port == getservbyname($this->_scheme, 'tcp')
        ) {
            $this->_port = false;
        }

        // Normalize case of %XX percentage-encodings (RFC 3986, section 6.2.2.1)
        // Normalize percentage-encoded unreserved characters (section 6.2.2.2)
        $fields = array(&$this->_userinfo, &$this->_host, &$this->_path,
                        &$this->_query, &$this->_fragment);
        foreach ($fields as &$field) {
            if ($field !== false) {
                $field = $this->_normalize("$field");
            }
        }
        unset($field);

        // Path segment normalization (RFC 3986, section 6.2.2.3)
        $this->_path = self::removeDotSegments($this->_path);

        // Scheme based normalization (RFC 3986, section 6.2.3)
        if (false !== $this->_host && '' === $this->_path) {
            $this->_path = '/';
        }

        // path should start with '/' if there is authority (section 3.3.)
        if (strlen($this->getAuthority())
            && strlen($this->_path)
            && $this->_path[0] !== '/'
        ) {
            $this->_path = '/' . $this->_path;
        }
    }

    private function _normalize($mixed)
    {
        return preg_replace_callback(
            '((?:%[0-9a-fA-Z]{2})+)', array($this, '_normalizeCallback'),
            $mixed
        );
    }

    private function _normalizeCallback($matches)
    {
        return self::urlencode(urldecode($matches[0]));
    }
    public function isAbsolute()
    {
        return (bool) $this->_scheme;
    }
    public function resolve($reference)
    {
        if (!$reference instanceof Net_URL2) {
            $reference = new self($reference);
        }
        if (!$reference->_isFragmentOnly() && !$this->isAbsolute()) {
            throw new Exception(
                'Base-URL must be absolute if reference is not fragment-only'
            );
        }

        // A non-strict parser may ignore a scheme in the reference if it is
        // identical to the base URI's scheme.
        if (!$this->getOption(self::OPTION_STRICT)
            && $reference->_scheme == $this->_scheme
        ) {
            $reference->_scheme = false;
        }

        $target = new self('');
        if ($reference->_scheme !== false) {
            $target->_scheme = $reference->_scheme;
            $target->setAuthority($reference->getAuthority());
            $target->_path  = self::removeDotSegments($reference->_path);
            $target->_query = $reference->_query;
        } else {
            $authority = $reference->getAuthority();
            if ($authority !== false) {
                $target->setAuthority($authority);
                $target->_path  = self::removeDotSegments($reference->_path);
                $target->_query = $reference->_query;
            } else {
                if ($reference->_path == '') {
                    $target->_path = $this->_path;
                    if ($reference->_query !== false) {
                        $target->_query = $reference->_query;
                    } else {
                        $target->_query = $this->_query;
                    }
                } else {
                    if (substr($reference->_path, 0, 1) == '/') {
                        $target->_path = self::removeDotSegments($reference->_path);
                    } else {
                        // Merge paths (RFC 3986, section 5.2.3)
                        if ($this->_host !== false && $this->_path == '') {
                            $target->_path = '/' . $reference->_path;
                        } else {
                            $i = strrpos($this->_path, '/');
                            if ($i !== false) {
                                $target->_path = substr($this->_path, 0, $i + 1);
                            }
                            $target->_path .= $reference->_path;
                        }
                        $target->_path = self::removeDotSegments($target->_path);
                    }
                    $target->_query = $reference->_query;
                }
                $target->setAuthority($this->getAuthority());
            }
            $target->_scheme = $this->_scheme;
        }

        $target->_fragment = $reference->_fragment;

        return $target;
    }

    private function _isFragmentOnly()
    {
        return (
            $this->_fragment !== false
            && $this->_query === false
            && $this->_path === ''
            && $this->_port === false
            && $this->_host === false
            && $this->_userinfo === false
            && $this->_scheme === false
        );
    }

    public static function removeDotSegments($path)
    {
        $path = (string) $path;
        $output = '';

        // Make sure not to be trapped in an infinite loop due to a bug in this
        // method
        $loopLimit = 256;
        $j = 0;
        while ('' !== $path && $j++ < $loopLimit) {
            if (substr($path, 0, 2) === './') {
                // Step 2.A
                $path = substr($path, 2);
            } elseif (substr($path, 0, 3) === '../') {
                // Step 2.A
                $path = substr($path, 3);
            } elseif (substr($path, 0, 3) === '/./' || $path === '/.') {
                // Step 2.B
                $path = '/' . substr($path, 3);
            } elseif (substr($path, 0, 4) === '/../' || $path === '/..') {
                // Step 2.C
                $path   = '/' . substr($path, 4);
                $i      = strrpos($output, '/');
                $output = $i === false ? '' : substr($output, 0, $i);
            } elseif ($path === '.' || $path === '..') {
                // Step 2.D
                $path = '';
            } else {
                // Step 2.E
                $i = strpos($path, '/', $path[0] === '/');
                if ($i === false) {
                    $output .= $path;
                    $path = '';
                    break;
                }
                $output .= substr($path, 0, $i);
                $path = substr($path, $i);
            }
        }

        if ($path !== '') {
            $message = sprintf(
                'Unable to remove dot segments; hit loop limit %d (left: %s)',
                $j, var_export($path, true)
            );
            trigger_error($message, E_USER_WARNING);
        }

        return $output;
    }

    public static function urlencode($string)
    {
        $encoded = rawurlencode($string);

        // This is only necessary in PHP < 5.3.
        $encoded = str_replace('%7E', '~', $encoded);
        return $encoded;
    }

    public static function getCanonical()
    {
        if (!isset($_SERVER['REQUEST_METHOD'])) {
            // ALERT - no current URL
            throw new Exception('Script was not called through a webserver');
        }

        // Begin with a relative URL
        $url = new self($_SERVER['PHP_SELF']);
        $url->_scheme = isset($_SERVER['HTTPS']) ? 'https' : 'http';
        $url->_host   = $_SERVER['SERVER_NAME'];
        $port = $_SERVER['SERVER_PORT'];
        if ($url->_scheme == 'http' && $port != 80
            || $url->_scheme == 'https' && $port != 443
        ) {
            $url->_port = $port;
        }
        return $url;
    }

    /**
     * Returns the URL used to retrieve the current request.
     *
     * @return  string
     */
    public static function getRequestedURL()
    {
        return self::getRequested()->getUrl();
    }

    /**
     * Returns a Net_URL2 instance representing the URL used to retrieve the
     * current request.
     *
     * @throws Exception
     * @return $this
     */
    public static function getRequested()
    {
        if (!isset($_SERVER['REQUEST_METHOD'])) {
            // ALERT - no current URL
            throw new Exception('Script was not called through a webserver');
        }

        // Begin with a relative URL
        $url = new self($_SERVER['REQUEST_URI']);
        $url->_scheme = isset($_SERVER['HTTPS']) ? 'https' : 'http';
        // Set host and possibly port
        $url->setAuthority($_SERVER['HTTP_HOST']);
        return $url;
    }

    /**
     * Returns the value of the specified option.
     *
     * @param string $optionName The name of the option to retrieve
     *
     * @return mixed
     */
    public function getOption($optionName)
    {
        return isset($this->_options[$optionName])
            ? $this->_options[$optionName] : false;
    }

    /**
     * A simple version of http_build_query in userland. The encoded string is
     * percentage encoded according to RFC 3986.
     *
     * @param array  $data      An array, which has to be converted into
     *                          QUERY_STRING. Anything is possible.
     * @param string $separator Separator {@link self::OPTION_SEPARATOR_OUTPUT}
     * @param string $key       For stacked values (arrays in an array).
     *
     * @return string
     */
    protected function buildQuery(array $data, $separator, $key = null)
    {
        $query = array();
        $drop_names = (
            $this->_options[self::OPTION_DROP_SEQUENCE] === true
            && array_keys($data) === array_keys(array_values($data))
        );
        foreach ($data as $name => $value) {
            if ($this->getOption(self::OPTION_ENCODE_KEYS) === true) {
                $name = rawurlencode($name);
            }
            if ($key !== null) {
                if ($this->getOption(self::OPTION_USE_BRACKETS) === true) {
                    $drop_names && $name = '';
                    $name = $key . '[' . $name . ']';
                } else {
                    $name = $key;
                }
            }
            if (is_array($value)) {
                $query[] = $this->buildQuery($value, $separator, $name);
            } else {
                $query[] = $name . '=' . rawurlencode($value);
            }
        }
        return implode($separator, $query);
    }

    /**
     * This method uses a regex to parse the url into the designated parts.
     *
     * @param string $url URL
     *
     * @return void
     * @uses   self::$_scheme, self::setAuthority(), self::$_path, self::$_query,
     *         self::$_fragment
     * @see    __construct
     */
    protected function parseUrl($url)
    {
        // The regular expression is copied verbatim from RFC 3986, appendix B.
        // The expression does not validate the URL but matches any string.
        preg_match(
            '(^(([^:/?#]+):)?(//([^/?#]*))?([^?#]*)(\?([^#]*))?(#(.*))?)',
            $url, $matches
        );

        // "path" is always present (possibly as an empty string); the rest
        // are optional.
        $this->_scheme   = !empty($matches[1]) ? $matches[2] : false;
        $this->setAuthority(!empty($matches[3]) ? $matches[4] : false);
        $this->_path     = $this->_encodeData($matches[5]);
        $this->_query    = !empty($matches[6])
                           ? $this->_encodeData($matches[7])
                           : false
            ;
        $this->_fragment = !empty($matches[8]) ? $matches[9] : false;
    }

    /**
     * Encode characters that might have been forgotten to encode when passing
     * in an URL. Applied onto Userinfo, Path and Query.
     *
     * @param string $url URL
     *
     * @return string
     * @see parseUrl
     * @see setAuthority
     * @link https://pear.php.net/bugs/bug.php?id=20425
     */
    private function _encodeData($url)
    {
        return preg_replace_callback(
            '([\x-\x20\x22\x3C\x3E\x7F-\xFF]+)',
            array($this, '_encodeCallback'), $url
        );
    }

    /**
     * callback for encoding character data
     *
     * @param array $matches Matches
     *
     * @return string
     * @see _encodeData
     * @SuppressWarnings(PHPMD.UnusedPrivateMethod)
     */
    private function _encodeCallback(array $matches)
    {
        return rawurlencode($matches[0]);
    }
}

require_once 'HTTP/Request2.php';

$request = new Http_Request2('https://api.projectoxford.ai/vision/v1.0/ocr');
$url = $request->getUrl();
$request->setConfig(array(
    'ssl_verify_peer'   => FALSE,
    'ssl_verify_host'   => FALSE
));
$headers = array(
    'Content-Type' => 'application/json',
    'Ocp-Apim-Subscription-Key' => '08b2055a83fc4a48af161df7ef13f80f',
);
$request->setHeader($headers);
$parameters = array(
    'language' => 'unk',
    'detectOrientation ' => 'true',
);

$url->setQueryVariables($parameters);
$request->setMethod(HTTP_Request2::METHOD_POST);
$request->setBody("{'Url':'http://wp.streetwise.co/wp-content/blogs.dir/2/files/2014/07/dc-drivers-license-630x407.jpg'}");

try
{
    $response = $request->send();
$rs1 = (string) $response->getBody();
$decode[] = json_decode($rs1, true);
$reg = $decode[0]["regions"];
for($i=0;$i<count($reg);$i++) {
$cnt = count($reg[$i]["lines"]);
for($l=0;$l<$cnt;$l++) {
for($m=0;$m<count($reg[$i]["lines"][$l]["words"]);$m++){
foreach($reg[$i]["lines"][$l]["words"] as $text) {
echo $text["text"]."<br/>";
}
}
}
}  
}
catch (HttpException $ex)
{
    echo $ex;
}
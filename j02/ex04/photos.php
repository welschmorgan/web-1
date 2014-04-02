#!/usr/bin/php
<?
	/**
	 * Get a web file (HTML, XHTML, XML, image, etc.) from a URL.  Return an
	 * array containing the HTTP server response header fields and content.
	 */
	function get_web_page( $url )
	{
		$user_agent='Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0';

		$options = array(

			CURLOPT_CUSTOMREQUEST  =>"GET",        //set request type post or get
			CURLOPT_POST           =>false,        //set to GET
			CURLOPT_USERAGENT      => $user_agent, //set user agent
			CURLOPT_COOKIEFILE     =>"cookie.txt", //set cookie file
			CURLOPT_COOKIEJAR      =>"cookie.txt", //set cookie jar
			CURLOPT_RETURNTRANSFER => true,     // return web page
			CURLOPT_HEADER         => false,    // don't return headers
			CURLOPT_FOLLOWLOCATION => true,     // follow redirects
			CURLOPT_ENCODING       => "",       // handle all encodings
			CURLOPT_AUTOREFERER    => true,     // set referer on redirect
			CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
			CURLOPT_TIMEOUT        => 120,      // timeout on response
			CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
		);

		$ch      = curl_init( $url );
		curl_setopt_array( $ch, $options );
		$content = curl_exec( $ch );
		$err     = curl_errno( $ch );
		$errmsg  = curl_error( $ch );
		$header  = curl_getinfo( $ch );
		curl_close( $ch );

		$header['errno']   = $err;
		$header['errmsg']  = $errmsg;
		$header['content'] = $content;
		return $header;
	}
	function crawl($url)
	{
		$d = './'.basename($url);
		if (!is_dir($d))
			mkdir($d);
		$result = get_web_page($url);

		if ( $result['errno'] != 0 )
			echo "error: bad url, timeout, redirect loop ...\n";

		if ( $result['http_code'] != 200 )
			echo "error:  no page, no permissions, no service ...\n";

		$page = $result['content'];
		$matches = null;
		$returnValue = preg_match_all('/<img.*?src=[\'|\"]+(.*?)[\'|\"]+.*?>/i', $page, $matches);
		foreach($matches[1] as $match)
		{
			if (!empty($match))
			{
				$name = basename($match);
				if (strpos($name, "?"))
					$name = explode('?', $name)[0];
				echo "Downloading '" . $name . "' ...\n";
				$content = get_web_page($match);
				if (!empty($content))
				{
					$hdl = fopen($d.'/'.$name, 'w');
					if ($hdl)
					{
						fwrite($hdl, serialize($content));
						fclose($hdl);
					}
				}
			}
		}
	}

	crawl("www.tf1.fr");
?>

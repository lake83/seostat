<?php

namespace Seostat;

class Curl
{
    /**
     * Получение данных
     * 
     * @param  $url запрашеваемый URL
     * @return string
     * @throws \ErrorException
     */
    public function exec($url = null)
    {
        if (!extension_loaded('curl')) {
            throw new \ErrorException('Библиотека cURL не подключена.');
        }
        $ch = curl_init();

	    curl_setopt($ch, CURLOPT_HEADER, 0);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_URL, $url);

	    $data = curl_exec($ch);
	    curl_close($ch);

	    return $data;
    }
}
?>
<?php

namespace Seostat;

use Seostat\Curl;

class Task
{
    /**
     * @var запрашеваемый URL по задаче 1
     */
    private $url1 = 'http://2eu.kiev.ua/get_ads.php';
    
    /**
     * @var запрашеваемый URL по задаче 2
     */
    private $url2 = 'http://2eu.kiev.ua/presidents.csv';
    
    /**
     * Задача 1
     *
     * @return array
     * @throws \ErrorException
     */
    public function first()
    {
        $curl = new Curl();
        $data = $curl->exec($this->url1);
        if (empty($data)) {
            throw new \ErrorException('Нет данных.');
        }
        $result = json_decode($data, true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \ErrorException('Ошибка данных.');
        }
        foreach ($result as $key => $row) {
            $price[$key]  = $row['price'];
            $weight[$key] = $row['weight'];
        }
        array_multisort($price, SORT_DESC, $weight, SORT_DESC, $result);

	    return array_splice($result, 0, 3);
    }
    
    /**
     * Задача 2
     *
     * @return integer
     * @throws \ErrorException
     */
    public function second()
    {
        $curl = new Curl();
        $data = $curl->exec($this->url2);
        if (empty($data)) {
            throw new \ErrorException('Нет данных.');
        }
        $result = array_chunk(str_getcsv($data), 5);
        $alive = [];
        $presidents = 0;
        for ($i = $result[1][2]; $i <= date('Y'); $i++) {
            foreach ($result as $president) {
                if ($president[2] <= $i && $i <= $president[4]) {
                    $presidents++;
                }
            }
            if ($presidents !== 0) {
                $alive[$i] = $presidents;
            }
            $presidents = 0;
        }
        return array_keys($alive, max($alive))[0];
    }
}
?>
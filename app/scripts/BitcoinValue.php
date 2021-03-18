<?php

namespace Bitcoin\Scripts;

use Phalcon\Exception;

class BitcoinValue
{
    public static function get($source)
    {

        $headers = @get_headers($source);

        if (@strpos($headers[0],'200') !== false) {
            $prices = json_decode(file_get_contents($source));
            if (isset($prices->bpi->EUR->rate) AND isset($prices->bpi->USD->rate)) {
                return $prices;
            } else { //page exists, wrong info
                throw new Exception("Požadované informace nebyly nalezeny!");
            }
        } else { //page does not exist
            throw new Exception("Požadovaná stránka nebyla nalezena!");
        }
    }
}

 ?>

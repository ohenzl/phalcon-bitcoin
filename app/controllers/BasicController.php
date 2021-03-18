<?php

use Phalcon\Mvc\Controller;
use Phalcon\Config\ConfigFactory;
use Phalcon\Assets\Asset\Css;
use Phalcon\Exception;
use Bitcoin\Scripts\BitcoinValue;

class BasicController extends Controller
{
    public function indexAction()
    {


      $this->view->error_msg = '';
      $this->view->reload_time = $config->app->reload_time;

      //load css
      $this->assets->addCss('/css/exchange.css');

      //get API source
      $fileName = APP_PATH . '/settings/config.php';
      $factory  = new ConfigFactory();
      $config = $factory->load($fileName);

      //get data from API
      try {
          $prices = BitcoinValue::get($config->app->source);
      }
      catch(Exception $e) {
          $prices->bpi->USD->rate = '?';
          $prices->bpi->EUR->rate = '?';
          $this->view->error_msg  = 'Message: ' .$e->getMessage();
      }

      $this->view->prices = $prices->bpi;

    }

}

?>

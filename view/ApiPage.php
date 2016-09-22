<?php
require_once __dir__.'/PageInterface.php';

/**
 * Description of ApiPage
 *
 * @author Gianni
 */
class ApiPage implements PageInterface {
  public function show($title = NULL, $file = NULL) {
    echo $title;
  }

}

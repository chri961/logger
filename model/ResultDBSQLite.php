<?php
require_once __DIR__.'/ResultDB.php';

/**
 * Description of ResultDBSQLite
 *
 * @author ragno
 */
class ResultDBSQLite extends ResultDB {
    function fetch_assoc(){
          return $this->res->fetchArray(SQLITE3_ASSOC);
    }
    public function reset() {
        $this->res->reset();
    }

}

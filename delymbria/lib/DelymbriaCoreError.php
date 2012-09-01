<?php
/**
 * More will follow here
 *
 * @author Seonnyn
 * @version 0.1a1
 */
class DelymbriaCoreError {
    protected $_error_id;   // Will store the thrown Error ID \ optional
    protected $_message;    // Will store the Error message \ optional
    
    public function __construct ($eid = null, $emsg = null) 
    {
        if($eid == null && $emsg == null) {
            $this->_error_id = 0;
            $this->_message  = "No Error specified";
        } elseif ($emsg != null) {
            $this->_error_id = 0;
            $this->_message = $emsg;
        } elseif($eid != null) { // If ID for Construction isn't Null the $msg
                                 // will be ignored
            $this->_error_id = $eid;
            $this->_message = $this->findErrorMsgById($this->_error_id);
        }
    }
    
    public function __destruct ()
    {
        $this->_error_id = null;
        $this->_message  = null;
    }
    
    protected function findErrorMsgById($id)
    {
        // This Function will find Messages for given IDs
        $errarr = parse_ini_file("DelymbriaErrors.ini");
        
        if(isset($errarr[$id])) {
            return $errarr[$id];
        } else {
            return "ERROR: There is no correspondig Message to the given ID: ".$id;
        }
        
    }
    
    public function getErrId()
    {
        return $this->_error_id;
    }
    
    public function getErrMsg()
    {
        return $this->_message;
    }
}

?>

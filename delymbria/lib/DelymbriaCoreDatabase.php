<?php

require_once 'DelymbriaCore.php';

class DelymbriaCoreDatabase extends DelymbriaCore 
{
    private $_host;
    private $_db;
    private $_user;
    private $_pass;
    private $_inst;
    
    public function __construct($db = null)
    {
        parent::__construct();
        setHost($this->_coredb["host"]);
        setUser($this->_coredb["user"]);
        setPass($this->_coredb["pass"]);
           
        $this->_inst = mysql_connect($this->_host, $this->_user, $this->_pass);
           
        if(!$this->_inst) {
            $this->addError(new DelymbriaCoreError(6) );
        }
        if($db != null) {
            $back = $this->setDb($db);
            if($back) {
                
            } else {
                $this->addError(new DelymbriaCoreError(7) );
            }
        }
    }
    
    protected function setHost($data)
    {
        $this->_host = $data;
    }
    
    public function getHost()
    {
        return $this->_host;
    }
    
    protected function setUser($data)
    {
        $this->_user = $data;
    }
    
    public function getUser()
    {
        return $this->_user;
    }
    
    protected function setPass($data)
    {
        $this->_pass = $data;
    }
    
    private function getPass()
    {
        return $this->_pass;
    }
    
    protected function setDb($data)
    {
        if(!$this->_inst) {
            return false;
        } else {
            $this->_db = $data;
            $this->_inst = mysql_select_db($this->_db);
            if($this->_inst) {
                return true;
            } else {
                return false;
            }
        }
    }
    
    protected function getDb()
    {
        return $this->_db;
    }
}

<?php

/**
 * This will be the main Core Class storing version informations for all sub
 * projects and will be the extension Class for all other Core Classes
 *
 * @author Seonnyn
 * @version 0.1a1
 */
require_once 'DelymbriaCoreError.php';

/**
 * Deep Main Core for all Delymbria Tools and the Game
 */
class DelymbriaCore 
{
    /**
     * Stores informations about the Core - Database
     * @var array 
     */
    protected $_coredb;
    /**
     * Stores the version for the Main Core
     * @var array 
     */
    protected $_maincore;
    /**
     * Stores Version and Language information about the homepage
     * @var array 
     */
    protected $_homepage;
    /**
     * Stores Version and Language information about the Game
     * @var array 
     */
    protected $_game;
    /**
     * Stores Version and Language information about the Forum
     * @var array 
     */
    protected $_forum;
    /**
     * Stores Version and Language information about the Admin and Support
     * Center
     * @var array 
     */
    protected $_asc;
    /**
     * Stores Version and Language Information about the Wiki Software
     * @var array 
     */
    protected $_wiki;
    /**
     * Stores Version and Language information for the translation software
     * @var array 
     */
    protected $_translation;
    /**
     *  Stores information about the INI-File
     * @var string 
     */
    private   $_ini_file;
    /**
     * Stores the data from the INI-File
     * @var array 
     */
    protected $_ini_array;
    /**
     * Stores information about the config-file
     * LATER: When the File does not exists or is empty it need to be redirected
     * to the installation
     * @var string 
     */
    private   $_config;
    /**
     * Stores the data out of the config file
     * @var array 
     */
    protected $_config_array;
    /**
     * Stores all Error Messages thrown out by this class
     * @var array 
     */
    public    $_error;
    
    public function __construct ()
    {
        // Set Config and Ini File
        $this->setConfigFile("DelymbriaConfig.ini");
        // First check for the availability of the Config File
        if($this->checkIniFile($this->_config) ) {
            $this->_config_array = parse_ini_file($this->_config, TRUE);
            $this->setDbData($this->_config_array["database"]);
            $this->setIniFile($this->_config_array["coreinfos"]["inifiles"]);
            // Check for the availability of the INI File
            if($this->checkIniFile($this->_ini_file) ) {
                $this->_ini_array = parse_ini_file($this->_ini_file, TRUE);
                $this->setCoreData($this->_ini_array["Delymbria:core"]);
                $this->setGameData($this->_ini_array["Delymbria:game"]);
                $this->setASCData($this->_ini_array["Delymbria:asc"]);
                $this->setHomepageData($this->_ini_array["Delymbria:hp"]);
                $this->setForumData($this->_ini_array["Delymbria:forum"]);
                $this->setTranslationData($this->_ini_array["Delymbria:translation"]);
                $this->setWikiData($this->_ini_array["Delymbria:wiki"]);
            } else {
                // Set Error Message
                $this->addError(new DelymbriaCoreError(5) );
            }
        } else {
            // Set Error Message
            $this->addError(new DelymbriaCoreError(4) );
        }
    }
    
    /**
     * sets the database datas for the core (maybe will not work with other
     * projects of delymbria as this is just for the Main-Core)
     * @param array $dbdata
     */
    private function setDbData($dbdata)
    {
        $this->_coredb["host"] = $dbdata["host"];
        $this->_coredb["user"] = $dbdata["user"];
        $this->_coredb["pass"] = $dbdata["pass"];
    }
    
    /**
     * sets the inifile variable for the object out of the String given to
     * the function
     * @param string $inifile
     */
    private function setIniFile($inifile)
    {
        $this->_ini_file = $inifile;
    }
    
    /**
     * sets the config file variable for the object out of the string given to
     * the function
     * @param string $conffile
     */
    private function setConfigFile($conffile)
    {
        $this->_config = $conffile;
    }
    
    /**
     * checks whether the config file is there
     * @return boolean
     */
    private function checkIniFile($file_name)
    {
        $file = parse_ini_file($file_name);
        if(isset($file) ) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Sets all needed data for the main-core
     * @param array $data
     */
    private function setCoreData($data)
    {
        $this->_maincore["version"] = $data["version"];
    }
    
    /**
     * Gives back all Datas for the Main-Core
     * @return array
     */
    public function getCoreData()
    {
        return $this->_maincore;
    }
    
    /**
     * Sets all needed data for the Game-Core
     * @param array $data
     */
    private function setGameData($data)
    {
        $this->_game["version"] = $data["version"];
        $this->_game["langs"]   = $data["langs"];
    }
    
    /**
     * Gives back all datas for the Game-Core
     * @return array
     */
    public function getGameData()
    {
        return $this->_game;
    }
    
    /**
     * Sets all needed data for the Admin and Support Center-Core
     * @param array $data
     */
    private function setASCData($data)
    {
        $this->_asc["version"] = $data["version"];
        $this->_asc["langs"]   = $data["langs"];
    }
    
    /**
     * Gives back all datas for the ASC-Core
     * @return array
     */
    public function getASCData()
    {
        return $this->_asc;
    }
    
    /**
     * Sets all needed data for the Homepage-Core
     * @param array $data
     */
    private function setHomepageData($data)
    {
        $this->_homepage["version"] = $data["version"];
        $this->_homepage["langs"]   = $data["langs"];
    }
    
    /**
     * Gives back all datas for the Homepage
     * @return array
     */
    public function getHomepageData()
    {
        return $this->_homepage;
    }
    
    /**
     * Sets all needed data for the Forum-Core
     * @param array $data
     */
    private function setForumData($data)
    {
        $this->_forum["version"] = $data["version"];
        $this->_forum["langs"]   = $data["langs"];
    }
    
    /**
     * Gives back all datas for the Forum
     * @return array
     */
    public function getForumData()
    {
        return $this->_forum;
    }
    
    /**
     * Sets all needed data for the Translation-Tool-Core
     * @param array $data
     */
    private function setTranslationData($data)
    {
        $this->_translation["version"] = $data["version"];
        $this->_translation["langs"]   = $data["langs"];
    }
    
    /**
     * Gives back all datas for the Translation Software
     * @return array
     */
    public function getTranslationData()
    {
        return $this->_translation;
    }
    
    /**
     * Sets all needed data for the Wiki-Core
     * @param array $data
     */
    private function setWikiData($data)
    {
        $this->_wiki["version"] = $data["version"];
        $this->_wiki["langs"]   = $data["langs"];
    }
    
    /**
     * Gives back all datas for the Wiki Software
     * @return array
     */
    public function getWikiData()
    {
        return $this->_wiki;
    }
    
    /**
     * Adds an Error - Message with ID and Message to the Error Array     * 
     * @param DelymbriaCoreError $error
     */
    public function addError(DelymbriaCoreError $error)
    {
        $this->_error[]["id"] = $error->getEId();
        $this->_error[]["msg"]= $error->getErrMsg();
    }
    
    /**
     * Removes an Error out of the List by giving the ID
     * @param int $id
     */
    public function removeError($id)
    {
        $this->_error[$id] = null;
    }
    
    /**
     * Gives back all errors as an array with the Error Messages
     * @return type
     */
    public function listErrors()
    {
        return $this->_error;
    }
}
<?php

/**
 * This will be the main Core Class storing version informations for all sub
 * projects and will be the extension Class for all other Core Classes
 *
 * @author Seonnyn
 * @version 0.1a1
 */
require_once 'DelymbriaCoreError.php';

class DelymbriaCore {
    protected $_coredb;     // Will store the Core-Database informations
    protected $_maincore;   // Will store the version for the Main Core
    protected $_homepage;   // Will store the version and language informations
                            // for the homepage
    protected $_game;       // Will store the version and language informations
                            // for the game
    protected $_forum;      // Will store the version and language informations
                            // for the forum software
    protected $_asc;        // Will store the version and language informations
                            // for the admin and support center
    protected $_wiki;       // Will store the version and language informations
                            // for the wiki software
    protected $_translation;// Will store the version and language informations
                            // for the translation software
    private   $_ini_file;   // Will store informations about the ini-file
    private   $_config;     // Will store the informations about the Config-File
                            // Later: When the File does not exists or is empty
                            // There will be a redirect to an installation
    public    $_error;      // Will store all Error Messages thrown by this class
    
    public function __construct ()
    {
        // Set Config and Ini File
        $this->setConfigFile("DelymbriaConfig.ini");
        // First check for the availability of the Config File
        if($this->checkConfigFile() ) {
            $confarray = parse_ini_file($this->_config);
            $this->setDbData($confarray["database"]);
            $this->setIniFile($confarray["coreinfos"]["inifiles"]);
            // Check for the availability of the INI File
            if($this->checkIniFile() ) {
                $iniarray = parse_ini_file($this->_ini_file);
                $this->setCoreData($iniarray["Delymbria:core"]);
                $this->setGameData($iniarray["Delymbria:game"]);
                $this->setASCData($iniarray["Delymbria:asc"]);
                $this->setHomepageData($iniarray["Delymbria:hp"]);
                $this->setForumData($iniarray["Delymbria:forum"]);
                $this->setTranslationData($iniarray["Delymbria:translation"]);
                $this->setWikiData($iniarray["Delymbria:wiki"]);
            } else {
                // Set Error Message
                $this->addError(new DelymbriaCoreError(5) );
            }
        } else {
            // Set Error Message
            $this->addError(new DelymbriaCoreError(4) );
        }
    }
    
    private function setDbData($dbdata)
    {
        $this->_coredb->host = $dbdata["host"];
        $this->_coredb->user = $dbdata["user"];
        $this->_coredb->pass = $dbdata["pass"];
    }
    
    private function setIniFile($inifile)
    {
        $this->_ini_file = $inifile;
    }
    
    private function setConfigFile($conffile)
    {
        $this->_config = $conffile;
    }
    
    private function checkConfigFile()
    {
        $file = parse_ini_file($this->_config);
        if(isset($file) ) {
            return true;
        } else {
            return false;
        }
    }
    
    private function setCoreData($data)
    {
        $this->_maincore["version"] = $data["version"];
    }
    
    private function setGameData($data)
    {
        $this->_game["version"] = $data["version"];
        $this->_game["langs"]   = $data["langs"];
    }
    
    private function setASCData($data)
    {
        $this->_asc["version"] = $data["version"];
        $this->_asc["langs"]   = $data["langs"];
    }
    
    private function setHomepageData($data)
    {
        $this->_homepage["version"] = $data["version"];
        $this->_homepage["langs"]   = $data["langs"];
    }
    
    private function setForumData($data)
    {
        $this->_forum["version"] = $data["version"];
        $this->_forum["langs"]   = $data["langs"];
    }
    
    private function setTranslationData($data)
    {
        $this->_translation["version"] = $data["version"];
        $this->_translation["langs"]   = $data["langs"];
    }
    
    private function setWikiData($data)
    {
        $this->_wiki["version"] = $data["version"];
        $this->_wiki["langs"]   = $data["langs"];
    }
    
    public function addError(DelymbriaCoreError $error)
    {
        $this->_error[] = "Error ID: ".$error->getEId()." Message: ".$error->getErrMsg()."...";
    }
}
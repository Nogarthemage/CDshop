<?php

namespace CDshop;

use Exception;

class Errorlog
{

    const ERROR_FILE = "log/SiteErrors.log";
    private $errno;
    private $errMsg;
    private $errFile;
    private $errLine;

    public function getErrno()
    {
        return $this->errno;
    }
    public function setErrno($errno)
    {
        $this->errno = $errno;

        return $this;
    }


    public function getErrMsg()
    {
        return $this->errMsg;
    }

    public function setErrMsg($errMsg)
    {
        $this->errMsg = $errMsg;

        return $this;
    }

    public function getErrFile()
    {
        return $this->errFile;
    }

    public function setErrFile($errFile)
    {
        $this->errFile = $errFile;

        return $this;
    }

    public function getErrLine()
    {
        return $this->errLine;
    }
    public function setErrLine($errLine)
    {
        $this->errLine = $errLine;

        return $this;
    }

    public function writeError($e) {

        $this->setErrno($e->getCode());
        $this->setErrMsg($e->getMessage());
        $this->setErrFile($e->getFile());
        $this->setErrLine($e->getLine());

        $error = "Error logged: " . date("Y-m-d H:i:s - ");
        $error .= "[ " . $this->errno . " ]: ";
        $error .= $this->errMsg;
        $error .= " in file " . $this->errFile;
        $error .= " on line " . $this->errLine ."\n";
        // Log details of error in a file
        error_log($error, 3, self::ERROR_FILE);
    }




}

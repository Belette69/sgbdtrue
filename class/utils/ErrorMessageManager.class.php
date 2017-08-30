<?php


namespace sgbdtrue\utils;


class ErrorMessageManager
{
    /**
     * @var ErrorMessageManager
     */
    private static $instance = null;


    private function __construct()
    {

    }

    /**
     * @return ErrorMessageManager
     */
    public static function getInstance()
    {
        if(self::$instance === null)
            self::$instance = new ErrorMessageManager();

        return self::$instance;

    }



    public function addErrorMessage($message)
    {
        if(!isset($_SESSION['error_messages'] ))
            $_SESSION['error_messages']  = array();
        $_SESSION['error_messages'][] = $message;
    }

    public function addSuccessMessage($message){
        if(!isset($_SESSION['success_messages'])){
            $_SESSION['success_messages'] = array();
        }
        $_SESSION['success_messages'][]=$message;
    }

    /**
     * @return array
     */
    public function getErrorMessageList()
    {
        if(!isset($_SESSION['error_messages']))
            return array();

        $messageList = $_SESSION['error_messages'];
        unset($_SESSION['error_messages']);

        return $messageList;

    }

    public function getSuccessMessageList()
    {
        if(!isset($_SESSION['success_messages']))
            return array();

        $messageList = $_SESSION['success_messages'];
        unset($_SESSION['success_messages']);

        return $messageList;

    }









}
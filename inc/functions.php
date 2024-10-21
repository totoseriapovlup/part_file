<?php

function index(){
    $messages = readErrorLogs();
    showDocument('index', [
        'messages' => $messages,
    ]);
}

function form(){
    showDocument('form');
}

function proc(){
    $message = filter_input(INPUT_POST, 'message');
    //TODO validate
//    if(!validate()){
//        writeErrorLog('form message is bad name ' . time());
//        setSessionMessage('Name must have');//for user
//    }
    writeErrorLog($message);
    redirect('/index.php');
}

/**
 * Redirect to url
 * @param string $url
 * @return never
 */
function redirect(string $url) : never
{
    header('Location: '.$url);
    exit();
}

/**
 * Show HTML
 * @param string $part
 * @param array $data
 */
function showDocument(string $partTemplate,array $data = []) : void
{
    extract($data);
    include_once TEMPLATE;
}

/**
 * Write log message to the file
 * @param string $message
 */
function writeErrorLog(string $message) : void
{
    $handle = fopen(LOG_FILE, 'a');//write and create if not exists
    if(!$handle){
        //TODO if not opened
        return;
    }
    fwrite($handle, $message . PHP_EOL);
    fclose($handle);
}

/**
 * Read all error logs
 * @return array
 */
function readErrorLogs() : array
{
    if(!file_exists(LOG_FILE)){
        return [];
    }
    $handle = fopen(LOG_FILE, 'r');
    if(!$handle){
        //TODO if not opened
        return[];
    }
    $messages = [];
    while (!feof($handle)){
        $str = fgets($handle);
        var_dump($str);
        if($str){
            $messages[] = $str;
        }
    }
    fclose($handle);
    return $messages;
}
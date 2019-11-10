<?php 

namespace Demo\PhpMvc\Services;

class LogService 
{

    private $file;
    
    public function __construct()
    {
        $this->file = $_SERVER['DOCUMENT_ROOT'].'\\src\\Demo\\PhpMvc\\Config\\system.log';
    }

    public static function generate($message, $level= 'info') 
    {
        $date = date('Y-m-d H:i:s');
        $message = sprintf( "[%s] [%s]: %s%s", $date, strtoupper($level), $message, PHP_EOL);
        file_put_contents($this->file, $message, FILE_APPEND);
    }
}

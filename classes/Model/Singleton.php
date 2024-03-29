<?php

class Singleton {
    
    private static $instances;
    
    protected function __construct()
    {}
    
    protected function __clone()
    {}
    
    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }
    
    public static function getInstance(): Singleton
    {
        $cls = static::class;
        
        if (!isset(static::$instances[$cls])) {
            static::$instances[$cls] = new static();
        }
        
        return static::$instances[$cls];
    }
}


?>
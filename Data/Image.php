<?php

namespace Data;

class Image extends Model
{
    
    public static $table = 'images';
    
    protected $name;
    
    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }
    
}
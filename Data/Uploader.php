<?php

namespace Data;

class Uploader extends Model
{
    
    public static $table = 'images';
    
    public $name;
    
    public function __construct(string $name)
    {
        $this->name = $name;
    }
    
    protected function isUploaded()
    {
        if (isset($_FILES[$this->name])) {
            if (0 == $_FILES[$this->name]['error']) {
                return true;
            }
        } else {
            return false;
        }
    }
    
    public function upload()
    {
        
        if ($this->isUploaded()) {
            move_uploaded_file($_FILES[$this->name]['tmp_name'],
                __DIR__ . '/../files/' . $_FILES[$this->name]['name']
            );
            $this->name = $_FILES[$this->name]['name'];
            
            $this->save();
            header('Location: /upload.php');
        }
        
    }
    
    public static function deleteImg($name)
    {
        self::deleteName($name);
        unlink(__DIR__ . '/../files/' . $name);
        header("Location: /upload.php");
    }
}
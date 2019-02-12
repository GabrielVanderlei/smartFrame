<?php
    #Load all MVC classes
   
    spl_autoload_register(function ($class_name) 
    { 
        $root = 'C:\xampp\htdocs';    
        $class_name = $class_name;
        
        #Directories
        $directorys = array(
            $root.'/controller/',
            $root.'/view/',
            $root.'/model/'
        );
        
        foreach($directorys as $directory)
        {
            if(file_exists($directory.$class_name.'.php'))
            {
                require $directory.$class_name.'.php';
                return;
            }            
        }
    });
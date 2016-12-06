<?php 
/**
 *
 * @package Administrator Module
 * @source CI - AdminLTE
 * @edited Vicky Nititnegoro 
 **/

if(!function_exists('active_link_controller'))
{
	function active_link_controller($controller)
	{
        $ci    =& get_instance();
        $class = $ci->router->fetch_class();

        return ($class == $controller) ? 'active highlight' : NULL;
	}
} 

/**
 * Edited
 **/
if(!function_exists('active_link_method'))
{
	function active_link_method($controller, $class_controller = FALSE)
	{
        $ci    =& get_instance();
        $method = $ci->router->fetch_method();
        $class  = $ci->router->fetch_class();

        if($class_controller !== FALSE)
        	return ($method == $controller && $class == $class_controller) ? 'active' : NULL;
        
        return ($method == $controller) ? 'active' : NULL;
	}
} 


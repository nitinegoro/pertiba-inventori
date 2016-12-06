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

        return ($class == $controller) ? 'active open ' : NULL;
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


/**
 * Membuat No Inventori Baru
 *
 * @param Integer
 * @return string
 **/
if(!function_exists('generate_inventori_number'))
{
    function generate_inventori_number($number = 0)
    {
        $string = "STIEINV".bulan_romawi(date('m')).date('dY');
        switch (strlen($number)) 
        {
            case 1: $number = '0000'.$number;  break;
            case 2: $number = '000'.$number; break;
            case 3: $number = '00'.$number; break;
            case 4: $number = '0'.$number; break;
            default: $number = $number; break;
        }
        return $string.$number;
    }
}

if (!function_exists('bulan_romawi')) 
{
    function bulan_romawi($bln)
    {
        switch ($bln) {
            case 1:
                return 'I';
                break;
            case 2:
                return 'II';
                break;
            case 3:
                return 'III';
                break;
            case 4:
                return 'IV';
                break;
            case 5:
                return 'V';
                break;
            case 6:
                return 'VI';
                break;
            case 7:
                return 'VII';
                break;
            case 8:
                return 'VIII';
                break;
            case 9:
                return 'IX';
                break;
            case 10:
                return 'X';
                break;
            case 11:
                return 'XI';
                break;
            case 12:
                return 'XII';
                break;
        }
    }
}
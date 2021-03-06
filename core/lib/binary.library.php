<?php
/**
 * category library.
 *
 * @package    dota 2 engine
 * @author     roozbeh baabakaan
 * @toDo       read https://github.com/roozbeh360/dota-2-engine
 */   
   
class binaryConvert{   

    // gets the lower 32-bits of a 64-bit steam id
    public static function make32bit($ID_64) 
    {
    	if(extension_loaded('gmp'))
    	{
    	$bits = "00000001000100000000000000000001" ;
        $upper = gmp_mul( bindec($bits) , "4294967296" );
        return gmp_strval(gmp_sub($ID_64,$upper));
		}
		else {
			 $communityId= $ID_64 - 76561197960265728 ;
			return $communityId ;
		}
    }

    // creates a 64-bit steam id from the lower 32-bits
    public static function make64bit( $ID_32, $hi = false ) 
    {
    	if(extension_loaded('gmp'))
		{
	        if ($hi === false) 
	        {
	        	$bits = "00000001000100000000000000000001";
	            $hi = bindec($bits);
	        }
	
	        // workaround signed/unsigned braindamage on x32
	        $hi = sprintf ( "%u", $hi );
	        $ID_32 = sprintf ( "%u", $ID_32 );
	
	        return gmp_strval ( gmp_add ( gmp_mul ( $hi, "4294967296" ), $ID_32 ) );     
		} 
		else {
			$steamId ='STEAM_0:'.$ID_32 ;
            $steamId = explode(':', substr($steamId, 3, strlen($steamId) - 1));
           $steamId = $steamId[0] + $steamId[1] + 1197960265728;
            return '7656' . $steamId;
		}
    }  
	
	 

 
    
}    
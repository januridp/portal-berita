<?php
#-----------------------------------------------------------------------
# LIB_http                                                              
#                                                                       
# F U N C T I O N S                                                     
#                                                                       
# http_get()                                                            
#    Fetches a file from the Internet with the HTTP protocol            
# http_header()                                                         
#    Same as http_get(), but only returns HTTP header instead of        
#    the normal file contents                                           
# http_get_form()                                                       
#    Submits a form with the GET method                                 
# http_get_form_withheader()                                            
#    Same as http_get_form(), but only returns HTTP header instead of   
#    the normal file contents                                           
# http_post_form()                                                      
#    Submits a form with the POST method                                
# http_post_withheader()                                                
#    Same as http_post_form(), but only returns HTTP header instead of  
#    the normal file contents                                           
# http_header()                                                         
#                                                                       
# http()                                                                
#   A common routine called by all of the previously described          
#   functions. You should always use one of the other wrappers for this 
#   routine and not call it directly.                                   
#                                                                       
#-----------------------------------------------------------------------
# R E T U R N E D   D A T A                                             
# All of these routines return a three dimensional array defined as     
# follows:	    												        
#    $return_array['FILE']   = Contents of fetched file, will also      
#                              include the HTTP header if requested    
#    $return_array['STATUS'] = CURL generated status of transfer        
#    $return_array['ERROR']  = CURL generated error status              
########################################################################

/***********************************************************************
Webbot defaults (scope = global)                                       
----------------------------------------------------------------------*/
# Define how your webbot will appear in server logs
define("WEBBOT_NAME", "Test Webbot");

# Length of time cURL will wait for a response (seconds)
define("CURL_TIMEOUT", 25);

# Location of your cookie file. (Must be fully resolved local address)
define("COOKIE_FILE", "c:\cookie.txt");

# DEFINE METHOD CONSTANTS
define("HEAD", "HEAD");
define("GET",  "GET");
define("POST", "POST");

# DEFINE HEADER INCLUSION
define("EXCL_HEAD", FALSE);
define("INCL_HEAD", TRUE);

/***********************************************************************
User interfaces         	                                            
-------------------------------------------------------------			
*/

/***********************************************************************
function http_get($target, $ref)                                        
-------------------------------------------------------------           
DESCRIPTION:                                                            
        Downloads an ASCII file without the http header                 
INPUT:                                                                  
        $target       The target file (to download)                     
        $ref          The server referer variable                       
OUTPUT:                                                                 
        $return_array['FILE']   = Contents of fetched file, will also   
                                 include the HTTP header if requested   
        $return_array['STATUS'] = CURL generated status of transfer     
        $return_array['ERROR']  = CURL generated error status           
***********************************************************************/
function http_get($target, $ref)
    {
    return http($target, $ref, $method="GET", $data_array="", EXCL_HEAD);
    }

/***********************************************************************
http_get_withheader($target, $ref)                                      
-------------------------------------------------------------           
DESCRIPTION:                                                            
        Downloads an ASCII file with the http header                    
INPUT:                                                                  
        $target       The target file (to download)                     
        $ref          The server referer variable                       
OUTPUT:                                                                 
        $return_array['FILE']   = Contents of fetched file, will also   
                                 include the HTTP header if requested   
        $return_array['STATUS'] = CURL generated status of transfer     
        $return_array['ERROR']  = CURL generated error status           
***********************************************************************/
function http_get_withheader($target, $ref)
    {
    return http($target, $ref, $method="GET", $data_array="", INCL_HEAD);
    }

/***********************************************************************
http_get_form($target, $ref, $data_array)                               
-------------------------------------------------------------           
DESCRIPTION:                                                            
        Submits a form with the GET method and downloads the page       
        (without a http header) referenced by the form's ACTION variable
INPUT:                                                                  
        $target       The target file (to download)                     
        $ref          The server referer variable                       
        $data_array   An array that defines the form variables          
                      (See "Webbots, Spiders, and Screen Scrapers" for  
                      more information about $data_array)               
OUTPUT:                                                                 
        $return_array['FILE']   = Contents of fetched file, will also   
                                 include the HTTP header if requested   
        $return_array['STATUS'] = CURL generated status of transfer     
        $return_array['ERROR']  = CURL generated error status           
***********************************************************************/
function http_get_form($target, $ref, $data_array)
    {
    return http($target, $ref, $method="GET", $data_array, EXCL_HEAD);
    }

/***********************************************************************
http_get_form_withheader($target, $ref, $data_array)                    
-------------------------------------------------------------           
DESCRIPTION:                                                            
        Submits a form with the GET method and downloads the page       
        (with http header) referenced by the form's ACTION variable     
INPUT:                                                                  
        $target       The target file (to download)                     
        $ref          The server referer variable                       
        $data_array   An array that defines the form variables          
                      (See "Webbots, Spiders, and Screen Scrapers" for  
                      more information about $data_array)               
OUTPUT:                                                                 
        $return_array['FILE']   = Contents of fetched file, will also   
                                 include the HTTP header if requested   
        $return_array['STATUS'] = CURL generated status of transfer     
        $return_array['ERROR']  = CURL generated error status           
***********************************************************************/
function http_get_form_withheader($target, $ref, $data_array)
    {
    return http($target, $ref, $method="GET", $data_array, INCL_HEAD);
    }

/***********************************************************************
http_post_form($target, $ref, $data_array)                              
-------------------------------------------------------------           
DESCRIPTION:                                                            
        Submits a form with the POST method and downloads the page      
        (without http header) referenced by the form's ACTION variable  
INPUT:                                                                  
        $target       The target file (to download)                     
        $ref          The server referer variable                       
        $data_array   An array that defines the form variables          
                      (See "Webbots, Spiders, and Screen Scrapers" for  
                      more information about $data_array)               
OUTPUT:                                                                 
        $return_array['FILE']   = Contents of fetched file, will also   
                                 include the HTTP header if requested   
        $return_array['STATUS'] = CURL generated status of transfer     
        $return_array['ERROR']  = CURL generated error status           
***********************************************************************/
function http_post_form($target, $ref, $data_array)
    {
    return http($target, $ref, $method="POST", $data_array, EXCL_HEAD);
    }

function http_post_withheader($target, $ref, $data_array)
    {
    return http($target, $ref, $method="POST", $data_array, INCL_HEAD);
    }

function http_header($target, $ref)
    {
    return http($target, $ref, $method="HEAD", $data_array="", INCL_HEAD);
    }

/***********************************************************************
http($url, $ref, $method, $data_array, $incl_head)                      
-------------------------------------------------------------			
DESCRIPTION:															
	This function returns a web page (HTML only) for a web page through	
	the execution of a simple HTTP GET request.							
	All HTTP redirects are automatically followed.						
                                                                        
    IT IS BEST TO USE ONE THE EARLIER DEFINED USER INTERFACES           
    FOR THIS FUNCTION                                                   
                                                                        
INPUTS:																	
	$target      Address of the target web site		 					
	$ref		 Address of the target web site's referrer				
	$method		 Defines request HTTP method; HEAD, GET or POST         
	$data_array	 A keyed array, containing query string                 
	$incl_head	 TRUE  = include http header                            
                 FALSE = don't include http header                      
                                                                        
RETURNS:																
    $return_array['FILE']   = Contents of fetched file, will also       
                              include the HTTP header if requested      
    $return_array['STATUS'] = CURL generated status of transfer         
    $return_array['ERROR']  = CURL generated error status               
***********************************************************************/
function http($target, $ref, $method, $data_array, $incl_head)
	{
    # Initialize PHP/CURL handle
	$ch = curl_init();

    # Prcess data, if presented
    if(is_array($data_array))
        {
	    # Convert data array into a query string (ie animal=dog&sport=baseball)
        foreach ($data_array as $key => $value) 
            {
            if(strlen(trim($value))>0)
                $temp_string[] = $key . "=" . urlencode($value);
            else
                $temp_string[] = $key;
            }
        $query_string = join('&', $temp_string);
        }
        
    # HEAD method configuration
    if($method == HEAD)
        {
    	curl_setopt($ch, CURLOPT_HEADER, TRUE);                // No http head
	    curl_setopt($ch, CURLOPT_NOBODY, TRUE);                // Return body
        }
    else
        {
        # GET method configuration
        if($method == GET)
            {
            if(isset($query_string))
                $target = $target . "?" . $query_string;
            curl_setopt ($ch, CURLOPT_HTTPGET, TRUE); 
            curl_setopt ($ch, CURLOPT_POST, FALSE); 
            }
        # POST method configuration
        if($method == POST)
            {
            if(isset($query_string))
                curl_setopt ($ch, CURLOPT_POSTFIELDS, $query_string);
            curl_setopt ($ch, CURLOPT_POST, TRUE); 
            curl_setopt ($ch, CURLOPT_HTTPGET, FALSE); 
            }
    	curl_setopt($ch, CURLOPT_HEADER, $incl_head);   // Include head as needed
	    curl_setopt($ch, CURLOPT_NOBODY, FALSE);        // Return body
        }
        
	curl_setopt($ch, CURLOPT_COOKIEJAR, COOKIE_FILE);   // Cookie management.
	curl_setopt($ch, CURLOPT_COOKIEFILE, COOKIE_FILE);
	curl_setopt($ch, CURLOPT_TIMEOUT, CURL_TIMEOUT);    // Timeout
	curl_setopt($ch, CURLOPT_USERAGENT, WEBBOT_NAME);   // Webbot name
	curl_setopt($ch, CURLOPT_URL, $target);             // Target site
	curl_setopt($ch, CURLOPT_REFERER, $ref);            // Referer value
	curl_setopt($ch, CURLOPT_VERBOSE, FALSE);           // Minimize logs
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);    // No certificate
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);     // Follow redirects
	curl_setopt($ch, CURLOPT_MAXREDIRS, 4);             // Limit redirections to four
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);     // Return in string
    
    # Create return array
    $return_array['FILE']   = curl_exec($ch); 
    $return_array['STATUS'] = curl_getinfo($ch);
    $return_array['ERROR']  = curl_error($ch);
    
    # Close PHP/CURL handle
  	curl_close($ch);
    
    # Return results
  	return $return_array;
    }
?>
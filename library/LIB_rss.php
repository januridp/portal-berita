<?php
/*
########################################################################
#                                                                       
# LIB_rss                                                               
#                                                                       
# This library provides routines useful when working with RSS feeds     
#                                                                       
#-----------------------------------------------------------------------
# FUNCTIONS                                                             
#                                                                       
# download_parse_rss($target)                                           
#		    Downloads and parses rss data                               
#                                                                       
# display_rss_array($rss_array)                                         
#		    Displays a parsed news feed                                 
#                                                                       
# strip_cdata_tags()                                                    
#           Removes cdata[] tags from strings                           
#                                                                       
#-----------------------------------------------------------------------

/***********************************************************************
download_parse_rss($target)     						                
-------------------------------------------------------------			
DESCRIPTION:															
		Downloads and parses a RSS web site                             
INPUT:																    
		$target                                                         
            The web address of the RSS feed                             
RETURNS:																
		The parsed RSS feed                                             
***********************************************************************/
function download_parse_rss($target)
    {
    # download tge rss page
    $news = http_get($target, "");
    
    # Parse title & copyright notice
    $rss_array['TITLE'] = return_between($news['FILE'], "<title>", "</title>", EXCL);
    $rss_array['COPYRIGHT'] = return_between($news['FILE'], "<copyright>", "</copyright>", EXCL);

    # Parse the items
    $item_array = parse_array($news['FILE'], "<item>", "</item>");
    for($xx=0; $xx<count($item_array); $xx++)
        {
        $rss_array['ITITLE'][$xx] = return_between($item_array[$xx], "<title>", "</title>", EXCL);
        $rss_array['ILINK'][$xx] = return_between($item_array[$xx], "<link>", "</link>", EXCL);
        $rss_array['IDESCRIPTION'][$xx] = return_between($item_array[$xx], "<description>", "</description>", EXCL);
        $rss_array['IPUBDATE'][$xx] = return_between($item_array[$xx], "<pubDate>", "</pubDate>", EXCL);
        }

    return $rss_array;
    }

/***********************************************************************
display_rss_array($rss_array)     						                
-------------------------------------------------------------			
DESCRIPTION:															
		Displays parsed RSS data                                        
INPUT:																    
		$target                                                         
            The web address of the RSS feed                             
RETURNS:																
		Sends results to the display device                             
***********************************************************************/
function display_rss_array($rss_array)
    {?>
        <!-- Display the article descriptions and links -->    
        <?php for($xx=0; $xx<count($rss_array['ITITLE']); $xx++)
            {?>
				<div class="grid_12 rss">
				<div class="text">
				<h1><a href="<?echo strip_cdata_tags($rss_array['ILINK'][$xx])?>" target="_blank">
				<?echo strip_cdata_tags($rss_array['ITITLE'][$xx]);?>
				</a></h1>
				<p><?php echo html_entity_decode(strip_cdata_tags($rss_array['IDESCRIPTION'][$xx]))?> 	<br />&#187;&#187; <span class="date"><?echo strip_cdata_tags($rss_array['IPUBDATE'][$xx])?></span></p>
				</div>
				</div>
          <?php }?>
    <?php }

/***********************************************************************
strip_cdata_tags($string)                                               
-------------------------------------------------------------			
DESCRIPTION:															
		Removes CDDATA tags from a string                               
                                                                        
INPUT:																    
		$string                                                         
            Text containing CDDATA tags                                 
RETURNS:																
		Returns a string free of CDDATA tags                            
***********************************************************************/
function strip_cdata_tags($string)
    {
    # Strip XML CDATA characters from all array elements
    $string = str_replace("<![CDATA[", "", $string);
    $string = str_replace("]]>", "", $string);
	$string = str_replace("&lt;p&gt;", "", $string);
	$string = str_replace('&lt;/p&gt;&lt;br clear="all"/&gt;', "", $string);
    return $string;
    }  
  ?>
  
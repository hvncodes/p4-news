<?php
/**
 * index.php along with survey_view.php provides a list/view application and a start to our survey app
 *
 * @package NewNews
 * @author John Nguyen <johnhvn94@gmail.com>
 * @version 0.4 2018/06/08
 * @link http://www.blanchefil.com/sp18/news/
 * @license https://www.apache.org/licenses/LICENSE-2.0
 * @see news_view.php
 * @todo none
 */

# '../' works for a sub-folder.  use './' for the root  
require '../inc_0700/config_inc.php'; #provides configuration, pathing, error handling, db credentials 

# SQL statement
$sql = 
"
SELECT 
cat.CategoryID, cat.Category, 
feed.FeedID, feed.URL, feed.Subcategory, 
feed.Description FROM p4_Categories AS cat, 
p4_Feeds AS feed WHERE 
cat.CategoryID = feed.CategoryID
";

#Fills <title> tag. If left empty will default to $PageTitle in config_inc.php  
$config->titleTag = 'News Feeds made with love & PHP in Seattle';

#Fills <meta> tags.  Currently we're adding to the existing meta tags in config_inc.php
$config->metaDescription = 'Seattle Central\'s ITC250 Class News Feeds are made with pure PHP! ' . $config->metaDescription;
$config->metaKeywords = 'PHP,Fun,XML,News,Feeds,RSS,' . $config->metaKeywords;

//adds font awesome icons for arrows on pager
$config->loadhead .= '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">';

# END CONFIG AREA ---------------------------------------------------------- 

get_header('newheader_inc.php'); #defaults to theme header or header_inc.php
echo '<h3 align="center">News Feeds</h3>';

#images in this case are from font awesome
$prev = '<i class="fa fa-chevron-circle-left"></i>';
$next = '<i class="fa fa-chevron-circle-right"></i>';

# Create instance of new 'pager' class
$myPager = new Pager(9,'',$prev,$next,'');
$sql = $myPager->loadSQL($sql);  #load SQL, add offset

# connection comes first in mysqli (improved) function
$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

if(mysqli_num_rows($result) > 0)
{#records exist - process
	if($myPager->showTotal()==1){$itemz = "feed";}else{$itemz = "feeds";}  //deal with plural
    echo '<div align="center">We have ' . $myPager->showTotal() . ' ' . $itemz . ' to choose from!</div>';
    
    echo '
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Feed</th>
                <th scope="col">Description</th>
                <th scope="col">URL</th>
                <th scope="col">CategoryID</th>
                <th scope="col">Category</th>
            </tr>
        </thead>
        <tbody>
    ';
    
	while($row = mysqli_fetch_assoc($result))
	{# process each row
        
        echo '
            <tr>
                <td><a href="' . VIRTUAL_PATH . 'news/news_view.php?id=' . (int)$row['FeedID'] . '">' . dbOut($row['Subcategory']) . '</a></td>
                <td>' . dbOut($row['Description']) . '</td>
                <td>' . dbOut($row['URL']) . '</td>
                <td>' . dbOut($row['CategoryID']) . '</td>
                <td>' . dbOut($row['Category']) . '</td>
            </tr>
        ';
	}
    
    echo '
        </tbody>
    </table>
    ';
    
	echo $myPager->showNAV(); # show paging nav, only if enough records	 
}else{#no records
    echo "<div align=center>There are currently no feeds.</div>";	
}
/*
echo 'PHYSICAL_PATH: ' . PHYSICAL_PATH . '<br>';
echo 'VIRTUAL_PATH: ' . VIRTUAL_PATH . '<br>';
echo 'THEME_PATH: ' . THEME_PATH . '<br>';
echo 'THEME_PHYSICAL: ' . THEME_PHYSICAL . '<br>';
*/
@mysqli_free_result($result);

get_footer('newfooter_inc.php'); #defaults to theme footer or footer_inc.php
?>

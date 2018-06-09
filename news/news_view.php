<?
/**
 * news_view.php along with index.php provides a list/view application 
 * for our NewNews objects 
 * 
 * Feed is our only object in NewNewz
 * 
 * @package NewNews
 * @author John Nguyen <johnhvn94@gmail.com>
 * @version 0.3 2018/06/09
 * @link http://www.blanchefil.com/sp18/news/
 * @license https://www.apache.org/licenses/LICENSE-2.0
 * @see index.php
 * @see Feed.php
 * @todo none
 */

require '../inc_0700/config_inc.php'; #provides configuration, pathing, error handling, db credentials
spl_autoload_register('MyAutoLoader::NamespaceLoader');//required to load NewNews namespace objects
$config->metaRobots = 'no index, no follow';#never index feed pages

# check variable of item passed in - if invalid data, forcibly redirect back to index.php page
if (isset($_GET['id']) && (int)$_GET['id'] > 0) {#proper data must be on querystring
	 $myID = (int)$_GET['id']; #Convert to integer, will equate to zero if fails
} else {
	myRedirect(VIRTUAL_PATH . "news/index.php");
}

$myFeed = new NewNews\Feed($myID);

if ($myFeed->isValid) {
	$config->titleTag = "'" . $myFeed->Subcategory . "' Feed!";
} else {
	$config->titleTag = smartTitle(); //use constant 
}

//10 minutes in seconds
$time_limit = 600; 
ini_set('session.gc_maxlifetime', $time_limit);

#A fix to: A session had already been started - ignoring session_start()
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION['Feed#' . $myID]) && (time() - $_SESSION['Feed#' . $myID] > $time_limit)) {
    //last request was more than 10 minutes ago
    session_unset();
    session_destroy();
}

#https://stackoverflow.com/questions/37073710/storing-xml-value-to-a-session-variable
if (isset($_SESSION['Feed#' . $myID])) {
    //session already set, extract from session
    $xml = simplexml_load_string($_SESSION['Feed#' . $myID]);
} else {
    //set session, extract from url
    #$_SESSION['Feed . $myID'] = time();//Update session
    $request = $myFeed->URL;
    $response = file_get_contents($request);
    $xml = simplexml_load_string($response);
    $_SESSION['Feed#' . $myID] = $xml->asXML();
}

get_header('newheader_inc.php'); #defaults to theme header or header_inc.php

echo '<h3>'.$myFeed->Title.'</h3>';

if ($myFeed->isValid) { #check to see if we have a valid SurveyID
	echo '<p>' . $myFeed->Description . '</p>';
    echo '<h1>' . $xml->channel->title . '</h1>';
    foreach($xml->channel->item as $story)
    {
        echo '<a href="' . $story->link . '">' . $story->title . '</a><br />'; 
        echo '<p>' . $story->description . '</p><br /><br />';
    }
    
} else {
	echo "Sorry, no such feed!<br>";
    echo '$myID: '.$myID.'<br>';
    echo '$myFeed\'s ID: '.$myFeed->FeedID.'<br>';
    echo '$myFeed\'s valid?: '.$myFeed->isValid.'<br>';
    echo '$xml: '.$xml.'<br>';
}

get_footer('newfooter_inc.php'); #defaults to theme footer or footer_inc.php
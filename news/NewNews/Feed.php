<?php
//Feed.php
namespace NewNews;

class Feed
{
    public $FeedID = 0;
    public $Category = "";
    public $isValid = FALSE;
    public $URL = "";
    public $Subcategory = "";
    public $Title = "";
    public $Description = "";
    
    public function __construct($id)
    {
        $this->FeedID = (int)$id;
        if ($this->FeedID == 0) {
            return FALSE;
        }
        
        #get Feed information from database
        $sql = sprintf("SELECT p4_Categories.CategoryID,
        p4_Categories.Category,
        p4_Feeds.FeedID,
        p4_Feeds.URL,
        p4_Feeds.Subcategory,
        p4_Feeds.Description 
        FROM p4_Categories 
        INNER JOIN p4_Feeds ON 
        p4_Categories.CategoryID = p4_Feeds.CategoryID 
        WHERE FeedID = " . $this->FeedID);
        
        #connect
        $result = mysqli_query(\IDB::conn(),$sql) or die(trigger_error(mysqli_error(\IDB::conn()), E_USER_ERROR));
        
        if (mysqli_num_rows($result) > 0) {#must be a valid Feed
            $this->isValid = TRUE;
            while ($row = mysqli_fetch_assoc($result)) {
                $this->Category = dbOut($row['Category']);
                $this->URL = dbOut($row['URL']);
                $this->Subcategory = dbOut($row['Subcategory']);
                $this->Description = dbOut($row['Description']);
            }
        }
    }//end Feed() Constructor 
}//end Feed Class
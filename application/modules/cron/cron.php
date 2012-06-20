<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cron extends MX_Controller {
    function __construct(){
        // Call the Model constructor
        parent::__construct();
        /**
         * only allow CLI requests, exit if the request is not a CLI.
         */
        if ( !$this->input->is_cli_request() ){ die("error"); }
    }

    /**
     * cron task to count the amount of items per category
     * and update the table `map_categories` with the count. 
     * Reference the @crontask below to see the interval & 
     * command that is ran.
     * 
     * @crontask  * 2 * * * php DOC_ROOT/index.php cron processCategoryItemCount
     * @copyright 2012 MapIt USA
     * @author Mike DeVita
     */
    public function processCategoryItemCount(){
        echo 'hi2';
        $this->load->model('map_categories', 'mapCategories');
        $categoryCount = $this->mapCategories->getCategoryCount();
        $this->mapCategories->processCategoryCount($categoryCount);
        echo 'success';
    }
    
    /**
     * cront task to clear all db cache on a set interval
     * period. This will help minimize errors with data changes.
     * 
     * @crontask 15 * * * * php DOC_ROOT/index.php cron clearDbCache
     * @copyright 2012 MapIt USA
     * @author Mike DeVita <mdevita@fivepints.com>
     */
    public function clearDbCache(){
        $this->db->cache_delete_all();
        exit(1);
    }

}
?>
<?php
/**
 * This is the Crontasks library
 * this is what actually does the heavy
 * lifting of the automated tasks.
 * The reason for splitting the controller
 * into this library is so that this library can be accessed
 * via both web and CLI, but restricted to certain
 * areas of web.
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Crontasks {
    var $CI;

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
        $CI =& get_instance();
        $CI->load->model('cron_model');
        $CI->load->model('map_categories', 'mapCategories');

        $categoryCount = $CI->mapCategories->getCategoryCount();
        if($categoryCount){
            if( $CI->mapCategories->processCategoryCount($categoryCount) ){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    /**
     * cron task to cleanup the uploads
     * directory.
     *
     * @crontask * 0 * * * php DOC_ROOT/index.php cron clearStaleUploads
     * @copyright 2012 MapIt USA
     * @author Mike DeVita <mdevita@fivepints.com>
     */
    public function clearStaleUploads(){
        $CI =& get_instance();
        $CI->load->model('cron_model');
        $CI->load->model('map_userfields');
        $CI->load->model('map_points');

        $CI->load->helper('directory');
        $CI->load->helper('file');

        $uploads = directory_map('uploads/');
        foreach( $uploads as $uK => $uV){
            $logoNames = $CI->map_userfields->getLogoNames($uK);
            if($logoNames != FALSE){
                foreach($uV as $u){
                    if($u != $logoNames[0]->fieldvalue){
                        unlink('uploads/'.$uK.'/'.$u);
                    }
                }
            }else{
                delete_files('uploads/'.$uK.'/');
                rmdir('uploads/'.$uK);
            }
        }
    }
    /**
     * cron task to count the amount of events per
     * category and update the table `map_categories`
     * with the count. Reference the @crontask below to
     * see the interval & command that is ran.
     *
     * @crontaskk * 2 * * * php DOC_ROOT/index.php cron processCategoryEventCount
     * @copyright 2012 MapIt USA
     * @author Mike DeVita <mdevita@fivepints.com>
     */
    public function processCategoryEventCount(){
        $CI =& get_instance();
        $CI->load->model('cron_model');
        $CI->load->model('map_categories', 'mapCategories');
        $CI->load->model('map_points');
        $eventPoints = $CI->map_points->getEventPoints();
        if ($eventPoints){
            foreach ($eventPoints as $k => $v){
                $eP[] = $v['id'];
            }
            $eventCategoryCount = $CI->mapCategories->getCategoryCount($eP, 'eventCount');

            if($eventCategoryCount){
               if( $CI->mapCategories->processCategoryCount($eventCategoryCount) ){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }else{
            return false;
        }

    }
    /**
     * cron task to count the amount of deals per
     * category and update the table `map_categories`
     * with the count. Reference the @crontask below to
     * see the interval & command that is ran.
     *
     * @crontaskk * 2 * * * php DOC_ROOT/index.php cron processCategoryDealCount
     * @copyright 2012 MapIt USA
     * @author Mike DeVita <mdevita@fivepints.com>
     */
    public function processCategoryDealCount(){
        $CI =& get_instance();
        $CI->load->model('cron_model');
        $CI->load->model('map_categories', 'mapCategories');
        $CI->load->model('map_points');

        $dealPoints = $CI->map_points->getDealPoints();
        if ($dealPoints){
            foreach ($dealPoints as $k => $v){
                $dP[] = $v['id'];
            }
            $dealCategoryCount = $CI->mapCategories->getCategoryCount($dP, 'dealCount');

            if($dealCategoryCount){
               if( $CI->mapCategories->processCategoryCount($dealCategoryCount) ){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }else{
            return false;
        }
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
        $CI =& get_instance();
        $CI->load->model('cron_model');
        $CI->db->cache_delete_all();
        if( $CI->cron_model->updateRunCount(2) ){
            return true;
        }else{
            return false;
        }
    }
    /**
     * cron task to clear log files that are
     * older than 2 days
     *
     * @crontask * 0 * * * php DOC_ROOT/index.php cron clearAppLogs
     * @copyright 2012 MapIt USA
     * @author Mike DeVita <mdevita@fivepints.com>
     */
    public function clearAppLogs(){
        $CI =& get_instance();
        $CI->load->helper('directory');
        $CI->load->helper('file');

        $logs = directory_map(APPPATH.'logs');

        $logLimit = new DateTime("-2 day");
        $logLimit = $logLimit->format("Y-m-d");
        $i = 0;

        foreach ($logs as $l):
            $info = get_file_info(APPPATH.'logs/'.$l);
            $logDate = new DateTime();
            $logDate->setTimestamp($info['date']);
            $logDate = $logDate->format("Y-m-d")."<br>";
            if($logDate <= $logLimit){
                if( unlink(APPPATH.'logs/'.$info['name']) ){
                    $i++;
                }
            }
        endforeach;

        return $i;
    }
}
?>
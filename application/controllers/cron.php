<?php
/**
 * This is the CLI Cron Controller
 * This controller is used by crontab to
 * automate several features within the
 * application.
 *
 * This Controller references a library
 * which actually handles the processing
 * of the cron tasks.
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cron extends CI_Controller {
    function __construct(){
        // Call the Model constructor
        parent::__construct();
        $this->load->library('crontasks');
        /** only allow CLI requests, exit if the request is not a CLI. */
        if ( !$this->input->is_cli_request() ){ die("error"); }
    }
    /**
     * cron task to cleanup the uploads
     * directory.
     *
     * @copyright 2012 MapIt USA
     * @author Mike DeVita <mdevita@fivepints.com>
     */
    public function clearStaleUploads(){
        $this->load->library('crontasks');
        $this->crontasks->clearStaleUploads();
    }
    /**
     * cron task to clear log files that are
     * older than 2 days
     *
     * @copyright 2012 MapIt USA
     * @author Mike DeVita <mdevita@fivepints.com>
     */
    public function clearAppLogs(){
        $deletedLogCount = $this->crontasks->clearAppLogs();
        echo "Deleted ".$deletedLogCount.' files';
    }
    /**
     * cron task to count all categorires which have
     * a point assigned to them.
     *
     * @copyright 2012 MapIt USA
     * @author Mike DeVita <mdevita@fivepints.com>
     */
    public function processCategoryItemCount(){
        if( $this->crontasks->processCategoryItemCount() ){
            echo 'successfully edited item counts';
        }else{
            echo 'unable to edit item counts';
        }
    }
    /**
     * cron task to clear all db cache on a set interval
     * period. This will help minimize errors with data changes.
     *
     * @copyright 2012 MapIt USA
     * @author Mike DeVita <mdevita@fivepints.com>
     */
    public function clearDbCache(){
        if( $this->crontasks->clearDbCache() ){
            echo 'successfully deleted the db cache';
        }else{
            echo 'unable to clear db cache';
        }
    }
    /**
     * cron task to count all categories which have
     * a point with promotions content.
     *
     * @copyright 2012 MapIt USA
     * @author Mike DeVita <mdevita@fivepints.com>
     */
    public function processCategoryDealCount(){
        if( $this->crontasks->processCategoryDealCount() ){
            echo 'successfully edited item counts';
        }else{
            echo 'unable to edit item counts';
        }
    }
    /**
     * cron task to count all categories which have
     * a point with events.
     *
     * @copyright 2012 MapIt USA
     * @author Mike DeVita <mdevita@fivepints.com>
     */
    public function processCategoryEventCount(){
        if( $this->crontasks->processCategoryEventCount() ){
            echo 'successfully edited item counts';
        }else{
            echo 'unable to edit item counts';
        }
    }
}
?>
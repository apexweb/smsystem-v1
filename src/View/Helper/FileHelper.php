<?php
/**
 * File Helper
 * @package  
 * @author Ramandeep Sandhu
 */

namespace App\View\Helper;

use Cake\View\Helper;
use Cake\Routing\Router;

class FileHelper extends Helper
{
    /**
     * @var helpers
     */
    public $helpers = ['Html'];

    /**
     * displays a logo
     * @param integer $id of user
     * @param string $role of user
     * @return string img tag
     */
    public function display($id, $role, $attr=array())
    {
        return $this->Html->image($this->url($id, $role), $attr);
    }

    /**
     * url of a logo
     * @param integer $id of user
     * @param string $role of user
     * @return string img tag
     */
    public function url($id, $role)
    {
        $file = glob('userfiles' . DS . $role . '_logos' . DS . md5($id) . '.*');
        
        if(empty($file[0])) {
            return Router::url('/img/noimage.png', true);
        } else {
            return Router::url($file[0] . '?id=' . rand(0,1000000), true);
        }
    }
    
    public function attachment($filename){
        if($filename) {
            return $this->Html->link(
                        $this->Html->image(
                            Router::url('/assets/images/attachment.png', true), 
                            array('width' => 25, 'title' => $filename, 'alt' => $filename)
                        ),
                        Router::url('/assets'.DS.'attachments'.DS.'manufacturer'.DS.$filename, true),
                        ['escape' => false , 'target'=> '_blank']
                    );
        }
    }
}
<?php
/**
 * Com
 *
 * @author      Dave Li <dave@moyoweb.nl>
 * @category    Nooku
 * @package     Socialhub
 * @subpackage  ...
 * @uses        Com_
 */
 
defined('KOOWA') or die('Protected resource');

class ComMultimediaControllerToolbarVideos extends ComDefaultControllerToolbarDefault
{
    /**
     * @return array
     */
    public function getCommands()
    {
        $this->addCommand('import', array('icon' => 'icon-32-download', 'is_allowed' => true, 'attribs' => array('data-novalidate' => 'novalidate')));

		return parent::getCommands();
    }
}
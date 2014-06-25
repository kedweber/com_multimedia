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

class ComMultimediaViewVideoHtml extends ComMultimediaViewHtml
{
    public function display()
    {
        $video = $this->getModel()->getItem();

        $doc =& JFactory::getDocument();
        $doc->setTitle($video->title);
        $doc->setMetaData('Keywords', $video->meta_keywords);
        $doc->setMetaData('Description', $video->meta_description);

        $pathway = JFactory::getApplication()->getPathway();
        $pathway->addItem($video->title);
        
        $regions = $this->getService('com://admin/regions.model.regions')->getList();

        $this->assign('regions', $regions);

        return parent::display();
    }
}
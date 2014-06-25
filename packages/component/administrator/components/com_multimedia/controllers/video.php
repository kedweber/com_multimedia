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

class ComMultimediaControllerVideo extends ComDefaultControllerDefault
{
    protected function _actionImport(KCommandContext $context)
    {
        $videos = json_decode(file_get_contents('http://vimeo.com/api/v2/channel/web2fordev/videos.json'));

        foreach($videos as $video) {
            $item = $this->getService('com://admin/multimedia.model.videos')->resource_id($video->id)->source('Vimeo')->getItem();
            $item->setData(array(
                'thumbnail' => $item->thumbnails['medium'],
                'enabled' => $item->created_on == '0000-00-00 00:00:00' ? 0 : 1,
                'publish_up' => $item->created_on,
                '_new' => 1
            ));

            $item->save();
        }
    }
}
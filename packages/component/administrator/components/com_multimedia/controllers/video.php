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
        $sources = $this->getService('com://admin/multimedia.model.sources')->limit(0)->getList();

        foreach($sources as $source) {
            $videos = $this->getService('com://admin/multimedia.model.videos')->source($source->slug)->resource_id($source->resource_id)->getList();
            $videoModel = $this->getService('com://admin/multimedia.model.videos');

            foreach($videos as $importedVideo) {
                $videoModel->reset();
                $video = $videoModel->resource_id($importedVideo->resource_id)->source($importedVideo->source)->import(0)->getItem();;

                $video->setData(array(
                    'description'   => $importedVideo->description,
                    'title'         => $importedVideo->title,
                    'url'           => $importedVideo->url,
                    'created_on'    => $importedVideo->created_on,
                    'publish_up'    => $importedVideo->publish_up,
                    'thumbnail'     => $importedVideo->thumbnail,
                    'resource_id'   => $importedVideo->resource_id,
                    'source'        => $importedVideo->source
                ));

                $video->save();
            }
        }
    }
}
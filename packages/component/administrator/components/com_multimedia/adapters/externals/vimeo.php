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

class ComMultimediaAdapterExternalVimeo extends KObject
{
    /**
     * @var object|null
     */
    protected $_state = null;

    /**
     * @param KConfig $config
     */
    public function __construct(KConfig $config = null)
    {
        parent::__construct($config);

        $this->_state = $config->state;
    }

    public function getRow($video)
    {
        $row = $this->getService('com://admin/multimedia.database.row.video');

        $row->setData(array(
            'resource_id' => $video->id,
            'title' => $video->title,
            'description' => $video->description,
            'source' => 'Vimeo',
            'url' => $video->url,
            'thumbnail' => $video->thumbnail_medium,
            'thumbnails' => array(
                'small' => $video->thumbnail_small,
                'medium' => $video->thumbnail_medium,
                'large' => $video->thumbnail_large,
            ),
            'created_on' => $video->upload_date,
            'publish_up' => $video->upload_date,
            '_new'      => false // set false because of ajax action in form (else: 404)
        ));

        return $row;
    }

    /**
     * @return object
     */
    public function getItem()
    {
        $video = reset(json_decode(file_get_contents('http://vimeo.com/api/v2/video/'.$this->_state->resource_id.'.json')));

        return $this->getRow($video);
    }

    public function getList()
    {
        $videos = json_decode(file_get_contents('http://vimeo.com/api/v2/channel/'.$this->_state->resource_id.'/videos.json'));

        $rows = $this->getService('com://admin/multimedia.database.rowset.videos');

        foreach ($videos as $video) {
            $rows->addData(array('data' => $this->getRow($video)));
        }

        return $rows;
    }
}
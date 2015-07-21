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

class ComMultimediaAdapterExternalYoutube extends KObject
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

    /**
     * @return object
     */
    public function getItem()
    {
        $video = json_decode(file_get_contents('http://gdata.youtube.com/feeds/api/videos/'.$this->_state->resource_id.'?v=2&alt=jsonc'))->data->items[0];

        return $this->_getRow($video);
    }

    public function getList()
    {
        $videos = json_decode(file_get_contents('http://gdata.youtube.com/feeds/api/videos/?author='.$this->_state->resource_id.'&v=2&alt=jsonc'))->data->items;
        $rowset = $this->getService('com://admin/multimedia.database.rowset.videos');

        foreach ($videos as $video) {
            $rowset->addData(array('data' => $this->_getRow($video)));
        }

        return $rowset;
    }

    private function _getRow($video)
    {
        $row = $this->getService('com://admin/multimedia.database.row.video');
        
        $row->setData(array(
            'resource_id' => $video->id,
            'title' => $video->title,
            'description' => $video->description,
            'source' => 'Youtube',
            'url' => $video->content->{5},
            'thumbnail' => $video->thumbnail->sqDefault,
            'thumbnails' => array(
                'small' => $video->thumbnail->sqDefault,
                'large' => $video->thumbnail->hqDefault,
            ),
            'created_on' => $video->uploaded,
            'publish_up' => $video->updated,
            '_new'      => false // set false because of ajax action in form (else: 404)
        ));

        return $row;
    }
}
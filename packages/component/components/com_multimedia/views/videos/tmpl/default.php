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

defined('KOOWA') or die('Protected resource'); ?>

<module position="left" prepend="0">
	<aside class="regions">
		<h1><?= @text('FILTER_BY'); ?>:</h1>
		<ul class="regions__list">
			<? $regions = @service('com://admin/regions.model.regions')->getList(); ?>
			<? foreach($regions as $region) : ?>
				<li <?= $state->region_id == $region->id ? 'class="active"' : null ?>>
					<i class="circle"><?= $region->title[0]; ?></i> <a class="ajaxify" data-target="#container" href="<?= @route('&region_id='.$region->id); ?>"><?= $region->title; ?> <span class="normalize">(<?= @service('com://site/multimedia.model.videos')->region_id($region->id)->getTotal(); ?>)</span></a>
				</li>
			<? endforeach; ?>
		</ul>
	</aside>
</module>

<div class="multimedia__list">
    <div class="row">
        <? $i = 0; ?>
        <? foreach($videos as $video) : ?>
            <div class="col-sm-4" itemscope itemtype="http://schema.org/VideoObject">
                <div class="thumbnail">
                    <a itemprop="url" href="<?= @route('view=video&source=' . KService::get('koowa:filter.slug')->sanitize($video->source) . '&id=' . $video->id . '&slug=' . $video->slug); ?>"><img class="img-responsive" itemprop="thumbnail" src="<?= $video->thumbnail; ?>" /></a>
                    <div class="caption">
                        <h3 itemprop="name"><?= $video->title; ?></h3>
                        <time itemprop="datePublished" datetime="<?= date('Y-m-d', strtotime($video->publish_up)); ?>"><?= @helper('date.humanize', array('date' => $video->publish_up)) ?></time>
                        <meta itemprop="dateCreated" content="<?= date('Y-m-d', strtotime($video->created_on)); ?>" />
                        <meta itemprop="dateModified" content="<?= date('Y-m-d', strtotime($video->modified_on)); ?>" />
                    </div>
                </div>
            </div>
            <? $i++; ?>
            <? if($i % 3 === 0) : ?>
                </div>
                <div class="row">
            <? endif; ?>
        <? endforeach; ?>
    </div>
</div>
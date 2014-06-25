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
    <div class="regions">
        <h1><?= @text('FILTER_BY'); ?>:</h1>
        <ul class="regions__list">
            <? $regions = @service('com://admin/regions.model.regions')->getList(); ?>
            <? foreach($regions as $region) : ?>
                <? if($region->isRelationable()) : ?>
                    <li <?= $state->ancestor_id == $region->taxonomy_taxonomy_id ? 'class="active"' : null ?>>
                    <i class="circle"><?= $region->title[0]; ?></i> <a href="<?= @route('&ancestors[region]='.$region->taxonomy_taxonomy_id); ?>"><?= $region->title; ?> <span class="normalize">(<?= $region->getTaxonomy()->getDescendants(array('filter' => array('type' => 'video')))->count(); ?>)</span></a>
                <? endif; ?>
                </li>
            <? endforeach; ?>
        </ul>
    </div>
</module>

<article class="block__item" itemscope itemtype="http://schema.org/VideoObject">
    <header>
        <h1 itemprop="name"><?= $video->title; ?></h1>
    </header>
    <div class="meta">
        <time class="small" itemprop="datePublished" datetime="<?= date('Y-m-d', strtotime($video->publish_up)); ?>">
            <span class="clementine"><?= @text('Posted'); ?>:</span> <?= date('l, d F Y', strtotime($video->publish_up)); ?>
        </time>
        <meta itemprop="dateCreated" content="<?= date('Y-m-d', strtotime($video->created_on)); ?>" />
        <meta itemprop="dateModified" content="<?= date('Y-m-d', strtotime($video->modified_on)); ?>" />
        <a id="mail" data-toggle="modal" href="#myModal"><i class="icon-envelope clementine pull-right"></i></a>
    </div>
    <div class="body">
        <p><iframe itemprop="video" src="//player.vimeo.com/video/<?= $video->resource_id; ?>" width="575" height="460" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></p>
        <p><span itemprop="description"><?= $video->description; ?></span></p>
    </div>
</article>

<?= @template('com://site/events.view.mail.modal'); ?>
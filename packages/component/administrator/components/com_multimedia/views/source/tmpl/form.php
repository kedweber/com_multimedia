<? defined('KOOWA') or die('Restricted Access'); ?>

<? @helper('behavior.mootools'); ?>
<script src="media://lib_koowa/js/koowa.js" />

<form action="<?= @route('view=source&id=' . $source->id); ?>" method="post" class="-koowa-form">
    <div class="row-fluid">
        <div class="span8">
            <fieldset>
                <legend><?= @text('CONTENT'); ?></legend>

                <div class="control-group">
                    <label class="control-label"><?= @text('TITLE'); ?></label>
                    <div class="controls">
                        <input class="span12 required" type="text" name="title" value="<?= @escape($source->title); ?>" placeholder="<?= @text('TITLE'); ?>" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?= @text('SLUG'); ?></label>
                    <div class="controls">
                        <input class="span12" type="text" name="slug" value="<?= $source->slug; ?>" placeholder="<?= @text('SLUG'); ?>" />
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend><?= @text('SOURCE'); ?></legend>

                <div class="control-group">
                    <label class="control-label"><?= @text('SOURCE_URL'); ?></label>
                    <div class="controls">
                        <input class="span12" type="text" name="resource_id" value="<?= $source->resource_id; ?>" placeholder="<?= @text('RESOURCE_URL'); ?>" />
                    </div>
                </div>
            </fieldset>
        </div>
        <div class="span4">
            <div class="control-group">
                <label class="control-label"><?= @text('PUBLISHED'); ?></label>
                <div class="controls">
                    <?= @helper('select.booleanlist', array('name' => 'enabled', 'selected' => $source->enabled)); ?>
                </div>
            </div>

            <? if(!$source->original) : ?>
                <div class="control-group">
                    <label class="control-label"><?= @text('Translated'); ?></label>
                    <div class="controls">
                        <?= @helper('select.booleanlist', array('name' => 'translated', 'selected' => $source->translated)); ?>
                    </div>
                </div>
            <? endif; ?>
        </div>
    </div>
</form>
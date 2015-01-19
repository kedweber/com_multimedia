<? defined('KOOWA') or die; ?>

<?= @helper('behavior.mootools'); ?>

<script src="media://lib_koowa/js/koowa.js" />

<div class="row-fluid">
    <form action="" method="get" class="-koowa-grid" data-toolbar=".toolbar-list">
        <div class="btn-toolbar" id="filter-bar">
            <div class="filter-search btn-group pull-left">
                <input type="text" value="<?= $state->search; ?>" placeholder="Search" id="filter_search" name="search" style="margin-bottom: 0;">
            </div>
            <div class="btn-group pull-left hidden-phone">
                <button title="" class="btn hasTooltip" type="submit" data-original-title="Search"><i class="icon-search"></i></button>
                <button onclick="document.id('filter_search').value='';this.form.submit();" title="" class="btn hasTooltip" type="button" data-original-title="Clear"><i class="icon-remove"></i></button>
            </div>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="text-align: center;" width="1">
                        <?= @helper('grid.checkall')?>
                    </th>
                    <th>
                        <?= @helper('grid.sort', array('column' => 'title', 'title' => @text('TITLE'))); ?>
                    </th>
                    <th>
                        <?= @helper('grid.sort', array('column' => 'enabled', 'title' => @text('PUBLISHED'))); ?>
                    </th>
                    <? if($sources->isTranslatable()) : ?>
                        <th>
                            <?= @text('Translations') ?>
                        </th>
                    <? endif; ?>
                    <th>
                        <?= @text('Owner'); ?>
                    </th>
                    <th>
                        <?= @helper('grid.sort', array('column' => 'id', 'title' => @text('ID'))); ?>
                    </th>
                </tr>
            </thead>

            <tfoot>
                <tr>
                    <td colspan="9">
                        <?= @helper('paginator.pagination', array('total' => $total)) ?>
                    </td>
                </tr>
            </tfoot>

            <tbody>
                <? foreach ($sources as $source) : ?>
                    <tr>
                        <td style="text-align: center;">
                            <?= @helper('grid.checkbox', array('row' => $source))?>
                        </td>
                        <td>
                            <a href="<?= @route('view=source&id=' . $source->id); ?>">
                                <?= @escape($source->title); ?>
                            </a>
                        </td>
                        <td>
                            <?= @helper('grid.enable', array('row' => $source)); ?>
                        </td>
                        <? if($source->isTranslatable()) : ?>
                            <td>
                                <?= @helper('com://admin/translations.template.helper.language.translations', array(
                                    'row' => $source->id,
                                    'table' => $source->getTable()->getName()
                                )); ?>
                            </td>
                        <? endif; ?>
                        <td>
                            <?= $source->created_by_name; ?>
                        </td>
                        <td>
                            <?= $source->id; ?>
                        </td>
                    </tr>
                <? endforeach; ?>

                <? if (!count($sources)) : ?>
                    <tr>
                        <td colspan="9" align="center" style="text-align: center;">
                            <?= @text('MULTIMEDIA_SOURCES_NO_ITEMS') ?>
                        </td>
                    </tr>
                <? endif; ?>
            </tbody>
        </table>
    </form>
</div>
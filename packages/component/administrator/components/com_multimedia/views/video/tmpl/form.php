<? defined('KOOWA') or die; ?>

<?= @helper('behavior.mootools'); ?>
<?= @helper('behavior.modal'); ?>

<?= @helper('behavior.keepalive'); ?>
<?= @helper('behavior.validator'); ?>

<script src="media://lib_koowa/js/koowa.js" />

<script>
    jQuery.noConflict()(function($) {
        function getVideo(id, regExp) {
            var source = $('#source').find(':selected').text();
            var url = $('#url').val();
            var match = url.match(regExp);

            if (match){
                $.ajax({
                    type: "GET",
                    url: "index.php?option=com_multimedia&view=video&resource_id="+ match[id] +"&source="+ source +"&import=1&format=json"
                })
                .done(function( msg ) {
                    $('#input_title').val(msg.item.title);
                    $('#preview-image').attr('src', msg.item.thumbnails['medium']);
                    if (tinyMCE && tinyMCE.get('description')) {
                        tinyMCE.get('description').setContent(msg.item.description);
                    }
                    $("#thumbnail").val(msg.item.thumbnails['medium']);
                    $("#resource-id").val(msg.item.resource_id);
                    $("#publish_up").val(msg.item.publish_up);
                    $("#created_on").val(msg.item.publish_up);
                });
            } else {
                alert('Not a '+ source + ' url');
            }
        }

        $('#url').on('blur', function() {
            if($(this).val()) {
                var source = $('#source').find(':selected').text();

                switch(source)
                {
                    case 'Vimeo':
                        var regExp = /https?:\/\/(?:www\.)?vimeo.com\/(?:channels\/|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|)(\d+)(?:$|\/|\?)/;
                        getVideo(3, regExp);
                        break;
                    case 'Youtube':
                        var regExp =  /(?:v=)([^&]+)/;
                        getVideo(1, regExp);
                        break;
                }
            }
        });
    });
</script>

<form action="" class="form-horizontal -koowa-form" method="post">
    <div class="row-fluid">
        <div class="span8">
            <fieldset>
                <legend><?= @text('Content'); ?></legend>
                <div class="control-group">
                    <label class="control-label"><?= @text('Title'); ?></label>
                    <div class="controls">
                        <input class="required" id="input_title" type="text" name="title" value="<?= $video->title ?>" placeholder="<?= @text('Title'); ?>" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?= @text('Slug'); ?></label>
                    <div class="controls">
                        <input type="text" name="slug" value="<?= $video->slug ?>" placeholder="<?= @text('Slug'); ?>" />
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend><?= @text('Fieldset'); ?></legend>
                <div class="control-group">
                    <label class="control-label"><?= @text('Source'); ?></label>
                    <div class="controls">
                        <?= @helper('listbox.sources', array('attribs' => array('id' => 'source'))); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?= @text('Url'); ?></label>
                    <div class="controls">
                        <input class="inputbox required" id="url" type="text" name="url" value="<?= $video->url ?>" placeholder="<?= @text('Url'); ?>" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?= @text('Preview'); ?></label>
                    <div class="controls">
                        <img src="<?= $video->thumbnail; ?>" id="preview-image">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?= @text('Description'); ?></label>
                    <div class="controls">
                        <?= @editor(array(
                            'name' => 'description',
                            'html' => $video->description,
                            'width' => '100%',
                            'height' => '300',
                            'cols' => '60',
                            'rows' => '20',
                            'buttons' => false,
                            'options' => array('theme' => 'simple', 'pagebreak', 'readmore')));
                        ?>
                    </div>
                </div>
            </fieldset>
        </div>
        <div class="span4">
            <fieldset>
                <legend><?= @text('Details'); ?></legend>
                <div class="control-group">
                    <label class="control-label"><?= @text('Start Publishing'); ?></label>
                    <div class="controls">
                        <?= @helper('behavior.calendar', array('date' => $video->publish_up === '0000-00-00' ? date('Y-m-d') : $video->publish_up, 'name' => 'publish_up', 'format'  => '%Y-%m-%d')); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?= @text('End Publishing'); ?></label>
                    <div class="controls">
                        <?= @helper('behavior.calendar', array('date' => $video->publish_down, 'name' => 'publish_down', 'format'  => '%Y-%m-%d')); ?>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend><?= @text('Meta'); ?></legend>
                <div class="control-group">
                    <label class="control-label"><?= @text('Description'); ?></label>
                    <div class="controls">
                        <textarea name="meta_description"><?= $video->meta_description; ?></textarea>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?= @text('Keywords'); ?></label>
                    <div class="controls">
                        <textarea name="meta_keywords"><?= $video->meta_keywords; ?></textarea>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend><?= @text('Relations'); ?></legend>
                <div class="control-group">
                    <label class="control-label"><?= @text('Regions'); ?></label>
                    <div class="controls">
                        <?= @helper('com://admin/taxonomy.template.helper.listbox.taxonomies', array(
                            'identifier' => 'com://admin/regions.model.regions',
                            'name' => 'regions[]',
                            'deselect' => false,
                            'selected' => $video->regions ? $video->regions->getColumn('id') : array(),
                            'attribs' => array('multiple' => true, 'size' => 10, 'data-placeholder' => @text('Select regions&hellip;')),
                            'type' => 'region',
                            'relation' => 'ancestors'
                        )); ?>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
    <input type="hidden" name="resource_id" id="resource-id" value="<?= $video->resource_id; ?>" />
    <input type="hidden" name="thumbnail" id="thumbnail" value="<?= $video->thumbnail; ?>" />
    <input type="hidden" name="created_on" id="created_on" value="<?= $video->created_on; ?>" />
</form>
<h4><?php echo lang('Parameters for action') . ' ' . $macroAction->name . ' ' . lang('in macro') . ' ' . $macro->name; ?></h4>
<form id="macro-action-edit-form" role="form">
    <div class="form-group">
        <label for="macro-id" class="control-label"><?php echo lang('Macro'); ?></label>
        <select id="macro-id" name="macro-id" class="form-control">
            <?php foreach ($macros as $currentMacro) : ?>
                <option value="<?php echo $currentMacro->id; ?>"><?php echo $currentMacro->name; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-default"><?php echo lang('Save'); ?></button>
    </div>
</form>

<script>

<?php if (!empty($macroAction->parameters)) : ?>
        $('#macro-action-edit-form').deserialize(JSON.parse('<?php echo $macroAction->parameters; ?>'));
<?php endif; ?>

    $("#macro-action-edit-form").submit(function (event) {
        event.preventDefault();

        var parameters = JSON.stringify($(this).serializeObject());
        $.ajax({
            url: '<?php echo base_url('settings/set_macro_action_parameters/' . $macroAction->id); ?>',
            type: 'POST',
            data: {
                'parameters': parameters
            },
            success: function (response) {
                //TODO
            }
        });
    });

</script>
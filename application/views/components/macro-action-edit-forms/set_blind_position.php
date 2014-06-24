<h4><?php echo lang('Parameters for action') . ' ' . $macroAction->name . ' ' . lang('in macro') . ' ' . $macro->name; ?></h4>
<form id="macro-action-edit-form" role="form">
    <div class="form-group">
        <label for="blind-id" class="control-label"><?php echo lang('Blind'); ?></label>
        <select id="blind-id" name="blind-id" class="form-control">
            <?php foreach ($blinds as $blind) : ?>
                <option value="<?php echo $blind->id; ?>"><?php echo $blind->get_display_name(); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="position"><?php echo lang('Position'); ?></label>
        <div class="input-group">
            <input type="number" class="form-control" id="position" name="position" placeholder="0 - 100" min="1" max="100">
            <span class="input-group-btn">
                <button type="button" class="btn btn-default" onclick="onclick_load_blind_position_button();"><?php echo lang('Load current position'); ?></button>
            </span >
        </div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-default"><?php echo lang('Save'); ?></button>
    </div>
</form>

<script>

<?php if (!empty($macroAction->parameters)) : ?>
        $('#macro-action-edit-form').deserialize(JSON.parse('<?php echo $macroAction->parameters; ?>'));
<?php endif; ?>

    $("#macro-action-edit-form").submit(function(event) {
        event.preventDefault();

        var parameters = JSON.stringify($(this).serializeObject());
        $.ajax({
            url: '<?php echo base_url('settings/set_macro_action_parameters/' . $macroAction->id); ?>',
            type: 'POST',
            data: {
                'parameters': parameters
            },
            success: function(response) {
                //TODO
            }
        });
    });

    function onclick_load_blind_position_button() {
        var blindId = $("#blind-id").val();
        $.ajax({
            url: '<?php echo base_url('api/blinds/get_position/') ?>/' + blindId,
            dataType: 'json',
            async: false,
            success: function(apiResponse) {
                $("#position").val(apiResponse.data.position);
            }
        });

        return false;
    }

</script>
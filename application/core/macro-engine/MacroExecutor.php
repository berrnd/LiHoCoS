<?php

class MacroExecutor {

    public function __construct(Macros_model $macro) {
        $this->macro = $macro;
    }

    /**
     * @var Macros_model
     */
    private $macro;

    public function execute() {
        /* @var $macroAction Macro_Actions_model */
        foreach ($this->macro->get_actions() as $macroAction) {
            $parameters = json_decode($macroAction->parameters, TRUE);

            switch ($macroAction->type) {
                case MacroActionTypes::SWITCH_LIGHT:
                    $lightId = $parameters['light-id'];
                    $onOrOff = 1;
                    if ($parameters['switch-type'] == 'off')
                        $onOrOff = 0;

                    file_get_contents(base_url("plugin/switch_light/$lightId/$onOrOff"));
                    break;

                case MacroActionTypes::SET_BLIND_POSITION:
                    $blindId = $parameters['blind-id'];
                    $position = $parameters['position'];

                    file_get_contents(base_url("plugin/set_blind_position/$blindId/$position"));
                    break;
            }
        }
    }

}

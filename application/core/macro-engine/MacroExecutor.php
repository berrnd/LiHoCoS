<?php

class MacroExecutor {

    public function __construct(Macros_model $macro) {
        $this->ci = & get_instance();
        $this->macro = $macro;
    }

    /**
     * @var Macros_model
     */
    private $macro;

    /**
     * @var CI_Controller
     */
    private $ci;

    public function execute() {
        /* @var $macroAction Macro_Actions_model */
        foreach ($this->macro->get_actions() as $macroAction) {
            $parameters = json_decode($macroAction->parameters, TRUE);

            switch ($macroAction->type) {
                case MacroActionTypes::SWITCH_LIGHT:
                    $lightId = $parameters['light-id'];
                    $onOrOff = $parameters['switch-type'];

                    $this->ci->load->model('lights_model');
                    $light = $this->ci->lights_model->get($lightId);
                    $lightController = new LightController($light);
                    $lightController->switch_light($onOrOff);
                    break;

                case MacroActionTypes::SET_BLIND_POSITION:
                    $blindId = $parameters['blind-id'];
                    $position = $parameters['position'];

                    $this->ci->load->model('blinds_model');
                    $blind = $this->ci->blinds_model->get($blindId);
                    $blindController = new BlindController($blind);
                    $blindController->set_position($position);
                    break;

                case MacroActionTypes::EXECUTE_MACRO:
                    $macroId = $parameters['macro-id'];

                    $this->ci->load->model('macros_model');
                    $macro = $this->ci->macros_model->get($macroId);
                    $macroExecutor = new MacroExecutor($macro);
                    $macroExecutor->execute();
                    break;
            }
        }
    }

}

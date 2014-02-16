<?php

require_once 'DoorsPlugin.php';

class HomeMaticBidCoSForDoors extends DoorsPlugin {

    public function __construct() {
        parent::__construct();

        //Provide plugin details
        $this->pluginReadableName = 'HomeMatic (BidCoS) for Doors';
        $this->pluginDescription = 'Control HomeMatic door sensors';
        $this->authorName = 'Bernd Bestel';
        $this->authorWebsite = 'http://berrnd.de';
        $this->pluginWebsite = '';

        //Register your settings
        $this->register_setting('bdicos_url', 'BidCoS-URL', 'The URL of either your CCU or the BidCoS XML-RPC-Service running elsewhere (something like http://localhost:2001/)');

        //Register methods to be called on application boot
        $this->register_boot_function('bidcos_subscribe');

        $this->ci->load->third_party('phpxmlrpc/xmlrpc.inc');
        $this->ci->load->third_party('phpxmlrpc/xmlrpcs.inc');
    }

    /**
     * {@inheritdoc}
     */
    public function get_state(Doors_model $door) {
        $xmlrpcClient = $this->get_xmlrpc_client();
        $xmlrpcRequest = new xmlrpcmsg('getValue', array(
            new xmlrpcval($door->plugin_reference),
            new xmlrpcval('STATE')
        ));

        $xmlrpcResponse = $xmlrpcClient->send($xmlrpcRequest);

        if ($xmlrpcResponse->faultCode())
            return FALSE;
        else
            return $this->translate_state($xmlrpcResponse->value());
    }

    private function get_xmlrpc_client() {
        $xmlrpcClient = new xmlrpc_client($this->get_setting('bdicos_url'));
        $xmlrpcClient->return_type = 'phpvals';
        return $xmlrpcClient;
    }

    private function translate_state($hmBidcosState) {
        switch ($hmBidcosState) {
            case FALSE:
                return Doors_model::DOOR_STATE_CLOSED;
            case TRUE:
                return Doors_model::DOOR_STATE_OPEN;
        }
    }

    public function xmlrpc_server() {
        new xmlrpc_server(array(
            'listDevices' => array('function' => 'HomeMaticBidCoSForDoors::xmlrpc_empty_response'),
            'newDevices' => array('function' => 'HomeMaticBidCoSForDoors::xmlrpc_empty_response'),
            'event' => array('function' => 'HomeMaticBidCoSForDoors::xmlrpc_event')
        ));
    }

    /**
     * Send an empty but valid response
     * @param xmlrpcmsg $xmlrpcmsg
     * @return xmlrpcresp
     */
    public function xmlrpc_empty_response($xmlrpcmsg) {
        return new xmlrpcresp(new xmlrpcval(''));
    }

    /**
     * @param xmlrpcmsg $xmlrpcmsg
     * @return xmlrpcresp
     */
    public function xmlrpc_event($xmlrpcmsg) {
        $xthis = new HomeMaticBidCoSForDoors();
        $ci = & get_instance();
        $ci->load->model('doors_model');

        $hmBidcosId = $xmlrpcmsg->getParam(1)->scalarval();
        $hmBidcosState = $xmlrpcmsg->getParam(3)->scalarval();
        $doorState = $xthis->translate_state($hmBidcosState);

        //Write new state to database

        $door = $ci->doors_model->get_by_plugin_reference($hmBidcosId);

        if ($door) {
            $door->last_change = mysql_now();
            $door->state = $doorState;
            $door->save();

            $door->make_history_entry();
        }

        return $xthis->xmlrpc_empty_response($xmlrpcmsg);
    }

    /**
     * @return boolean
     */
    public function bidcos_subscribe() {
        $callbackUrl = base_url('/plugin/call_function/doors/HomeMaticBidCoSForDoors/xmlrpc_server');

        $xmlrpcClient = $this->get_xmlrpc_client();
        $xmlrpcRequest = new xmlrpcmsg('init', array(
            new xmlrpcval($callbackUrl),
            new xmlrpcval(guid())
        ));

        $xmlrpcResponse = $xmlrpcClient->send($xmlrpcRequest);

        if ($xmlrpcResponse->faultCode())
            return FALSE;
        else
            return TRUE;
    }

    /**
     * @return boolean
     */
    public function bidcos_unsubscribe() {
        $callbackUrl = base_url('/plugin/call_function/doors/HomeMaticBidCoSForDoors/xmlrpc_server');

        $xmlrpcClient = $this->get_xmlrpc_client();
        $xmlrpcRequest = new xmlrpcmsg('init', array(
            new xmlrpcval($callbackUrl)
        ));

        $xmlrpcResponse = $xmlrpcClient->send($xmlrpcRequest);

        if ($xmlrpcResponse->faultCode())
            return FALSE;
        else
            return TRUE;
    }

    /**
     * {@inheritdoc}
     */
    public function get_devices() {
        $bidcosUrl = $this->get_setting('bdicos_url');
        if (empty($bidcosUrl))
            return FALSE;

        $devices = array();

        $xmlrpcClient = $this->get_xmlrpc_client();
        $xmlrpcRequest = new xmlrpcmsg('listDevices');
        $xmlrpcResponse = $xmlrpcClient->send($xmlrpcRequest);

        if ($xmlrpcResponse->faultCode())
            return FALSE;
        else {
            $responseArray = $xmlrpcResponse->value();

            foreach ($responseArray as $responseValue) {
                if (array_key_exists('PARENT_TYPE', $responseValue) && $responseValue['PARENT_TYPE'] == 'HM-Sec-SC') {
                    $deviceId = $responseValue['ADDRESS'];
                    $parentDeviceId = $responseValue['PARENT'];

                    $xmlrpcRequest2 = new xmlrpcmsg('getMetadata', array(
                        new xmlrpcval($parentDeviceId),
                        new xmlrpcval('NAME')
                    ));
                    $xmlrpcResponse2 = $xmlrpcClient->send($xmlrpcRequest2);

                    if (!$xmlrpcResponse2->faultCode()) {
                        $deviceDescription = $xmlrpcResponse2->value();
                    }

                    if (string_ends_with($deviceId, ':1'))
                        $devices[] = array($deviceId, $deviceDescription);
                }
            }

            return $devices;
        }
    }

}

/*
 Example call from the BidCos service to the local XMLRPC server, when a door state has changed:

<?xml version="1.0" encoding="UTF-8"?>
<methodCall>
   <methodName>system.multicall</methodName>
   <params>
      <param>
         <value>
            <array>
               <data>
                  <value>
                     <struct>
                        <member>
                           <name>methodName</name>
                           <value>event</value>
                        </member>
                        <member>
                           <name>params</name>
                           <value>
                              <array>
                                 <data>
                                    <value>my_client_id</value>
                                    <value>KEQ0017274:1</value>
                                    <value>STATE</value>
                                    <value>
                                       <i4>0</i4>
                                    </value>
                                 </data>
                              </array>
                           </value>
                        </member>
                     </struct>
                  </value>
               </data>
            </array>
         </value>
      </param>
   </params>
</methodCall>
 */
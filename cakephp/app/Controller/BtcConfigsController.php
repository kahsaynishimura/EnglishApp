<?php

App::uses('AppController', 'Controller');

/**
 * BtcConfigs Controller
 *
 * @property BtcConfig $BtcConfig
 */
class BtcConfigsController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'RequestHandler');

    public function view_api() {
        if ($this->request->is('xml')) {
            $options = array('conditions' => array('BtcConfig.' . $this->BtcConfig->primaryKey => 1));
            $btcConfig = $this->BtcConfig->find('first', $options);

            $general_response = array(
                'status' => 'success',
                'data' => $this->BtcConfig->field("points_per_mBTC"),
                'message' => __('')
            );

            $this->set(array(
                'general_response' => $general_response,
                '_serialize' => array('general_response')
            ));
        }
    }

}

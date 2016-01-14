<?php

App::uses('AppController', 'Controller');

/**
 * Trades Controller
 *
 * @property Trade $Trade
 * @property PaginatorComponent $Paginator
 */
class TradesController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'RequestHandler');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add_api', 'validateQR');
    }

    /*     * ********************************Rest API********************************** */

    public function index_api() {
        $this->Trade->recursive = 0;
        //params: user_id, 
        if ($this->request->is('xml')) {
            $this->Trade->Behaviors->load('Containable');
            $this->set(array(
                'trades' => $this->Trade->find('all', array(
                    'conditions' => array('user_id' => 3), // $this->request->data['Trade']['user_id']),
                    'fields' => array('id', 'qr_code', 'validated'),
                    'contain' => array('Product' => array('fields' => array(
                                'name'
                            ), 'Partner' => array('fields' => array('name', 'address', 'phone')))),
                        )
                ),
                '_serialize' => array('trades'))
            );
        }
    }

    public function add_api() {
        if ($this->request->is(array('post', 'xml')) &&
                $this->request->data['Trade']['product_id'] > 0 && $this->request->data['Trade']['user_id'] > 0) {
            $this->Trade->create();
            $this->request->data['Trade']['validated'] = 0;
            $this->Trade->Product->id = $this->request->data['Trade']['product_id'];
            $this->Trade->User->id = $this->request->data['Trade']['user_id'];
            $cost = $this->Trade->Product->field('points_value');
            $user_total = $this->Trade->User->field('total_points');
            $available = $this->Trade->Product->field('quantity_available');
            if (($user_total > $cost) && $this->Trade->save($this->request->data) && $available > 0) {
                $this->Trade->User->saveField('total_points', ($user_total - $cost));
                $this->Trade->Product->saveField('quantity_available', $this->Trade->Product->field('quantity_available') - 1);
                $qrCode = $this->Trade->id . $this->request->data['Trade']['user_id'] . $this->request->data['Trade']['product_id'] . $this->Trade->field('created');
                $passwordHasher = new BlowfishPasswordHasher();
                $qrCode = $passwordHasher->hash($qrCode);
                $this->Trade->saveField('qr_code', $qrCode);
                $message = array(__('The trade has been saved.'));
                $general_response = array('data' => $qrCode, 'status' => 'success', 'message' => $message);
            } else {
                $message = array(__('The trade could not be saved. Please, try again.'));
                $general_response = array('data' => null, 'status' => 'failure', 'message' => $message);
            }
            $this->set(array(
                'general_response' => $general_response,
                '_serialize' => array('general_response')
            ));
        }
    }

    public function validateQR() {
        if ($this->request->is(array('post', 'xml')) &&
                !empty($this->request->data['Trade']['qr_code'])) {
            $this->Trade->Behaviors->load('Containable');
            $trade = $this->Trade->find('first', array(
                'fields' => array('id', 'validated'),
                'contain' => array(
                    'Product' => array(
                        'fields' => array('id', 'partner_id'),
                        'Partner' => array('fields' => array('id', 'user_id'))
                    )),
                'conditions' => array('qr_code' => $this->request->data['Trade']['qr_code'])));
            $this->Trade->id = $trade['Trade']['id'];
            
            //if the user trying to validate is the partner 
            //who registered the product and the trade was not
            // validated yet and there is a trade with this qr_code 
            // in the database and if the field was saved
            //TODO checar se o qr code construido da mesma forma retorna o mesmo resultado.
            if (sizeof($trade) == 2 && (int) $trade['Product']['Partner']['user_id'] == (int) $this->request->data['Partner']['user_id'] &&
                    (int) $trade['Trade']['validated'] !== 1 && $this->Trade->saveField('validated', 1)) {
                //sizeof($trade) == 2 means that there is a trade object and a product object
                $general_response = array('status' => 'success', 'data' => $trade['Product']['id'], 'message' => __('The code was validated.'));
            } else {
                $general_response = array('status' => 'failure', 'data' => '', 'message' => __('There was an error during the validation process.'));
            }
            $this->set(array(
                'general_response' => $general_response,
                '_serialize' => array('general_response')
            ));
        }
    }

}

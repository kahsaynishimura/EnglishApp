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
            $trade = $this->Trade->find('first', array(
                'fields' => array('id', 'Product.id', 'validated'),
                'conditions' => array('qr_code' => $this->request->data['Trade']['qr_code'])));
            if (sizeof($trade) == 2 && (int) $trade['Trade']['validated'] !== 1) {//sizeof($trade) == 2 means that there is a trade object and a product object
                $this->Trade->id = $trade['Trade']['id'];

                if ($this->Trade->saveField('validated', 1)) {
                    $general_response = array('status' => 'success', 'data' => $trade['Product']['id'], 'message' => __('The code was validated'));
                } else {
                    $general_response = array('status' => 'failure', 'data' => null, 'message' => __('Error'));
                }
            } else {
                $general_response = array('status' => 'failure', 'data' => '', 'message' => __('This item was not found or is already validated.'));
            }
            $this->set(array(
                'general_response' => $general_response,
                '_serialize' => array('general_response')
            ));
        }
    }

}

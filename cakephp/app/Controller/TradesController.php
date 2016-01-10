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
        $this->Auth->allow('add_api');
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

    public function validate() {
//TODO
    }

}

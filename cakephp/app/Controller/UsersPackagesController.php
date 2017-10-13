<?php

App::uses('AppController', 'Controller');

App::uses('CakeEmail', 'Network/Email');

/**
 * UsersPackages Controller
 *
 * @property UsersPackage $UsersPackage
 * @property PaginatorComponent $Paginator
 */
class UsersPackagesController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'RequestHandler');

    public function beforeFilter() {
        parent::beforeFilter();
        // Allow users to register and logout.
        $this->Auth->allow('addPayPal');
    }

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->UsersPackage->recursive = 0;
        $this->set('usersPackages', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->UsersPackage->exists($id)) {
            throw new NotFoundException(__('Invalid users package'));
        }
        $options = array('conditions' => array('UsersPackage.' . $this->UsersPackage->primaryKey => $id));
        $this->set('usersPackage', $this->UsersPackage->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->UsersPackage->create();
            if ($this->UsersPackage->save($this->request->data)) {
                $this->Flash->success(__('The users package has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The users package could not be saved. Please, try again.'));
            }
        }
        $users = $this->UsersPackage->User->find('list',array('order'=>array('name')));
        $packages = $this->UsersPackage->Package->find('list');
        $this->set(compact('users', 'packages'));
    }

    /**
     * addPaypal method
     *
     * @return void
     */
    public function addPayPal() {
        if ($this->request->is('post')) {
            $this->UsersPackage->User->recursive = 0;
            $buyerId = $this->UsersPackage->User->find('first', array(
                'conditions' => array('username' => $this->request->data['payer_email']),
                'fields' => array('User.id', 'User.username'))
            );
            $package = $this->UsersPackage->Package->find('first', array(
                'conditions' => array('id' => $this->request->data['item_number']),
                'fields' => array('Package.id', 'Package.name', 'Package.price')
            ));
            $isNewUser = false;
            if (empty($buyerId)) {

                $this->UsersPackage->User->create(array(
                    'User' => array(
                        'username' => $this->request->data['payer_email'],
                        'role' => 'student',
                        'is_confirmed' => 1,
                        'user_locale' => 'pt_BR',
                        'password' => 'newuserEP2017',
                        'name' => $this->request->data['first_name']
                )));
                $this->UsersPackage->User->save();
                $isNewUser = true;
                $buyerId['User']['id'] = $this->UsersPackage->User->getLastInsertID();
                $this->log('Created user id:' . $buyerId['User']['id']);
            }
            $this->log('buyerId: ' . $buyerId['User']['id'] . '|' . 'PackageId: ' . $this->request->data['item_number']);

            $newLicense = array('UsersPackage');

            $this->log('Gross: ' . $this->request->data['mc_gross'] . " | Price: " . $package['Package']['price']);
            $this->log('Receiver_email: ' . $this->request->data['receiver_email']);

            if ($this->request->data['receiver_email'] == 'karina@echopractice.com' &&
                    $this->request->data['payment_status'] == 'Completed' &&
                    $this->request->data['mc_gross'] == $package['Package']['price']) {
                $newLicense['UsersPackage']['transactionId'] = $this->request->data['txn_id'];
                $newLicense['UsersPackage']['package_id'] = $this->request->data['item_number'];
                $newLicense['UsersPackage']['user_id'] = $buyerId['User']['id'];


                $this->UsersPackage->create();
                if ($this->UsersPackage->save($newLicense)) {
//                return $this->redirect(array('action' => 'index'));
                    $this->log('saved');
                } else {
                    $this->log('there was a problem recording the purchase of this package. Check: email buyer and receiver, payment status and item number');
                }
            }

            $this->log($this->request->data);
            if ($isNewUser) {//the person bought the package with an email that is not related to a user account
                //Email
                $Email = new CakeEmail('smtp'); 
                $Email->from(array('karina@echopractice.com' => 'Echo Practice'))
                        ->to($this->request->data['payer_email'])
                        ->subject(__('Echo Practice - Credentials'))
                        ->template('new_user_from_paypal', 'default')
                        ->emailFormat('html')
                        ->viewVars(array(
                            'activate_account' => __('Access My Account and reset my password'),
                            'oneMoreStep' => __('Only one more step to start having fun.'),
                            'userName' => $this->request->data['first_name'],
                            'instructions' => __('Here is your login and password to access the app Echo Practice and start practicing pronunciation. You will find the package that you acquired under the Premium Tab in the app. Please, click the button bellow to reset your password.'),
                            'login' => $this->request->data['payer_email'],
                            'password' => 'newuserEP2017'))
                        ->send();

                $this->log('Email sent');
            }
        }
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->UsersPackage->exists($id)) {
            throw new NotFoundException(__('Invalid users package'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->UsersPackage->save($this->request->data)) {
                $this->Flash->success(__('The users package has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The users package could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('UsersPackage.' . $this->UsersPackage->primaryKey => $id));
            $this->request->data = $this->UsersPackage->find('first', $options);
        }
        $users = $this->UsersPackage->User->find('list');
        $packages = $this->UsersPackage->Package->find('list');
        $this->set(compact('users', 'packages'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->UsersPackage->id = $id;
        if (!$this->UsersPackage->exists()) {
            throw new NotFoundException(__('Invalid users package'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->UsersPackage->delete()) {
            $this->Flash->success(__('The users package has been deleted.'));
        } else {
            $this->Flash->error(__('The users package could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}

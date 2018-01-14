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
        $this->Auth->allow('addPayPal', 'hotmartNotification');
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
        $users = $this->UsersPackage->User->find('list', array('order' => array('name')));
        $packages = $this->UsersPackage->Package->find('list');
        $this->set(compact('users', 'packages'));
    }

    /**
     * addPaypal method
     *
     * @return void
     */
    public function addPayPal() {
        $this->log($this->request->data);

//        if ($this->request->is('post')) {
//            $this->UsersPackage->User->recursive = 0;
//            $buyerId = $this->UsersPackage->User->find('first', array(
//                'conditions' => array('username' => $this->request->data['payer_email']),
//                'fields' => array('User.id', 'User.username'))
//            );
//            $package = $this->UsersPackage->Package->find('first', array(
//                'conditions' => array('id' => $this->request->data['item_number']),
//                'fields' => array('Package.id', 'Package.name', 'Package.price')
//            ));
//            $isNewUser = false;
//            if (empty($buyerId)) {
//
//                $this->UsersPackage->User->create(array(
//                    'User' => array(
//                        'username' => $this->request->data['payer_email'],
//                        'role' => 'student',
//                        'is_confirmed' => 1,
//                        'user_locale' => 'pt_BR',
//                        'password' => 'newuserEP2017',
//                        'name' => $this->request->data['first_name']
//                )));
//                $this->UsersPackage->User->save();
//                $isNewUser = true;
//                $buyerId['User']['id'] = $this->UsersPackage->User->getLastInsertID();
//                $this->log('Created user id:' . $buyerId['User']['id']);
//            }
//            $this->log('buyerId: ' . $buyerId['User']['id'] . '|' . 'PackageId: ' . $this->request->data['item_number']);
//
//            $newLicense = array('UsersPackage');
//
//            $this->log('Gross: ' . $this->request->data['mc_gross'] . " | Price: " . $package['Package']['price']);
//            $this->log('Receiver_email: ' . $this->request->data['receiver_email']);
//
//            if ($this->request->data['receiver_email'] == 'karina@echopractice.com' &&
//                    strtolower($this->request->data['payer_status']) == 'verified' &&
//                    strtolower($this->request->data['payment_status']) == 'completed' &&
//                    $this->request->data['mc_gross'] == $package['Package']['price']) {
//                $newLicense['UsersPackage']['transactionId'] = $this->request->data['txn_id'];
//                $newLicense['UsersPackage']['package_id'] = $this->request->data['item_number'];
//                $newLicense['UsersPackage']['user_id'] = $buyerId['User']['id'];
//
//
//                $this->UsersPackage->create();
//                if ($this->UsersPackage->save($newLicense)) {
////                return $this->redirect(array('action' => 'index'));
//                    $this->log('saved');
//                } else {
//                    $this->log('there was a problem recording the purchase of this package. Check: email buyer and receiver, payment status and item number');
//                }
//            }
//
//
//            if ($isNewUser) {//the person bought the package with an email that is not related to a user account
//                //Email
//                $Email = new CakeEmail('smtp');
//                $Email->from(array('karina@echopractice.com' => 'Echo Practice'))
//                        ->to($this->request->data['payer_email'])
//                        ->subject(__('Echo Practice - Credentials'))
//                        ->template('new_user_from_paypal', 'default')
//                        ->emailFormat('html')
//                        ->viewVars(array(
//                            'activate_account' => __('Access My Account and reset my password'),
//                            'oneMoreStep' => __('Only one more step to start having fun.'),
//                            'userName' => $this->request->data['first_name'],
//                            'instructions' => __('Here is your login and password to access the app Echo Practice and start practicing pronunciation. You will find the package that you acquired under the Premium Tab in the app. Please, click the button bellow to reset your password.'),
//                            'login' => $this->request->data['payer_email'],
//                            'password' => 'tempuserEP2018'))
//                        ->send();
//
//                $this->log('Email sent');
//            }
//        }
    }

    public function hotmartNotification() {
        $this->log($this->request->data);
        $this->autoRender = false;

        if ($this->request->is('post')) {
            $this->UsersPackage->User->recursive = 0;

            //look up the buyer email in ep database
            $userId = $this->UsersPackage->User->find('first', array(
                'conditions' => array('username' => $this->request->data['email']),
                'fields' => array('User.id', 'User.username'))
            );
            $this->log("User");
            $this->log($userId);
            $buyerId = !empty($userId) ? $userId['User']['id'] : null;

            $this->UsersPackage->Package->recursive = 0;

            //Grab all the packages of this offer 
            //All packages in which the hotmart_prod id is equal to the one bought
            $packages = $this->UsersPackage->Package->find('all', array(
                'conditions' => array('Package.hotmart_prod' => $this->request->data['prod']),
                'fields' => array('Package.id', 'Package.name', 'Package.hotmart_prod')
            ));

            if ($this->request->data['status'] == "approved") {
                //check if the payment is done in order to grant the user access to the PREMIUM content

                $isNewUser = false;
                if (empty($userId)) {
                    //if it's not yet an echo practice user, create an account for them

                    $this->UsersPackage->User->create(array(
                        'User' => array(
                            'username' => $this->request->data['email'],
                            'role' => 'student',
                            'is_confirmed' => 1,
                            'user_locale' => 'pt_BR',
                            'password' => 'echo2018temp',
                            'name' => $this->request->data['name']
                    )));

                    $isNewUser = true;
                    if ($this->UsersPackage->User->save()) {
                        $buyerId = $this->UsersPackage->User->getLastInsertID();
                        $this->log('Created user id:' . $this->UsersPackage->User->getLastInsertID());
                    }
                }

                //give the user access to all packages
                $newLicense = array();
                foreach ($packages as $p) {

                    $license = array(
                        'package_id' => $p['Package']['id'],
                        'user_id' => $buyerId
                    );
                    array_push($newLicense, $license);
                }
                $this->log($newLicense);

                $this->UsersPackage->create();
                if ($this->UsersPackage->saveAll($newLicense)) {
                    $this->log("The license has been granted");
                }
            }

            if ($this->request->data['signature_status'] == 'Cancelada pelo cliente' ||
                    $this->request->data['signature_status'] == 'Cancelada pelo vendedor' ||
                    $this->request->data['signature_status'] == 'Cancelada pelo admin' ||
                    $this->request->data['signature_status'] == 'Vencido') {
                $options = array(
                    'fields' => array('id', 'user_id', 'Package.hotmart_prod'),
                    'conditions' => array('user_id' => $buyerId, "Package.hotmart_prod" => $this->request->data['prod'])
                );
                $packagesToDelete = $this->UsersPackage->find('all', $options);
                $this->log("A deletar:");
                $this->log($packagesToDelete);
                foreach ($packagesToDelete as $p) {
                    $this->UsersPackage->id = $p['UsersPackage']['id'];

                    if ($this->UsersPackage->delete()) {
                        $this->log("Acabou de apagar a licensa:" . $this->UsersPackage->id);
                    } else {

                        $this->log("Não apagou a licensa:" . $this->UsersPackage->id);
                    }
                }
            }

            if ($isNewUser) {//the person bought the package with an email that is not related to a user account
                //Email
                $Email = new CakeEmail('smtp');
                $Email->from(array('karina@echopractice.com' => 'Echo Practice'))
                        ->to($this->request->data['email'])
                        ->subject(__('Echo Practice - Dados de acesso PREMIUM'))
                        ->template('new_user_from_payment', 'default')
                        ->emailFormat('html')
                        ->viewVars(array(
                            'activate_account' => __('Altere a senha temporária'),
                            'oneMoreStep' => __('Aqui estão seus dados de acesso do aplicativo Echo Practice.'),
                            'userName' => $this->request->data['name'],
                            'userId' => $buyerId,
                            'instructions' => __('Seu login e senha para acessar o app Echo Practice e começar a praticar pronúncia. Selecione a aba Premium para acessar a área de membros. Para alterar sua senha, por favor, clique no botão abaixo.'),
                            'login' => $this->request->data['email'],
                            'password' => 'echo2018temp'))
                        ->send();
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

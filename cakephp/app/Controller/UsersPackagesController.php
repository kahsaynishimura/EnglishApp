<?php

App::uses('AppController', 'Controller');

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
        $users = $this->UsersPackage->User->find('list');
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
                'conditions' => array('id' => $this->request->data['item_number1']),
                'fields' => array('Package.id', 'Package.price')
            ));
            $newLicense = array('UsersPackage');
            if (!empty($buyerId) && $this->request->data['receiver_email'] == 'karina@echopractice.com' &&
                    ($this->request->data['payment_status'] == 'Completed') &&
                    $this->request->data['mc_gross'] == $package['Package']['price']) {
                $newLicense['UsersPackage']['transactionId'] = $this->request->data['txn_id'];
                $newLicense['UsersPackage']['package_id'] = $this->request->data['item_number1'];
                $newLicense['UsersPackage']['user_id'] = $buyerId['User']['id'];
            }
            $this->log('buyerId: ' . $buyerId['User']['id'] . '|' . 'PackageId: ' . $this->request->data['item_number1']);

            $this->log($this->request->data);
            $this->UsersPackage->create();
            if ($this->UsersPackage->save($newLicense)) {
//                return $this->redirect(array('action' => 'index'));
                $this->log('saved');
            } else {
                $this->log('there was a problem recording the purchase of this package. Check: email buyer and receiver, payment status and item number');
            }
        }
        $users = $this->UsersPackage->User->find('list');
        $packages = $this->UsersPackage->Package->find('list');
        $this->set(compact('users', 'packages'));
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

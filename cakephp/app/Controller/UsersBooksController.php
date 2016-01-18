<?php

App::uses('AppController', 'Controller');

/**
 * UsersBooks Controller
 *
 * @property UsersBook $UsersBook
 * @property PaginatorComponent $Paginator
 */
class UsersBooksController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');

    /**
     * add method
     *
     * @return void
     */
    public function add($bookId) {
        if (!$this->UsersBook->Book->exists($bookId)) {
            $this->Flash->error(__('Invalid book.'));
            return $this->redirect(array('controller' => 'books', 'action' => 'index'));
        }

        if ($this->request->is('post')) {
            $userToAuthorize = $this->UsersBook->User->find('first', array(
                'fields' => array('id', 'name'),
                'conditions' => array('username' => $this->request->data['UsersBook']['email'])));
            if (!empty($userToAuthorize['User'])) {
                $userId = $userToAuthorize['User']['id'];

                $userBook = $this->UsersBook->find('first', array('conditions' => array('UsersBook.book_id' => $bookId, 'UsersBook.user_id' => $userId)));
                if (empty($userBook['UsersBook'])) {
                    $this->request->data['UsersBook']['book_id'] = $bookId;
                    $this->request->data['UsersBook']['user_id'] = $userToAuthorize['User']['id'];
                    $this->UsersBook->create();
                    if ($this->UsersBook->save($this->request->data)) {
                        $this->Flash->success(__('Success. ' . $userToAuthorize['User']['name'] . ' is able to practice English using your content.'));
                        return $this->redirect(array('action' => 'add', $bookId));
                    } else {

                        $this->Flash->error(__('The users book could not be saved. Please, try again.'));
                    }
                } else {

                    $this->Flash->success(__('This book is already unlocked for this user'));
                }
            } else {
                $this->Flash->error(__('The user is not registered yet'));
            }
        }

        $usersBooks = $this->UsersBook->find('all', array('fields' => array('User.id', 'User.name', 'UsersBook.id', 'Book.id'), 'conditions' => array('book_id' => $bookId)));
        $this->set(compact('usersBooks'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($bookId = null, $id = null) {
        $this->UsersBook->id = $id;
        if (!$this->UsersBook->exists()) {
            throw new NotFoundException(__('Invalid users book'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->UsersBook->delete()) {
            $this->Flash->success(__('The users book has been deleted.'));
        } else {
            $this->Flash->error(__('The users book could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'add', $bookId));
    }

    public function isAuthorized($user) {

        // The owner of a book can add permissions to users 
        if (in_array($this->action, array('add', 'delete'))) {
            $bookId = (int) $this->request->params['pass'][0];
            if ($this->UsersBook->Book->isOwnedBy($bookId, $user['id'])) {
                return true;
            }
        }
        return parent::isAuthorized($user);
    }

}

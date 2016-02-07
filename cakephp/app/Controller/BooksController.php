<?php

App::uses('AppController', 'Controller');

/**
 * Books Controller
 *
 * @property Book $Book
 * @property PaginatorComponent $Paginator
 */
class BooksController extends AppController {

    /**
     * Components
     *  
     * @var array
     */
    public $components = array('Paginator', 'RequestHandler');

    public function index_api() {
        $this->Book->recursive = 0;
        if ($this->request->is('xml')) {
            $booksWithPermission = $this->Book->UsersBook->find('all', array(
                'fields' => array('Book.id', 'Book.name'),
                'order' => array('difficulty_level', 'name' => 'asc'),
                'conditions' => array('UsersBook.user_id' => $this->request->data['User']['id'], 'Book.is_free' => false),
            ));
            $books = $this->Book->find('all', array(
                'fields' => array('id', 'name'),
                'order' => array('difficulty_level', 'name' => 'asc'),
                'conditions' => array('is_free' => true),
            ));
            foreach ($booksWithPermission as $usersBook) {
                array_push($books, $usersBook);
            }

            $this->set(array(
                'books' => $books,
                '_serialize' => 'books'));
        }
    }

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Book->recursive = 0;
        $this->Paginator->settings = array(
            'Book' => array(
                'order' => array('difficulty_level', 'name' => 'asc'),
            )
        );
        $this->set('books', $this->Paginator->paginate('Book', array('Book.user_id' => $this->Auth->user('id'))));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Book->exists($id)) {
            throw new NotFoundException(__('Invalid book'));
        }
        $options = array('conditions' => array('Book.' . $this->Book->primaryKey => $id));
        $this->set('book', $this->Book->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Book->create();
            $this->request->data['Book']['user_id'] = $this->Auth->user('id');
            // $this->Book->User->id = $this->Auth->user('id');
            //$this->Book->User->saveField('role', 'author');
            if ($this->Book->save($this->request->data)) {
                $this->Flash->success(__('The book has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The book could not be saved. Please, try again.'));
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
        if (!$this->Book->exists($id)) {
            throw new NotFoundException(__('Invalid book'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Book->save($this->request->data)) {
                $this->Flash->success(__('The book has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The book could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Book.' . $this->Book->primaryKey => $id));
            $this->request->data = $this->Book->find('first', $options);
        }
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Book->id = $id;
        if (!$this->Book->exists()) {
            throw new NotFoundException(__('Invalid book'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Book->delete()) {
            $this->Flash->success(__('The book has been deleted.'));
        } else {
            $this->Flash->error(__('The book could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function isAuthorized($user) {
        if (in_array($this->action, array('add', 'index'))) {
            return true;
        }

        // The owner of a post can edit and delete it
        if (in_array($this->action, array('edit', 'delete'))) {
            $bookId = (int) $this->request->params['pass'][0];
            if ($this->Book->isOwnedBy($bookId, $user['id'])) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }

}

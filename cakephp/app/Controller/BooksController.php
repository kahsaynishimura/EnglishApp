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

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('book_by_package');
    }

    public function index_api() {
        $this->Book->recursive = 0;
        $this->Book->Behaviors->load('Containable');
        $this->Book->UsersBook->Behaviors->load('Containable');
        if ($this->request->is('xml')) {
            $usersBook = $this->Book->UsersBook->find('all', array(
                'contain' => array('Book' => array(
                        'id', 'name',
                        'Lesson' => array('fields' => array('id', 'name'))
                    )),
                'order' => array('difficulty_level', 'name' => 'asc'),
                'conditions' => array('UsersBook.user_id' => $this->request->data['User']['id'], 'Book.is_free' => false),
            ));
            $books = $this->Book->find('all', array(
                'fields' => array('id', 'name'),
                'contain' => array('Lesson' => array(
                        'fields' => array('id', 'name')
                    )),
                'order' => array('difficulty_level', 'name' => 'asc'),
                'conditions' => array('is_free' => true),
            ));

            //Hack:  manages premium lessons to have the same structure as the free lessons
            for ($i = 0; $i < sizeof($usersBook); $i++) {
                $lessons = $usersBook[$i]['Book']['Lesson'];
                unset($usersBook[$i]['Book']['Lesson']);
                $b['Book'] = $usersBook[$i]['Book'];
                $b['Lesson'] = $lessons;

                array_push($books, $b);
            }
            //  array_push($books, $usersBook);
//            foreach ($booksWithPermission as $usersBook) {
//            }

            $this->set(array(
                'books' => $books,
                '_serialize' => 'books'));
        }
    }

    public function book_by_package() {
        $this->Book->recursive = 0;
        $this->layout = false;
        if ($this->request->is('xml')) {

            $this->Book->Behaviors->load('Containable');
            $options = array(
                'fields' => array('Book.id', 'Book.name'),
                'order' => array('Book.name'),
                'conditions' => array('package_id' => $this->request->data['Book']['package_id']),
                'contain' => array('Lesson' => array('fields' => array('id', 'name')))
            );
            $books = $this->Book->find('all', $options);

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
    public function add($packageId = 0) {
        if ($this->request->is('post')) {
            $this->Book->create();
            $this->request->data['Book']['user_id'] = $this->Auth->user('id');
            if ($packageId != 0) {
                $this->request->data['Book']['package_id'] = $packageId;
            }
            if ($this->Book->save($this->request->data)) {
                $this->Flash->success(__('The book has been saved.'));
                return $this->redirect(array('controller' => 'lessons', 'action' => 'add', $this->Book->getLastInsertID()));
            } else {
                $this->Flash->error(__('The book could not be saved. Please, try again.'));
            }
        }
        $this->set(array(
            'packages' => $this->Book->Package->find('list'),
            '_serialize' => array('packages')));
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
        $this->set(array(
            'packages' => $this->Book->Package->find('list'),
            '_serialize' => array('packages')));
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

        // The owner of a book can edit and delete it
        if (in_array($this->action, array('edit', 'delete'))) {
            $bookId = (int) $this->request->params['pass'][0];
            if ($this->Book->isOwnedBy($bookId, $user['id'])) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }

}

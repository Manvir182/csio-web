<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Utility\Inflector;
/**
 * Articles Controller
 *
 *
 * @method \App\Model\Entity\Article[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ArticlesController extends AppController
{
    public function isAuthorized($user){
		if($user['role']=="Super Admin"){
			return true;
		} else {
			return false;
		}
    }

    public $paginate = [
        'maxLimit' => 1
    ];

    public function initialize(){
        parent::initialize();
        $this->Auth->allow(['blog','blogDetail','category']);
		$this->set('pageHeading','Blog');
	}
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Categories','Authors']
        ];
        $articles = $this->paginate($this->Articles);
        $this->set(compact('articles'));
    }

    public function category($slug=null)
    {       
        $this->paginate = [
            'contain' => ['Categories'=>[
                'conditions'=>[
                    'Categories.slug'=>$slug
                ]
            ],'Authors'],
            'maxLimit' => 15
        ];
        $this->loadModel('Categories');
        $categories= $this->Categories->find('all',['limit'=>6,'order'=>['Categories.created'=>'desc']]);
        $articles = $this->paginate($this->Articles,['order'=>['Articles.created'=>'desc']]);
        $this->set(compact('articles','categories'));
    }

    /**
     * blog list method
     */
    public function blog()
    {
        $this->paginate = [
            'contain' => ['Categories','Authors'],
            'maxLimit' => 15
        ];
        $this->loadModel('Categories');
        $categories= $this->Categories->find('all',['limit'=>6,'order'=>['Categories.created'=>'desc']]);
        $articles = $this->paginate($this->Articles,['order'=>['Articles.created'=>'desc']]);
        $this->set(compact('articles','categories'));
    }

    /**
     * blog detail method
     */
    public function blogDetail($slug = null)
    {
        $article = $this->Articles->find('all',['contain' => ['Categories','Authors'],
            'conditions' => ['Articles.slug' => $slug]
                  ])->first();
        
        $this->loadModel('Categories');
        $categories= $this->Categories->find('all',['limit'=>6,'order'=>['Categories.created'=>'desc']]);
        // $this->Articles = [
        //     'contain' => ['Categories','Authors']
        // ];
        $popularArticles = $this->Articles->find('all',['contain' => ['Categories','Authors'],'limit'=>5,'order'=>['Articles.created'=>'desc']]);

        $this->set(compact('article','categories','popularArticles'));
        // $this->set('article', $article);
    }

    /**
     * View method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $article = $this->Articles->get($id, [
            'contain' => ['Categories','Authors']
        ]);

        $this->set('article', $article);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $article = $this->Articles->newEntity();
        
        $this->loadModel('Authors');
        $authors = $this->Authors->find('list');
        $this->loadModel('Categories');
        $categories = $this->Categories->find('list');
        // dd($authors);

        if ($this->request->is('post')) {
            
            if(!empty($this->request->data['image'])){
				/* uploading signature image file*/
				$ext = explode('.',$this->request->data['image']['name']);
				$ext = end($ext);
				if($ext=='jpg' || $ext=='png' || $ext=='jpeg'){
					$awsPath = 'article_banners/article-'.str_replace(' ','_',microtime())."_".$article['slug'].".".$ext;
					$file = $this->aws->putObject($awsPath,$this->request->data['image']['tmp_name']);
					if($file['status']=='200'){
                        $this->request->data['image']=$file['url'];
					} 
				} 
				/* uploading signature image file ends*/
            }
            
            //Creating slug
            $slug = Inflector::slug($this->request->getData()['title'],'-');
            $uniqueSlug = $this->genUniqueSlug($slug);
            
            $article['slug'] = $uniqueSlug;
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            // echo"<pre>"; print_r($article);exit;

            if ($this->Articles->save($article)) {
                $this->Flash->success(__('The article has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The article could not be saved. Please, try again.'));
        }
        $this->set(compact('article','authors','categories'));
    }

    //generating Slug Whole Application wise unique
	public function genUniqueSlug($slug){
		
		//validating for uniqueness
        $isExist = $this->Articles->find()
							->where(['slug'=>$slug])
							->count();
		if($isExist!=0){
            $slug = $slug.rand(0,9);
            //echo"<pre>"; print_r($slug);exit;
			$slug = $this->genUniqueSlug($slug);
		} 
		return $slug;
	}

    /**
     * Edit method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $article = $this->Articles->get($id, [
            'contain' => []
        ]);
        //$oldAuthor = $article;
        $this->loadModel('Authors');
        $authors = $this->Authors->find('list');
        $this->loadModel('Categories');
        $categories = $this->Categories->find('list');

        if ($this->request->is(['patch', 'post', 'put'])) {

            $posted = $this->request->getData();
            if(!empty($posted['image']['name'])){
                // dd($posted);
				/* uploading image file*/
				$ext = explode('.',$posted['image']['name']);
				$ext = end($ext);
				if($ext=='jpg' || $ext=='png' || $ext=='jpeg'){
					$awsPath = 'article_banners/article-'.str_replace(' ','_',microtime())."_".$article['slug'].".".$ext;
					$file = $this->aws->putObject($awsPath,$posted['image']['tmp_name']);
					if($file['status']=='200'){
                        $posted['image']=$file['url'];
					} 
				} 
				/* uploading image file ends*/
            } else{
                unset($posted['image']);
            }
            $article = $this->Articles->patchEntity($article, $posted);
            // dd($article);
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('The article has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The article could not be saved. Please, try again.'));
        }
        $this->set(compact('article','authors','categories'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $article = $this->Articles->get($id);
        if ($this->Articles->delete($article)) {
            $this->Flash->success(__('The article has been deleted.'));
        } else {
            $this->Flash->error(__('The article could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

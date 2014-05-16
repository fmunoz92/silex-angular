<?php

namespace App\BusinessLogic {

    use Doctrine\ORM\EntityRepository;
    use Doctrine\ORM\EntityManager;
    use Exception;

    use App\Entity\Entity;

    /**
    * 
    */
    class ArticlesLogic extends BusinessLogic {
        
        protected $dataAccess;
        protected $em;
        protected $entity;

        public function __construct(EntityRepository $dataAccess, Entity $entity, EntityManager $em) {
            $this->dataAccess = $dataAccess;
            $this->em = $em;
            $this->entity = $entity;
        }

        public function getAll() {
            $all = $this->dataAccess->getAll();
            return $all;
        }

        public function get($id) {  
            $article = $this->dataAccess->find($id);
            $article = ($article)? $article->toArray() : null; 
            return $article;
        }

        public function create($data) {
            try {
                $article = $this->entity->create($data);
                $article->persist();
                $this->em->flush();
                return $article->toArray();             
            } 
            catch (Exception $e) {
                return array("err" => $e->getMessage(), "article" =>  $data);
            }

        }

        public function update($id, $data) {
            try {
                $article = $this->dataAccess->find($id);
                $article->update($data);

                $this->em->flush();
                return $article->toArray();             
            } 
            catch (Exception $e) {
                return array("err" => $e->getMessage(), "article" =>  $data);
            }
        }

        public function destroy($id) {
            $article = $this->dataAccess->find($id);
            try {
                $article->remove();
                $this->em->flush();
                return $article->toArray();
            }
            catch (Exception $e) {
                return array("err" => "Article not found");
            }
        }

    }

}
?>
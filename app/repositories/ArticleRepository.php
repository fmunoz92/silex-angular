<?php

namespace App\DataAccessLayer {

    use Doctrine\ORM\EntityRepository;
    use Doctrine\ORM\Mapping\ClassMetadata;
    use Exception;

    class ArticleRepository extends EntityRepository {

        public function __construct($em, ClassMetadata $class) {
            parent::__construct($em, $class);
            $class = $this->getClassName();
            $this->entity = new $class;
        }

        public function getAll() {
            return $this->entity->createQuery()->getArrayResult();
        }

        public function get($id) {
            $article = $this->find($id);
            return $article;
        }

        public function create($data) {
            $article = $this->entity->create($data);
            $article->persist();
            return $article;
        }

        public function update($id, $data) {
            $article = $this->find($id);
            $article->update($data);
            return $article;
        }

        public function destroy($id) {
            $article = $this->find($id);
            if($article) {
                $article->remove();
                return $article;
            }
            else 
                return null;//throws exception
        }
    }

}

?>
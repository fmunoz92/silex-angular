<?php

namespace App\DataAccessLayer {

    use Doctrine\ORM\EntityRepository;
    use Doctrine\ORM\EntityManager;
    use Doctrine\ORM\Mapping\ClassMetadata;
    use Exception;

    class ArticleRepository extends EntityRepository {

        public function getAll($alias = 'r') {
            $query = $this->getEntityManager()->createQueryBuilder($alias)->select($alias)->from($this->getClassName(), $alias)->getQuery();
            return $query->getArrayResult();
        }

    }

}

?>
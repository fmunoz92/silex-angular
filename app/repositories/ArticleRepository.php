<?php

namespace App\DataAccessLayer {

	use Doctrine\ORM\EntityRepository;
	use App\Entity\Article;

	class ArticleRepository extends EntityRepository {

		public function getAll() {
			return Article::createQuery()->getArrayResult();
		}

		public function get($id) {
			$article = $this->find($id);
			return $article;
		}

		public function create($data) {
			$article = Article::create($data);
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
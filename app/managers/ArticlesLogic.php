<?php

namespace App\BusinessLogic {

	use Doctrine\ORM\EntityRepository;
	use Doctrine\ORM\EntityManager;

	/**
	* 
	*/
	class ArticlesLogic {
		
		protected $dataAccess;

		public function __construct(EntityRepository $dataAccess, EntityManager $em) {
			$this->dataAccess = $dataAccess;
			$this->em = $em;
		}

		public function getAll() {
			$all = $this->dataAccess->getAll();
			return $all;
		}

		public function get($id) {
			$article = $this->dataAccess->get($id);
			$article = ($article)? $article->toArray() : null; 
			return $article;
		}

		public function create($data) {
			$article = $this->dataAccess->create($data);
			$this->em->flush();
			return $article->toArray();
		}

		public function update($id, $data) {
			$article = $this->dataAccess->update($id, $data);
			$this->em->flush();
			return $article->toArray();
		}

		public function destroy($id) {
			$article = $this->dataAccess->destroy($id);
			$this->em->flush();
			return $article->toArray();
		}

	}

}
?>
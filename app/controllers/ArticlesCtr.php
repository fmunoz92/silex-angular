<?php

namespace App\Controller {

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;

    use App\BusinessLogic\BusinessLogic;

    class ArticlesCtr extends Controller {

        public function __construct(BusinessLogic $manager) {
            $this->manager = $manager;
        }

        function index(Request $req) {
            $articles = $this->manager->getAll();
            return $this->json($articles);
        }

        function show(Request $req) {
            $id = $req->get("id");
            $article = $this->manager->get($id);
            return $this->json($article);
        }

        function create(Request $req) {
            $id = $req->get("id");
            $data = $req->get("body");
            $article = $this->manager->create($data);
            return $this->json($article);
        }

        function destroy(Request $req) {
            $id = $req->get("id");
            $article = $this->manager->destroy($id);
            return $this->json($article);
        }

        function update(Request $req) {
            $id = $req->get("id");
            $data = $req->get("body");
            $article = $this->manager->update($id, $data);
            return $this->json($article);
        }
    }
}

?>
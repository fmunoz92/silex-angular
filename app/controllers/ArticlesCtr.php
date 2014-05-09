<?php

namespace App\Controller {

    use Symfony\Component\HttpFoundation\Response;
    use Silex\Application;

    class ArticlesCtr extends BaseController {

        function index(Application $app) {
            $articles = $app["article_manager"]->getAll();
            return $app->json($articles);
        }

        function show(Application $app) {
            $id = $app["request"]->get("id");
            $article = $app["article_manager"]->get($id);
            return $app->json($article);
        }

        function create(Application $app) {
            $id = $app["request"]->get("id");
            $data = $app["request"]->get("body");
            $article = $app["article_manager"]->create($data);
            return $app->json($article);
        }

        function destroy(Application $app) {
            $id = $app["request"]->get("id");
            $article = $app["article_manager"]->destroy($id);
            return $app->json($article);
        }

        function update(Application $app) {
            $id = $app["request"]->get("id");
            $data = $app["request"]->get("body");
            $article = $app["article_manager"]->update($id, $data);
            return $app->json($article);
        }
    }
}

?>
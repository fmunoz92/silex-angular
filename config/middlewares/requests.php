<?php

$app->before(function(Symfony\Component\HttpFoundation\Request $req) use ($app) {
    $app["app.base_url"] = $req->getUriForPath("/");
});


$app->before(function(Symfony\Component\HttpFoundation\Request $req) use ($app) {
    $app["logger"]->info(print_r($req->request, true));

    if (0 === strpos($req->headers->get('Content-Type'), 'application/json')) {
        $data = json_decode($req->getContent(), true);
        $req->request->replace(is_array($data) ? array("body" => $data) : array());
        return $req;
    }
});


$app->before(function(Symfony\Component\HttpFoundation\Request $req) use ($app) {
    $app['twig'] = $app->share($app->extend('twig', function($twig, $app) {
        $user = $app["session"]->get("user") ? $app["session"]->get("user") : "0";
        $twig->addGlobal('user', $user);

        return $twig;
    }));
}); 

?>
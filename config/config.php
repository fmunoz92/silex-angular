<?php


namespace App;

use Silex\Application;
use Silex\ServiceProviderInterface;
use \RecursiveDirectoryIterator;
use \RecursiveIteratorIterator;
use \ActiveEntityListener;
use \ActiveEntityRegistry;
use \Doctrine\ORM\Events;


class Config implements ServiceProviderInterface {

    private $app = null;
    private $config = null;

    public function register(Application $app) {
        $this->app = $app;

        $this->loadEnv();
        $this->includeConfigFiles();
        $this->includeJsFiles();
        $this->configureDB();
    }

    public function boot(Application $app)
    {
    }

    private function loadEnv() {
        $env = getenv("SILEX_MODE");
        if(empty($env))
            $env = "development";

        //if($env != "production")
        $app["debug"] = true;

        $jsonEnv = file_get_contents(ROOT . '/config/env/'. $env .'.json');
        $jsonAll = file_get_contents(ROOT . '/config/env/all.json');

        $this->config = array_merge(json_decode($jsonAll, true), json_decode($jsonEnv, true));
    }

    private function includeJsFiles() {
        $files = array();
        
        foreach ($this->config["js"]["include"] as $include) {     
            $files = array_merge($files, self::getJsFiles(ROOT . $include["folder"]));
            $files = array_merge($files, self::getJsFiles(ROOT . $include["folder"] ."/*"));
        }

        $this->app['twig'] = $this->app->share($this->app->extend('twig', function($twig, $app) use ($files) {
            $twig->addGlobal('appName', "Silex Angular");
            $twig->addGlobal('title', "Full Stack");
            $twig->addGlobal('assetsJs', $files);

            return $twig;
        }));
    }

    private function includeConfigFiles() {
        define("DB_HOST", $this->config["database"]["host"]);
        define("DB_DATABASE", $this->config["database"]["database"]);
        define("DB_USER", $this->config["database"]["user"]);
        define("DB_PASSWORD", $this->config["database"]["password"]);

        self::includeDir(ROOT . "/config/providers");
        self::includeDir(ROOT . "/config/services");
        self::includeDir(APP_ROOT . "/routes/middlewares");
        self::includeDir(APP_ROOT . "/routes");
    }

    private function includeDir($dir) {
        $app = $this->app;
        $it = new RecursiveDirectoryIterator($dir);
        foreach (new RecursiveIteratorIterator($it) as $filename => $cur) {
            if(is_file($filename))
                require_once $filename;
        }
    }

    private static function getJsFiles($dir) {
        $files = array();
        foreach (glob($dir."/*.js") as $filename) {
            $files[] = str_replace(ROOT, "", $filename);
        }
        return $files;
    }

    private function configureDB() {
        $activeEntityListener = new ActiveEntityListener();
        $this->app['db.event_manager']->addEventListener(array(Events::postLoad), $activeEntityListener);

        ActiveEntityRegistry::setDefaultManager($this->app['db.orm.em']);
    }
}

?>
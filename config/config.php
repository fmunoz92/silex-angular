<?php

class Config {

    private static $app = null;
    private static $config = null;

    public static function load($app) {
        self::$app = $app;

        self::loadEnv();
        self::includeConfigFiles();
        self::includeJsFiles();
        self::configureDB();
    }

    private static function loadEnv() {
        $env = getenv("SILEX_MODE");
        if(empty($env))
            $env = "development";

        if($env != "production")
            $app["debug"] = true;

        $jsonEnv = file_get_contents(ROOT . '/config/env/'. $env .'.json');
        $jsonAll = file_get_contents(ROOT . '/config/env/all.json');

        self::$config = array_merge(json_decode($jsonAll, true), json_decode($jsonEnv, true));
    }

    private static function includeJsFiles() {
        $files = array();
        
        foreach (self::$config["js"]["include"] as $include) {     
            $files = array_merge($files, self::getJsFiles(ROOT . $include["folder"]));
            $files = array_merge($files, self::getJsFiles(ROOT . $include["folder"] ."/*"));
        }

        self::$app['twig'] = self::$app->share(self::$app->extend('twig', function($twig, $app) use ($files) {
            $twig->addGlobal('appName', "Silex Angular");
            $twig->addGlobal('title', "Full Stack");
            $twig->addGlobal('assetsJs', $files);

            return $twig;
        }));
    }

    private static function includeConfigFiles() {
        define("DB_HOST", self::$config["database"]["host"]);
        define("DB_DATABASE", self::$config["database"]["database"]);
        define("DB_USER", self::$config["database"]["user"]);
        define("DB_PASSWORD", self::$config["database"]["password"]);

        self::includeDir(ROOT . "/config/providers");
        self::includeDir(ROOT . "/config/services");
        self::includeDir(APP_ROOT . "/routes/middlewares");
        self::includeDir(APP_ROOT . "/routes");
    }

    private static function includeDir($dir) {
        $app = self::$app;
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

    private static function configureDB() {
        $activeEntityListener = new App\ActiveEntityListener();
        self::$app['db.event_manager']->addEventListener(array(Doctrine\ORM\Events::postLoad), $activeEntityListener);

        App\ActiveEntityRegistry::setDefaultManager(self::$app['db.orm.em']);
    }
}

?>
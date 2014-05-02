<?php

class Config {

	public static $app = null;

	public static function load($app) {
		self::$app = $app;
		$app["debug"] = true;

		require_once ROOT . "/config/dbs/db.php";

		self::includeDir(ROOT . "/config/providers");
		self::includeDir(ROOT . "/config/middlewares");
		self::includeDir(ROOT . "/config/services");
		self::includeDir(ROOT . "/config/dbs");
		self::includeDir(APP_ROOT . "/routes");


		$activeEntityListener = new App\ActiveEntityListener();
		$app['db.event_manager']->addEventListener(array(Doctrine\ORM\Events::postLoad), $activeEntityListener);

		App\ActiveEntityRegistry::setDefaultManager($app['db.orm.em']);

		$files = array();
		$files = array_merge($files, self::getJsFiles(ROOT . "/public/system"));
		$files = array_merge($files, self::getJsFiles(ROOT . "/public/system/*"));
		$files = array_merge($files, self::getJsFiles(ROOT . "/public/auth"));
		$files = array_merge($files, self::getJsFiles(ROOT . "/public/auth/*"));
		$files = array_merge($files, self::getJsFiles(ROOT . "/public/articles"));
		$files = array_merge($files, self::getJsFiles(ROOT . "/public/articles/*"));


		$app['twig'] = $app->share($app->extend('twig', function($twig, $app) use ($files) {
		    $twig->addGlobal('appName', "Silex Angular");
		    $twig->addGlobal('title', "Full Stack");
		    $twig->addGlobal('assetsJs', $files);

		    return $twig;
		}));

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

}

?>
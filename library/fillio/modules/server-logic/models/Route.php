<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Fillio_ServerLogic_Route
 *
 * @author kevinmachado
 */
class Fillio_ServerLogic_Route {

    private static $_route;

    /**
     * @var array()
     */
    private $arrayRoutes = array();

    /**
     * @return Fillio_ServerLogic_Route Instance d'objet - Singleton
     */
    private static function getInstance() {
        if (is_null(self::$_route))
            self::$_route = new Fillio_ServerLogic_Route();
        return self::$_route;
    }

    private function __construct() {
        $this->arrayRoutes = array();
    }

    /**
     * Ajoute une route et sa réécriture
     * @param string $from Url ? convertir sous la forme de pattern Fillio --- e.g /mon/:pattern/fillio/:id
     * @param stirng $to Url sous la forme de de capture --- e.g /mon/nouveau/(pattern)/(id)
     * Les variables :mavariable sont ensuite réutilisées sous cette forme (mavariable)
     */
    public static function addRoute($from, $to) {
        $instance = self::getInstance();
        $instance->arrayRoutes[$from] = $to;
    }

    /**
     * Réécrit l'URL donn� en param?tre ? partir de la liste des routes
     * @param string $url ? réécrire
     * @return string Url réécrite
     */
    public static function rewriteUrl($url) {
        $instance = self::getInstance();
        foreach ($instance->arrayRoutes as $basicUrlPattern => $rewroteUrlPattern) {
            if ($instance->comparePattern($url, $basicUrlPattern)) {
                return $rewroteUrl;
            }
        }
        return $url;
    }

    /**
     * Compare afin de savoir si l'URL match avec le pattern donn� (pattern sous la forme mon/:pattern/)
     * Le pattern sera transform� sous forme d'un preg_match afin d'?tre essay� avec l'url
     * @param string $url URL ? essayer
     * @param string $urlPattern Pattern sous forme /test/mon/:pattern/:id
     * @return int|bool 1 si �a match, 0 si �a ne match pas. False s'il y a une erreur
     */
    private function comparePattern($url, $urlPattern) {
        $urlPregPat = $this->formatPatternToPregPattern($urlPattern);
        return preg_match($urlPregPat, $url);
        /* $explodedUrl = array_filter(explode("/", $url));
          foreach ($explodedUrl as $fragment) {
          if (stripos($fragment, ":") === 0) {
          $fragKey = str_replace(":", "", $fragment);
          }
          } */
    }

    /**
     * Re�oit un pattern sous la forme /my/class/:classname/:id et le transforme en /my/class/(.+)?/(.+)?
     * @param string $oldPattern pattern fillio (e.g -> /mon/:pattern)
     * @return string Nouveau pattern pour preg match
     */
    private function formatPatternToPregPattern($oldPattern) {
        
    }

}

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
     * @var array
     */
    private $arrayRoutes = null;

    /**
     * @return Fillio_ServerLogic_Route Instance d'objet - Singleton
     */
    private static function getInstance() {
        if (is_null(self::$_route))
            self::$_route = new Fillio_ServerLogic_Route();
        return self::$_route;
    }

    private function __construct() {
        $this->arrayRoutes = null;
    }

    /**
     * Ajoute une route et sa réécriture
     * @param string $from Url à convertir sous la forme de pattern Fillio --- e.g /mon/:pattern/fillio/:id
     * @param string $to Url sous la forme de de capture --- e.g /mon/nouveau/(pattern)/(id)
     * Les variables :mavariable sont ensuite réutilisées sous cette forme (mavariable)
     */
    public static function addRoute($from, $to) {
        $instance = self::getInstance();
        $instance->arrayRoutes[$from] = $to;
    }

    /**
     * Réécrit l'URL donnée en paramètre à partir de la liste des routes
     * @param string $url à réécrire
     * @return string Url réécrite
     */
    public static function rewriteUrl($url) {
        $instance = self::getInstance();
        if (!is_null($url) && !is_null($instance->arrayRoutes)) {
            foreach ($instance->arrayRoutes as $basicUrlPattern => $rewroteUrlPattern) {
                if ($instance->comparePattern($url, $basicUrlPattern)) {
                    $_vars = $instance->getVars($url, $basicUrlPattern);
                    return $instance->rewrite($rewroteUrlPattern, $_vars);
                }
            }
        }
        return $url;
    }

    /**
     * Compare afin de savoir si l'URL match avec le pattern donné (pattern sous la forme mon/:pattern/)
     * Le pattern sera transformé sous forme d'un preg_match afin d'être essayé avec l'url
     * @param string $url URL à essayer
     * @param string $urlPattern Pattern sous forme /test/mon/:pattern/:id
     * @return int|bool 1 si ça match, 0 si ça ne match pas. False s'il y a une erreur
     */
    private function comparePattern($url, $urlPattern) {
        $urlPregPat = $this->formatPatternToPregPattern($urlPattern);

        echo "<br>preg_match(<br>$urlPregPat<br>,<br> $url<br>)";

        return preg_match("`^$urlPregPat$`", $url);

        /* $explodedUrl = array_filter(explode("/", $url));
          foreach ($explodedUrl as $fragment) {
          if (stripos($fragment, ":") === 0) {
          $fragKey = str_replace(":", "", $fragment);
          }
          } */
    }

    /**
     * Reçoit un pattern sous la forme /my/class/:classname/:id/ et le transforme en /my/class/([^/]+)/([^/]+)/
     * @param string $oldPattern pattern fillio (e.g -> /mon/:pattern)
     * @return string Nouveau pattern pour preg match
     */
    private function formatPatternToPregPattern($oldPattern) {
        $uri_params = array_filter(explode("/", ltrim($oldPattern, "/")));
        $urlNewPattern = null;
        foreach ($uri_params as $uri_param) {
            $urlNewPattern .= "/".(stripos($uri_param, ":") === 0 ? "([^/]+)" : $uri_param);
        }
        return $urlNewPattern;
    }

    /**
     * Réécrit une URL à partir d'un pattern et d'un tableau de valeur
     * @param $rewroteUrlPattern string Pattern pour la réécriture d'URL sous la forme -> mon/url/de/:what/:and
     * @param $vars array Ensemble clé/valeur ('what' => 'dingue', 'and' => 'lol')
     * @return Url réécrite
     */
    private function rewrite($rewroteUrlPattern, $vars) {
        foreach ($vars as $varKey => $varValue) {
            $rewroteUrlPattern = str_replace(":$varKey", "$varValue", $rewroteUrlPattern);
        }
        echo "<br>$rewroteUrlPattern<br>";
        return $rewroteUrlPattern;
    }

    /**
     * Obtenir les variables sous forme de clé/valeur pour l'URL passé en fonction du pattern
     * @param $url string Sous forme -> mon/url/de/dingue/lol
     * @param $basicUrlPattern string Sous la forme -> mon/url/de/:what/:and
     * @return array Ensemble clé/valeur ('what' => 'dingue', 'and' => 'lol')
     */
    private function getVars($url, $basicUrlPattern) {
        $urlPregPat = $this->formatPatternToPregPattern($basicUrlPattern);
        preg_match("`^$urlPregPat$`", $url, $matches);
        print_r($matches);
    }

}

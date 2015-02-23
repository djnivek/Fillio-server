<?php
/**
 * Created by PhpStorm.
 * User: kevinmachado
 * Date: 20/02/2015
 * Time: 18:05
 */

class Fillio_ServerLogic_RouteLogic {

    protected static $_route;

    /**
     * @var array
     * Clé      - Url à convertir sous la forme de pattern Fillio --- e.g /mon/:pattern/fillio/:id
     * Valeur   - Url sous la forme de de capture --- e.g /mon/nouveau/(pattern)/(id)
     */
    protected $arrayRoutes = null;

    /**
     * @return Fillio_ServerLogic_Route Instance d'objet - Singleton
     */
    protected static function getInstance() {
        if (is_null(self::$_route))
            self::$_route = new Fillio_ServerLogic_RouteLogic();
        return self::$_route;
    }

    private function __construct() {
        $this->arrayRoutes = null;
    }

    /**
     * Réécrit l'URL donnée en paramètre à partir de la liste des routes
     * @param string $url à réécrire ( Ex : /class/user/1 )
     * @return string Url réécrite ( Ex : /fillio/user/get/1 )
     */
    protected function _rewriteUrl($url) {
        if (!is_null($url) && !is_null($this->arrayRoutes)) {
            foreach ($this->arrayRoutes as $basicUrlPattern => $rewroteUrlPattern) {
                if ($this->comparePattern($url, $basicUrlPattern)) {
                    $_vars = $this->getVars($url, $basicUrlPattern);
                    return $this->rewrite($rewroteUrlPattern, $_vars);
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
        return preg_match("`^$urlPregPat$`", $url);
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
     * @param $rewroteUrlPattern string Pattern pour la réécriture d'URL sous la forme -> class/(classname)/(id)
     * @param $vars array Ensemble clé/valeur ('classname' => 'user', 'id' => '1')
     * @return Url réécrite
     */
    private function rewrite($rewroteUrlPattern, $vars) {
        foreach ($vars as $varKey => $varValue) {
            $rewroteUrlPattern = str_replace("($varKey)", "$varValue", $rewroteUrlPattern);
        }
        return $rewroteUrlPattern;
    }

    /**
     * Obtenir les variables sous forme de clé/valeur pour l'URL passé en fonction du pattern
     * @param $url string Sous forme -> mon/url/de/dingue/lol
     * @param $basicUrlPattern string Sous la forme -> mon/url/de/:what/:and
     * @return array Ensemble clé/valeur ('what' => 'dingue', 'and' => 'lol')
     */
    protected function getVars($url, $basicUrlPattern) {
        $values = $this->getVarsValue($url, $basicUrlPattern);
        $keys = $this->getVarsKey($basicUrlPattern);
        $valsKeys = array();
        for ($i = 0; $i < count($keys); $i++) {
            $valsKeys[$keys[$i]] = $values[$i+1];
        }

        Fillio_ServerLogic_Route::$varsFromUrl = $valsKeys;

        return $valsKeys;
    }

    /**
     * Obtenir les valeurs des variables pour l'URL passé en fonction du pattern
     * @param $url string Sous forme -> mon/url/de/dingue/lol
     * @param $basicUrlPattern string Sous la forme -> mon/url/de/:what/:and
     * @return array Ensemble de valeurs ('1' => 'dingue', '2' => 'lol')
     */
    private function getVarsValue($url, $basicUrlPattern) {
        $urlPregPat = $this->formatPatternToPregPattern($basicUrlPattern);
        preg_match("`^$urlPregPat$`", $url, $matches);
        unset($matches[0]);
        return $matches;
    }

    /**
     * Retourne la liste des clés des variables de l'url
     * Ex : class/:classname/:id
     * Cela retournera 'classname' et 'id' dans un tableau
     * @param $urlPattern string Url sous la forme -> class/:classname/:id
     * @return array liste des clés
     */
    private function getVarsKey($urlPattern) {
        $uri_params = array_filter(explode("/", ltrim($urlPattern, "/")));
        $vars = array();
        foreach ($uri_params as $uri_param) {
            if (stripos($uri_param, ":") === 0) {
                $vars[] = ltrim($uri_param, ":");
            }
        }
        return $vars;
    }

}
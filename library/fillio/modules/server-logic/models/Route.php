<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once "fillio/modules/server-logic/models/RouteLogic.php";

/**
 * Description of Fillio_ServerLogic_Route
 *
 * @author kevinmachado
 */
class Fillio_ServerLogic_Route extends Fillio_ServerLogic_RouteLogic {

    /**
     * @var string pattern utilisé pour la route
     * Sous la forme default/(classname)/get/(id)
     */
    public static $patternUsed;

    /**
     * @var array Variables de l'URL
     */
    public static $varsFromUrl;

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
     * @param string $url à réécrire ( Ex : /class/user/1 )
     * @return string Url réécrite ( Ex : /fillio/user/get/1 )
     */
    public static function rewriteUrl($url) {
        $instance = self::getInstance();
        return $instance->_rewriteUrl($url);
    }

}

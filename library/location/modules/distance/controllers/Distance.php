<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Distance
 *
 * @author kevinmachado
 */
class Library_Location_Distance_DistanceController {
    
    /**
     * Distance fictive entre deux coordonn�es
     * 
     * @param double $c1 Coordonn�e du genre 12.2
     * @param double $c2 Coordonn�e du genre 52.2
     * @return double
     */
    public function getDistance($c1, $c2) {
        return $c1*$c2;
    }
    
}

<?php
function calculerAge($DateNaissance) {
            // Convertir la date de naissance en objet DateTime
            $DateNaissance = new DateTime($DateNaissance);
        
            // Obtenir la date du jour
            $dateAujourdhui = new DateTime();
        
            // Calculer la différence
            $intervalle = $dateAujourdhui->diff($DateNaissance);
        
            // Retourner l'âge en années
            return $intervalle->y;
        }
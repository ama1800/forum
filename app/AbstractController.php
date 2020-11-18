<?php

namespace App;

    abstract class AbstractController 
    {
        protected static function herarchie()
        {
            $grades =[
                1 => "<span style='color:red;'>ADMIN</span>",
                2 => "<span style='color:green;'>MODERATEUR</span>",
                3 => "<span style='color:yellow;'>VIP</span>",
                4 => "<span style='color:steelblue;'>MEMBRE SENIOR</span>",
                5 => "<span style='color:gray;'>MEMBRE</span>"
            ];
            return $grades;
        }
        
        // protected static function result($nbUsers= null, $nMessages=null, $nbSujets= null)
        // {
        //     if($nbSujets!=null)
        //     {
        //         return $nbSujets;
        //     }
        //     if($nbUsers!=null)
        //     {
        //         return $nbUsers;
        //     }
        //     if($nMessages!=null)
        //     {
        //         return $nMessages;
        //     }
        //     return null;
        // }
        // public function colors()
        // {
        //     {
        //         $colors =[
        //             1 => "<span style='color:red;'>".$pseudo."</span>",
        //             2 => "<span style='color:green;'>".$pseudo."</span>",
        //             3 => "<span style='color:yellow;'>".$pseudo."</span>",
        //             4 => "<span style='color:black;'>".$pseudo."</span>",
        //             5 => "<span style='color:gray;'>".$pseudo."</span>"
        //         ];
        //         return $colors;
        //     }
        // }
    }


        
<?php

namespace App\DataFixtures;

use App\Entity\Ingredients;
use App\Entity\Recipes;
use App\Entity\Steps;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $recipesList = [
            [
                "name" => "Moules au curry",
                "picture" => "https://assets.afcdn.com/recipe/20200907/113854_w1000h667c1cx2880cy1920cxb5760cyb3840.webp"
            ],
            [
                "name" => "Poulet Basquaise",
                "picture" => "https://assets.afcdn.com/recipe/20161116/7224_w1000h1500c1cx1972cy3850cxb3840cyb5760.webp"
            ],
            [
                "name" => "Soupe de courgettes à la vache qui rit",
                "picture" => "https://assets.afcdn.com/recipe/20181017/82802_w1000h1333c1cx1824cy2431cxb3648cyb4863.webp"
            ],
            [
                "name" => "Pave de saumon en papillotte",
                "picture" => "https://assets.afcdn.com/recipe/20180215/77570_w1000h750c1cx1024cy768cxb2048cyb1536.webp"
            ],
            [
                "name" => "Nouilles sautées aux légumes",
                "picture" => "https://assets.afcdn.com/recipe/20161114/27613_w1000h667c1cx2808cy1872.webp"
            ],
            [
                "name" => "Blanquette de veau à l'ancienne",
                "picture" => "https://assets.afcdn.com/recipe/20190124/86626_w1000h1079c1cxb3024cyb3264.webp"
            ],
            [
                "name" => "Tagliatelles à la crème de poireaux",
                "picture" => "https://assets.afcdn.com/recipe/20130723/3682_w1000h1500c1cx1872cy2808.webp"
            ],
            [
                "name" => "Beignets Tempura au calamar et aux légumes",
                "picture" => "https://assets.afcdn.com/recipe/20160520/63841_w1000h667c1cx3000cy2000.webp"
            ],
            [
                "name" => "Salade de riz d'été facile",
                "picture" => "https://assets.afcdn.com/recipe/20190704/94662_w1000h667c1cxb4802cyb3202.webp"
            ],
            [
                "name" => "Parmentier de confit de canard",
                "picture" => "https://assets.afcdn.com/recipe/20221004/135706_w1000h1499c1cx683cy1487cxb1414cyb2119.webp"
            ],
            [
                "name" => "Rôti de boeuf à l'oignon caramélisé",
                "picture" => "https://assets.afcdn.com/recipe/20200227/108353_w1000h696c1cx2816cy1960cxb5632cyb3921.webp"
            ],
            [
                "name" => "Risotto aux asperges",
                "picture" => "https://assets.afcdn.com/recipe/20130823/2500_w640h486c1cx3024cy2016.webp"
            ],
            [
                "name" => "Pizza tartiflette",
                "picture" => "https://assets.afcdn.com/recipe/20210217/118011_w640h486c1cx1600cy1220cxb3200cyb2440.webp"
            ],
            [
                "name" => "Salade de poulpe",
                "picture" => "https://assets.afcdn.com/recipe/20131024/37958_w640h486c1cx2144cy1424.webp"
            ],
            [
                "name" => "Tajine traditionnel (Maroc)",
                "picture" => "https://assets.afcdn.com/recipe/20181017/82757_w1000h1333c1cx1944cy2592cxb3888cyb5184.webp"
            ],
            [
                "name" => "Gratin de courge butternut",
                "picture" => "https://assets.afcdn.com/recipe/20171102/74250_w1000h1498c1cx2008cy3008cxb4016cyb6016.webp"
            ],
            [
                "name" => "Carpaccio d'aubergines",
                "picture" => "https://assets.afcdn.com/recipe/20170629/69810_w1000h1500c1cx2000cy3000.webp"
            ],
            [
                "name" => "Feuilleté boeuf courgette",
                "picture" => "https://assets.afcdn.com/recipe/20220627/133139_w714h942cx357cy471cxb714cyb942.webp"
            ],
        ];

        $ingredientsList = [
            "Moules au curry" => [
                [
                    "name" => "curry en poudre",
                    "quantities" => "0.25",
                    "unit" => "c.à.s"
                ],
                [
                    "name" => "vin blanc",
                    "quantities" => "10",
                    "unit" => "cl"
                ],
                [
                    "name" => "crème fraiche",
                    "quantities" => "2.5",
                    "unit" => "cl"
                ],
                [
                    "name" => "beurre",
                    "quantities" => "12.5",
                    "unit" => "g"
                ],
                [
                    "name" => "Persil",
                    "quantities" => "0.5",
                    "unit" => "g"
                ],
                [
                    "name" => "moules",
                    "quantities" => "0.5",
                    "unit" => "kg"
                ],
                [
                    "name" => "échalote",
                    "quantities" => "0.25",
                    "unit" => null
                ],
            ],

            "Poulet Basquaise" => [
                [
                    "name" => "tomates",
                    "quantities" => "0.25",
                    "unit" => "kg"
                ],
                [
                    "name" => "poivrons verts et rouges",
                    "quantities" => "116.5",
                    "unit" => "g"
                ],
                [
                    "name" => "oignons émincés",
                    "quantities" => "0.5",
                    "unit" => null
                ],
                [
                    "name" => "gousses d'aîl",
                    "quantities" => "0.5",
                    "unit" => null
                ],
                [
                    "name" => "vin blanc",
                    "quantities" => "3.5",
                    "unit" => "cl"
                ],
                [
                    "name" => "bouquet garni",
                    "quantities" => "1",
                    "unit" => null
                ],
                [
                    "name" => "huile d'olive",
                    "quantities" => "1",
                    "unit" => "c.à.s"
                ],
                [
                    "name" => "sel",
                    "quantities" => "0.25",
                    "unit" => "pincée"
                ],
                [
                    "name" => "poivre",
                    "quantities" => "0.25",
                    "unit" => "pincée"
                ],
                [
                    "name" => "poulet",
                    "quantities" => "150",
                    "unit" => "g"
                ],
            ],

            "Soupe de courgettes à la vache qui rit" => [
                [
                    "name" => "Courgette",
                    "quantities" => "175",
                    "unit" => "g"
                ],
                [
                    "name" => "bouillon de legume",
                    "quantities" => "0.5",
                    "unit" => "cube"
                ],
                [
                    "name" => "ail",
                    "quantities" => "0.5",
                    "unit" => "gousse"
                ],
                [
                    "name" => "eau",
                    "quantities" => "0.25",
                    "unit" => "l"
                ],
                [
                    "name" => "poivre",
                    "quantities" => "1",
                    "unit" => "pincée"
                ],
                [
                    "name" => "sel",
                    "quantities" => "1",
                    "unit" => "pincée"
                ],
                [
                    "name" => "Vache qui rit",
                    "quantities" => "1.5",
                    "unit" => "portion"
                ],
            ],

            "Pave de saumon en papillotte" => [
                [
                    "name" => "poireau",
                    "quantities" => "1",
                    "unit" => null
                ],
                [
                    "name" => "Carotte",
                    "quantities" => "1",
                    "unit" => null
                ],
                [
                    "name" => "Courgette",
                    "quantities" => "0.5",
                    "unit" => null
                ],
                [
                    "name" => "Tomate",
                    "quantities" => "0.5",
                    "unit" => null
                ],
                [
                    "name" => "Huile d'olive",
                    "quantities" => "5",
                    "unit" => "ml"
                ],
                [
                    "name" => "Jus de citron",
                    "quantities" => "2",
                    "unit" => "ml"
                ],
                [
                    "name" => "Herbe de Provence",
                    "quantities" => "1",
                    "unit" => "pincée"
                ],
                [
                    "name" => "Pavé de saumon",
                    "quantities" => "1",
                    "unit" => null
                ],
            ],

            "Nouilles sautées aux légumes" => [
                [
                    "name" => "poireau",
                    "quantities" => "0.5",
                    "unit" => null
                ],
                [
                    "name" => "champignon de paris",
                    "quantities" => "41.5",
                    "unit" => "g"
                ],
                [
                    "name" => "carotte",
                    "quantities" => "0.5",
                    "unit" => null
                ],
                [
                    "name" => "courgette",
                    "quantities" => "0.25",
                    "unit" => null
                ],
                [
                    "name" => "poivron rouge",
                    "quantities" => "0.25",
                    "unit" => null
                ],
                [
                    "name" => "huile d'olive",
                    "quantities" => "1",
                    "unit" => "c.à.s"
                ],
                [
                    "name" => "poivre",
                    "quantities" => "1",
                    "unit" => "pincée"
                ],
                [
                    "name" => "sel",
                    "quantities" => "1",
                    "unit" => "pincée"
                ],
                [
                    "name" => "soja frais",
                    "quantities" => "30",
                    "unit" => "g"
                ],
                [
                    "name" => "crevette",
                    "quantities" => "83.5",
                    "unit" => "g"
                ],
                [
                    "name" => "filet de poulet",
                    "quantities" => "41.5",
                    "unit" => "g"
                ],
                [
                    "name" => "porc",
                    "quantities" => "41.5",
                    "unit" => "g"
                ],
            ],

            "Blanquette de veau à l'ancienne" => [
                [
                    "name" => "Carotte",
                    "quantities" => "1",
                    "unit" => null
                ],
                [
                    "name" => "champignon",
                    "quantities" => "50",
                    "unit" => "g"
                ],
                [
                    "name" => "oignon jaune émincés",
                    "quantities" => "33.5",
                    "unit" => "g"
                ],
                [
                    "name" => "oignon grelots",
                    "quantities" => "33.5",
                    "unit" => "g"
                ],
                [
                    "name" => "clou de girofle",
                    "quantities" => "6.6",
                    "unit" => "g"
                ],
                [
                    "name" => "poireau",
                    "quantities" => "25",
                    "unit" => "g"
                ],
                [
                    "name" => "thym",
                    "quantities" => "0.33",
                    "unit" => "branches"
                ],
                [
                    "name" => "laurier",
                    "quantities" => "5",
                    "unit" => "feuilles"
                ],
                [
                    "name" => "céléri",
                    "quantities" => "12",
                    "unit" => "g"
                ],
                [
                    "name" => "ail",
                    "quantities" => "0.33",
                    "unit" => "gousse"
                ],
                [
                    "name" => "beurre",
                    "quantities" => "16.5",
                    "unit" => "g"
                ],
                [
                    "name" => "farine",
                    "quantities" => "11.5",
                    "unit" => "g"
                ],
                [
                    "name" => "crème fraiche",
                    "quantities" => "1.5",
                    "unit" => "cl"
                ],
                [
                    "name" => "citron",
                    "quantities" => "1",
                    "unit" => "c.à.c"
                ],
                [
                    "name" => "poivre",
                    "quantities" => "1",
                    "unit" => "pincée"
                ],
                [
                    "name" => "sel",
                    "quantities" => "1",
                    "unit" => "pincée"
                ],
                [
                    "name" => "épaule de veau",
                    "quantities" => "250",
                    "unit" => "g"
                ],
                [
                    "name" => "cerfeuil",
                    "quantities" => "1",
                    "unit" => "branche"
                ],
                [
                    "name" => "jaune d'oeuf",
                    "quantities" => "1",
                    "unit" => null
                ],
            ],

            "Tagliatelles à la crème de poireaux" => [
                [
                    "name" => "tagliatelles",
                    "quantities" => "125",
                    "unit" => "g"
                ],
                [
                    "name" => "poireau",
                    "quantities" => "0.5",
                    "unit" => null
                ],
                [
                    "name" => "lardon",
                    "quantities" => "37.5",
                    "unit" => "g"
                ],
                [
                    "name" => "crème fraiche",
                    "quantities" => "25",
                    "unit" => "cl"
                ],
                [
                    "name" => "beurre",
                    "quantities" => "10",
                    "unit" => "g"
                ],
                [
                    "name" => "poivre",
                    "quantities" => "1",
                    "unit" => "pincée"
                ],
                [
                    "name" => "sel",
                    "quantities" => "1",
                    "unit" => "pincée"
                ],
                [
                    "name" => "parmesan",
                    "quantities" => "40",
                    "unit" => "g"
                ],
            ],

            "Beignets Tempura au calamar et aux légumes" => [
                [
                    "name" => "farine",
                    "quantities" => "37.5",
                    "unit" => "g"
                ],
                [
                    "name" => "eau",
                    "quantities" => "25",
                    "unit" => "cl"
                ],
                [
                    "name" => "oeuf",
                    "quantities" => "1",
                    "unit" => null
                ],
                [
                    "name" => "oignon",
                    "quantities" => "0.25",
                    "unit" => null
                ],
                [
                    "name" => "carotte",
                    "quantities" => "0.25",
                    "unit" => null
                ],
                [
                    "name" => "champignon",
                    "quantities" => "0.5",
                    "unit" => null
                ],
                [
                    "name" => "encornet",
                    "quantities" => "6",
                    "unit" => null
                ],
                [
                    "name" => "crevette",
                    "quantities" => "2",
                    "unit" => null
                ],
                [
                    "name" => "haricots verts",
                    "quantities" => "1",
                    "unit" => "poignée"
                ],
            ],

            "Salade de riz d'été facile" => [
                [
                    "name" => "Riz blanc",
                    "quantities" => "125",
                    "unit" => "g"
                ],
                [
                    "name" => "Tomate",
                    "quantities" => "30",
                    "unit" => "g"
                ],
                [
                    "name" => "Thon",
                    "quantities" => "50",
                    "unit" => "g"
                ],
                [
                    "name" => "Olive verte",
                    "quantities" => "1",
                    "unit" => "c.à.c"
                ],
                [
                    "name" => "Oeuf dur",
                    "quantities" => "0.5",
                    "unit" => null
                ],
                [
                    "name" => "Maïs",
                    "quantities" => "75",
                    "unit" => "g"
                ],
            ],

            "Parmentier de confit de canard" => [
                [
                    "name" => "Oignon",
                    "quantities" => "0.5",
                    "unit" => null
                ],
                [
                    "name" => "Pommes de terre",
                    "quantities" => "2.5",
                    "unit" => null
                ],
                [
                    "name" => "Crème fraîche",
                    "quantities" => "0.5",
                    "unit" => "c.à.s"
                ],
                [
                    "name" => "Lait",
                    "quantities" => "50",
                    "unit" => "cl"
                ],
                [
                    "name" => "Eau",
                    "quantities" => "50",
                    "unit" => "cl"
                ],
                [
                    "name" => "Muscade",
                    "quantities" => "1",
                    "unit" => "pincée"
                ],
                [
                    "name" => "Sel",
                    "quantities" => "1",
                    "unit" => "pincée"
                ],
                [
                    "name" => "Poivre",
                    "quantities" => "1",
                    "unit" => "pincée"
                ],
                [
                    "name" => "Cuisse de canard confites",
                    "quantities" => "1",
                    "unit" => null
                ],
                [
                    "name" => "Echalote",
                    "quantities" => "0.5",
                    "unit" => null
                ],
            ],

            "Rôti de boeuf à l'oignon caramélisé" => [
                [
                    "name" => "Oignon",
                    "quantities" => "0.5",
                    "unit" => null
                ],
                [
                    "name" => "ail",
                    "quantities" => "0.25",
                    "unit" => "gousse"
                ],
                [
                    "name" => "Sucre",
                    "quantities" => "0.5",
                    "unit" => "c.à.c"
                ],
                [
                    "name" => "Beurre",
                    "quantities" => "6.5",
                    "unit" => "g"
                ],
                [
                    "name" => "Lait ou Eau",
                    "quantities" => "15",
                    "unit" => "cl"
                ],
                [
                    "name" => "Thym",
                    "quantities" => "1",
                    "unit" => "branche"
                ],
                [
                    "name" => "Romarin",
                    "quantities" => "1",
                    "unit" => "branche"
                ],
                [
                    "name" => "basilic",
                    "quantities" => "8",
                    "unit" => "feuilles"
                ],
                [
                    "name" => "Poivre",
                    "quantities" => "1",
                    "unit" => "pincée"
                ],
                [
                    "name" => "Rôti de boeuf",
                    "quantities" => "250",
                    "unit" => "g"
                ],
            ],

            "Risotto aux asperges" => [
                [
                    "name" => "Riz pour risotto",
                    "quantities" => "62.5",
                    "unit" => "g"
                ],
                [
                    "name" => "Asperges déjà cuites",
                    "quantities" => "6.5",
                    "unit" => null
                ],
                [
                    "name" => "Oignon émincés",
                    "quantities" => "1",
                    "unit" => "c.à.c"
                ],
                [
                    "name" => "Huile",
                    "quantities" => "1",
                    "unit" => "c.à.c"
                ],
                [
                    "name" => "Beurre",
                    "quantities" => "6.5",
                    "unit" => "g"
                ],
                [
                    "name" => "Parmesan",
                    "quantities" => "12.5",
                    "unit" => "g"
                ],
                [
                    "name" => "Poivre",
                    "quantities" => "1",
                    "unit" => "pincée"
                ],
                [
                    "name" => "Sel",
                    "quantities" => "1",
                    "unit" => "pincée"
                ],
                [
                    "name" => "Bouillon nature",
                    "quantities" => "0.5",
                    "unit" => "cube"
                ],
            ],

            "Pizza tartiflette" => [
                [
                    "name" => "Pomme de terre",
                    "quantities" => "0.5",
                    "unit" => null
                ],
                [
                    "name" => "Lardons",
                    "quantities" => "50",
                    "unit" => "g"
                ],
                [
                    "name" => "Oignon",
                    "quantities" => "0.25",
                    "unit" => null
                ],
                [
                    "name" => "Champignons de Paris",
                    "quantities" => "2",
                    "unit" => null
                ],
                [
                    "name" => "Crème fraîche",
                    "quantities" => "1",
                    "unit" => "c.à.s"
                ],
                [
                    "name" => "Pâte à pizza",
                    "quantities" => "1",
                    "unit" => null
                ],
                [
                    "name" => "Reblochon",
                    "quantities" => "115",
                    "unit" => "g"
                ],
                [
                    "name" => "Sel",
                    "quantities" => "1",
                    "unit" => "pincée"
                ],
                [
                    "name" => "Poivre",
                    "quantities" => "1",
                    "unit" => "pincée"
                ],
                [
                    "name" => "Persil haché",
                    "quantities" => "1",
                    "unit" => "c.à.c"
                ],
            ],

            "Salade de poulpe" => [
                [
                    "name" => "Citron liquide",
                    "quantities" => "12",
                    "unit" => "cl"
                ],
                [
                    "name" => "Huile d'olive",
                    "quantities" => "1",
                    "unit" => "c.à.s"
                ],
                [
                    "name" => "Persil haché",
                    "quantities" => "5",
                    "unit" => "g"
                ],
                [
                    "name" => "Oignon haché",
                    "quantities" => "5",
                    "unit" => "g"
                ],
                [
                    "name" => "Sel",
                    "quantities" => "1",
                    "unit" => "pincée"
                ],
                [
                    "name" => "Poulpe roc",
                    "quantities" => "250",
                    "unit" => "g"
                ],
            ],

            "Tajine traditionnel (Maroc)" => [
                [
                    "name" => "pomme de terre",
                    "quantities" => "1.5",
                    "unit" => null
                ],
                [
                    "name" => "courgette",
                    "quantities" => "0.25",
                    "unit" => null
                ],
                [
                    "name" => "tomate",
                    "quantities" => "0.33",
                    "unit" => null
                ],
                [
                    "name" => "carotte",
                    "quantities" => "0.33",
                    "unit" => null
                ],
                [
                    "name" => "oignon",
                    "quantities" => "0.33",
                    "unit" => null
                ],
                [
                    "name" => "huile d'olive",
                    "quantities" => "1",
                    "unit" => "c.à.s"
                ],
                [
                    "name" => "cumin",
                    "quantities" => "1",
                    "unit" => "pincée"
                ],
                [
                    "name" => "épices marocaine",
                    "quantities" => "1",
                    "unit" => "pincée"
                ],
                [
                    "name" => "safran",
                    "quantities" => "1",
                    "unit" => "pincée"
                ],
                [
                    "name" => "sel",
                    "quantities" => "1",
                    "unit" => "pincée"
                ],
                [
                    "name" => "eau",
                    "quantities" => "25",
                    "unit" => "cl"
                ],
            ],

            "Gratin de courge butternut" => [
                [
                    "name" => "Pignons de pin",
                    "quantities" => "0.5",
                    "unit" => "c.à.s"
                ],
                [
                    "name" => "Poivre",
                    "quantities" => "1",
                    "unit" => "pincée"
                ],
                [
                    "name" => "sel",
                    "quantities" => "1",
                    "unit" => "pincée"
                ],
                [
                    "name" => "muscade",
                    "quantities" => "1",
                    "unit" => "pincée"
                ],
                [
                    "name" => "Parmesan",
                    "quantities" => "50",
                    "unit" => "g"
                ],
                [
                    "name" => "Courge butternut",
                    "quantities" => "300",
                    "unit" => "g"
                ],
                [
                    "name" => "Poitrine Fumée",
                    "quantities" => "50",
                    "unit" => "g"
                ],
                [
                    "name" => "Herbes hachées",
                    "quantities" => "1",
                    "unit" => "c.à.c"
                ],
                [
                    "name" => "Créme liquide",
                    "quantities" => "5",
                    "unit" => "cl"
                ],
            ],

            "Carpaccio d'aubergines" => [
                [
                    "name" => "Aubergine",
                    "quantities" => "1",
                    "unit" => null
                ],
                [
                    "name" => "Tomates",
                    "quantities" => "2",
                    "unit" => null
                ],
                [
                    "name" => "huile d'olive",
                    "quantities" => "1",
                    "unit" => "c.à.s"
                ],
                [
                    "name" => "Cumin",
                    "quantities" => "1",
                    "unit" => "pincée"
                ],
                [
                    "name" => "Coriandre",
                    "quantities" => "1",
                    "unit" => "c.à.c"
                ],
                [
                    "name" => "Ail",
                    "quantities" => "1",
                    "unit" => "gousse"
                ],
                [
                    "name" => "Citron",
                    "quantities" => "1",
                    "unit" => "c.à.c"
                ],
                [
                    "name" => "Vinaigre de vin blanc",
                    "quantities" => "2",
                    "unit" => "c.à.s"
                ],
                [
                    "name" => "Céleri",
                    "quantities" => "1",
                    "unit" => "feuille"
                ],
                [
                    "name" => "Basilic",
                    "quantities" => "1",
                    "unit" => "feuille"
                ],
                [
                    "name" => "Ciboulette",
                    "quantities" => "1",
                    "unit" => "feuille"
                ],
            ],

            "Feuilleté boeuf courgette" => [
                [
                    "name" => "Ail",
                    "quantities" => "0.25",
                    "unit" => "gousse"
                ],
                [
                    "name" => "Courgette",
                    "quantities" => "0.5",
                    "unit" => null
                ],
                [
                    "name" => "Boeuf haché",
                    "quantities" => "62.5",
                    "unit" => "g"
                ],
                [
                    "name" => "Huile d'olive",
                    "quantities" => "1",
                    "unit" => "c.à.s"
                ],
                [
                    "name" => "Pate feuilletée",
                    "quantities" => "0.25",
                    "unit" => null
                ],
                [
                    "name" => "Mozzarella",
                    "quantities" => "31.5",
                    "unit" => "g"
                ],
                [
                    "name" => "jaune d'oeuf",
                    "quantities" => "0.25",
                    "unit" => ""
                ],
                [
                    "name" => "Mozzarella rapée",
                    "quantities" => "50",
                    "unit" => "g"
                ],
                [
                    "name" => "Ciboulette",
                    "quantities" => "1",
                    "unit" => "feuille"
                ],
                [
                    "name" => "sel",
                    "quantities" => "1",
                    "unit" => "pincée"
                ],
                [
                    "name" => "Poivre",
                    "quantities" => "1",
                    "unit" => "pincée"
                ],
            ]
        ];

        $stepsList = [
            "Moules au curry" => [
                "1. Faire fondre le beurre et y faire rissoler l'échalote hachée finement.",
                "2. Ajouter le vin et cuire 2 mn.",
                "3. Trier, rincer les moules. Les jeter dans la casserole, couvrir et laisser cuire 5 mn après le début de l'ébullition.",
                "4. Egoutter les moules, filtrer le jus puis mélanger ce dernier avec la crème fraîche et le curry.",
                "5.Laisser réduire de moitié.",
                "6. Verser les moules et servir aussitôt.",
            ],

            "Poulet Basquaise" => [
                "Hacher l'oignon et l'ail. Couper les tomates en morceaux et détailler les poivrons en lanières.",
                "Faire chauffer 4 cuillères à soupe d'huile dans une cocotte. Y faire dorer les oignons, l'ail et les poivron. Laisser cuire 5 min.",
                "Ajouter les tomates à la cocotte, saler, poivrer. Couvrir et laisser mijoter 20 min.",
                "Dans une sauteuse, faire dorer dans l'huile d'olive les morceaux de poulet salés et poivrés.",
                "Lorsqu'ils sont dorés, les ajouter aux légumes, couvrir, ajouter le bouquet garni et le vin blanc et c'est parti pour 35 min de cuisson.",
            ],

            "Soupe de courgettes à la vache qui rit" => [
                "1. Mettre à chauffer l'eau, les cubes de bouillon, la vache qui rit, l'ail écrasé, les courgettes coupées en morceaux avec la peau; sel et poivre.",
                "2. Laisser cuire environ 40 min (quand la courgette est tendre).",
                "3. Mixer le tout, et déguster!",
            ],

            "Pave de saumon en papillotte" => [
                "1. Faire préchauffer le four à 210°C pendant 10 min.",
                "2. Eplucher, laver et couper finement les légumes.",
                "3. Couper deux feuilles de papier sulfurisé.",
                "4. Déposer, sur chaque feuille, en couches successives :",
                "- 1 blanc de poireaux,",
                "- 1 carotte,",
                "- 1/2 courgette,",
                "- 1 pavé de saumon,",
                "- 1/2 tomate,",
                "- Herbe de provence et aromate",
                "5. Rabattre légèrement le papier sulfurisé et ajouter un filet d'huile d'olive et le jus de citron.",
                "6. Fermer les papillotes en repliant le papier de chaque côté du rectangle comme pour en faire un bonbon.",
                "7. Mettre au four pendant 20 min",
            ],

            "Nouilles sautées aux légumes" => [
                "1. Laver, et émincer tous les légumes.",
                "2. Emincer la viande et le poulet.",
                "3. Dans un Wok ou une grande sauteuse, faire chauffer l’huile.",
                "4. Cuire la viande et le poulet. Saler et poivrer.",
                "5. Ajouter 40 cl d’eau. Quand elle est à ébullition, ajouter les nouilles.",
                "6. Quand toute l’eau est évaporée, ajouter la sauce soja (suivant goût), les scampis décongelés et les légumes.",
                "7. Cuire + ou – 10 min, à feu vif, en remuant. Il faut que les légumes restent croquants !",
            ],
            
            "Blanquette de veau à l'ancienne" => [
                "1. Mettre les petits oignons à tremper dans un bol d'eau froide. Couper le veau en gros dés. Peler les carottes et les couper en gros bâtons. Peler les oignons jaunes, les piquer avec les clous de girofle. Laver et émincer en julienne le poireau et le céleri, et les mettre en bouquet garni avec le thym et le laurier. Eplucher les gousses d'ail.",
                "2. Dans une cocotte-minute, placer la viande, les carottes, le bouquet garni, les oignons piqués et les gousses d'ail. Couvrir d'eau, assaisonner et faire mijoter pendant 1 h.",
                "3. Découper les champignons en lamelles.",
                "4. Egoutter les champignons.",
                "5. Dans une casserole, faire bouillir 20 cl d'eau et le jus du demi-citron. Saler et y plonger les champignons pendant 3 min à feu vif.",
                "6. Egoutter et éplucher les petits oignons.",
                "7. Les faire \"glacer\" dans une casserole avec 30 g de beurre et 1 verre d'eau. Saler et laisser cuire 25 min.",
                "8. Dans une casserole, faire fondre le reste de beurre et y ajouter la farine. Remuer et laisser roussir quelques minutes, en fouettant. Laisser refroidir.",
                "9. Lorsque la viande a fini de mijoter, récupérer 1 litre de bouillon, le filtrer et le verser dans la casserole contenant le roux beurre + farine en fouettant. Porter le tout à ébullition et laisser chauffer 5 min à feu doux. Assaisonner.",
                "10. Battre les jaunes d'oeufs et y incorporer la crème. Ajouter une louche de bouillon, délayer et reverser le tout dans la casserole.",
                "11. Egoutter la viande, les carottes, les oignons et les champignons, les recouvrir de la sauce bien chaude. Arroser avec le jus du 1/2 citron et servir.",
                "12. On peut aussi réserver le tout dans une casserole et réchauffer à feu très doux avant de servir.",
            ],
            
            "Tagliatelles à la crème de poireaux" => [
                "1. Laver puis couper les poireaux en fines rondelles,",
                "2. les mettre à fondre environ 15 min dans une poêle avec un bon morceau de beurre (remuer souvent).",
                "3. Mettre les tagliatelles à cuire comme indiqué sur le paquet.",
                "4. Attendre que les poireaux soient bien fondus et ajouter les lardons, faire dorer.",
                "5. Hors du feu, mettre la crème fraîche et remuer, poivrer et saler à votre goût.",
                "6. Egouter les tagliatelles, les mettre dans un plat et verser la sauce aux poireaux dessus.",
                "7. Ajouter du parmesan râpé.",
                "8. Servir aussitôt.",
            ],
            
            "Beignets Tempura au calamar et aux légumes" => [
                "1. Faire tremper les champignons dans de l'eau chaude 20 mn. Les couper en lanières de 5 mm et les remettre dans l'eau en attendant.",
                "2. Emincer les carottes en bâtonnets de 5 mm de côté et de 5 cm de long.",
                "3. Emincer l'oignon comme la carotte.",
                "4. Préparer la pâte à beignets: remplir un verre de 20 cl de farine, la verser dans un saladier.",
                "5. Casser l'oeuf dans le verre et compléter avec de l'eau. Mélanger le contenu du verre, puis verser progressivement sur la farine en remuant avec des baguettes, une fourchette ou un fouet pour les moins patients.",
                "6. Mettre tous les ingrédients dans la pâte (y compris les lamelles d'encornet cru et les crevettes), remuer. Former des tas entre deux cuillères à soupe, égoutter un peu et faire glisser dans un bain de friture chaud. Cuire 5 mn et égoutter sur du papier absorbant.",
                "7. Servir chaud.",
            ],
            
            "Salade de riz d'été facile" => [
                "1. Cuire le riz à l'eau bouillante salée.",
                "2. Une fois cuit, le rincer à l'eau froide pour enlever l'amidon.",
                "3. Quand le riz est froid, ajouter les oeufs coupés en lamelles, les tomates en dés, les olives, le maïs et le thon en miettes.",
                "4. Réserver au réfrigérateur puis servir frais.",
            ],
            
            "Parmentier de confit de canard" => [
                "1. Lavez et épluchez les pommes de terre, et mettez-les à cuire dans un grand volume d'eau salée.",
                "2. Réchauffez les cuisses de canard au bain-marie pour les extraire de leur graisse.",
                "3. Conservez une cuillère à soupe de graisse de canard.",
                "4. Découpez et hachez grossièrement les cuisses confites (surtout pas de mixer !).",
                "5. Emincer les échalotes et les oignons.",
                "6. Dans une large poêle ou une sauteuse, faites blondir les oignons et les échalotes hachés dans la cuillère à soupe de graisse de canard, à feu très doux.",
                "7. Lorsque ce mélange oignons + échalotes est bien blond, ajoutez le hachis de canard et mettez à feu vif, en mélangeant vivement, pendant 5 minutes. Le hachis de canard doit être finement grillé en surface, mais rester moelleux. Réservez hors du feu.",
                "8. Ecrasez vos pommes de terre à la fourchette (pitié, pas de presse-purée !) et faites une purée moelleuse en ajoutant 50 % d'eau et 50 % de lait.",
                "9. Salez, poivrez, ajoutez une pincée de muscade et la crème fraîche.",
                "10. Préchauffez le four à 200°C (thermostat 6-7).",
                "11. Dans un plat suffisamment haut, étalez la moitié de votre hachis de canard.",
                "12. Mélangez la moitié qui reste avec le même volume de purée, et étalez cette deuxième couche sur la première. Finissez par une troisième couche de purée.",
                "13. Striez le sommet de votre purée avec le dos d'une fourchette.",
                "14. Laissez cuire à four chaud (200°C) pendant 25 min. Vous pouvez également finir la cuisson 3 minutes sous le gril pour obtenir un joli gratiné.",
                "15. Servez avec une salade (mâche, par exemple) et un Cahors léger: ce plat ne paye pas de mine, mais vos convives seront très agréablement surpris !",
            ],
           
            "Rôti de boeuf à l'oignon caramélisé" => [
                "1. Sortir le rôti du réfrigérateur 30 minutes avant la préparation et le laisser à l'air ambiant.",
                "2. Couper l'ail en fines lamelles.",
                "3. Avec un couteau fin et aiguisé, faire de petites incisions dans le rôti et glisser dedans les lamelles d'ail.",
                "4. Avec un morceau de beurre, badigeonner tout le rôti.",
                "5. Emincer les oignons.",
                "6. Faire fondre la moitié du beurre et l'huile dans une poêle à feu vif puis y faire revenir les oignons avec le sucre.",
                "7. Ajouter les herbes.",
                "8. Une fois que les oignons ont bruni, griller rapidement le rôti sur chaque face avec les oignons et le retirer.",
                "9. Mettre le rôti dans un plat allant au four et mettre les oignons caramélisés par dessus.",
                "10. Mettre au four préchauffé à 250°C (thermostat 8-9) et laisser cuire 10 minutes.",
                "11. Sortir du four, déglacer avec le lait, poivrer, et laisser cuire encore environ 10 minutes. Ajuster le temps de cuisson en fonction de votre préférence : viande bien cuite ou saignante.",
                "12. Bon appétit !",
            ],
            
            "Risotto aux asperges" => [
                "1. Couper les asperges en 5 (réserver les pointes), puis couper l'oignon en petits cubes.",
                "2. Faire chauffer 1 cuillère à soupe d'huile et de beurre. Faire fondre 1/2 oignon, sans le faire brunir!",
                "3. Ajouter le riz passé sous l'eau au préalable, les morceaux d'asperges et laisser revenir quelque minutes jusqu'à ce que le riz devienne translucide.",
                "4. Mouiller avec de l'eau et ajouter le sel, le poivre et le bouillon cube. Ne pas mettre trop d'eau, et mouiller le riz de temps en temps.",
                "5. Une fois le riz cuit (al dente), le sortir du feu. Ajouter une noix de beurre, une bonne poignée de parmesan; puis laisser reposer 5 min.",
                "6. Servir et ajouter sur le dessus les pointes d'asperges, que vous aurez fait légèrement revenir dans du beurre.",
            ],
            
            "Pizza tartiflette" => [
                "1. Faire cuire les pommes de terre à la vapeur.",
                "2. Faire revenir les lardons.",
                "3. Une fois cuits, faire revenir dans le jus des lardons l'oignon et les champignons.",
                "4. Mélanger le tout et assaisonner avec le sel le poivre et le persil.",
                "5. Etaler la pâte à pizza, puis napper le fond avec la crème fraîche.",
                "6. Eplucher les pommes de terre et les disposer sur la crème, recouvrir de la préparation et de cubes de reblochon.",
                "7. Faire cuire à four chaud (180°C/th 6).",
                "8. Servir et déguster",
            ],
            
            "Salade de poulpe" => [
                "1. Nettoyer minutieusement le poulpe. Il faut nettoyer chaque ventouse.",
                "2. Ouvrer le corps, et retirer les viscères ainsi que les 2 mandibules.",
                "3. Une fois le poulpe nettoyé, le réserver.",
                "4. Préparer une marmite d'eau salée bouillante.",
                "5. Piquer le poulpe à l'aide d'une fourchette et le plonger dans l'eau pendant quelques secondes, ensuite le retirer.",
                "6. Répéter ces opérations trois fois de suite, puis laisser le poulpe cuire entre 30 à 40min, il est cuit une fois que l'on peut le traverser facilement à l'aide d'une fourchette.",
                "7. Dans un saladier, préparer la vinaigrette, en mettant le jus de citron, l'huile d'olive, le persil et l'oignon.",
                "8. Une fois le poulpe cuit, le découper en petits morceaux et laisser le refoidir, incorporer les morceaux à la vinaigrette et mettre au frigo quelques heures.",
            ],
            
            "Tajine traditionnel (Maroc)" => [
                "1.Verser 3/4 de cuillère à soupe d'huile dans le plat à tajine directement posé sur le feu ou la plaque.",
                "2.Lorsque l'huile est bien chaude, faire revenir la viande de chaque côté (environ 10 min).",
                "3.Baisser un peu le feu et placer les légumes, lavés et découpés grossièrement, en pyramide sur la viande, des plus fermes aux plus tendres (pommes de terre, puis carotte, puis courgettes, puis oignons), en les intercalant de cumin, 14 épices, sel et poivre.",
                "4.Arroser d'un peu d'eau, saupoudrer de safran jaune, pour donner de la couleur et déposer les olives vertes.",
                "5.Couvrir et laisser cuire à feu doux, pendant 30 mn.",
                "6.Au bout de ce temps, placer sur les légumes cuits, les tomates coupées en morceaux, couvrir et laisser cuire encore 15mn.",
                "7.Servir chaud, directement sur la table, accompagné de thé et de pain sans levain.",
            ],
            
            "Gratin de courge butternut" => [
                "1.A l'aide d'un bon couteau, couper la butternut en cubes de 3 cm environ, et éplucher ensuite les morceaux (c'est plus facile dans cet ordre). Cuire les morceaux 5 mn à la vapeur ou dans un fond d'eau non salée. Les morceaux doivent être tendres, mais ne pas s'effondrer.",
                "2.Pendant la cuisson, hacher grossièrement la poitrine fumée (ou la couper en tout petits morceaux).",
                "3.Disposer les morceaux de courge et de poitrine dans un plat à gratin, en mélangeant délicatement (si la courge s'écrase un peu, ce n'est pas grave). Parsemer d'herbes hachées et de pignons de pin à votre goût.",
                "4.Assaisonner de noix de muscade et de poivre. Saler très légèrement, car la poitrine fumée est déjà salée (personnellement, je ne sale pas du tout, mais je force sur la noix de muscade). Verser une lichette de crème liquide (je dois mettre à peu près 5 cl), et finir par saupoudrer de parmesan râpé.",
                "5.Enfourner 20 mn environ dans un four préchauffé à 210°C.",
                "6.Servir bien chaud, accompagné d'une salade verte.",
            ],
            
            "Carpaccio d'aubergines" => [
                "1.Faire préchauffer le four en position grill.",
                "2.Laver l'aubergine, et la débiter en fines rondelles (idéalement à l'aide d'une mandoline).",
                "3.Faire de même avec les tomates, supprimez les pépins.",
                "4.Disposer les rondelles de tomates sur une assiette inclinée. Saler et laisser s'égoutter.",
                "5.Recouvrir la plaque à four de papier sulfurisé.",
                "6.Étaler les rondelles d'aubergine sur le papier sulfurisé. Les huiler légèrement avec un pinceau.",
                "7.Faire griller au four pendant 4 minutes.",
                "8.Retourner les rondelles d'aubergine à l'aide d'une spatule. Les huiler à nouveau, et remettre au four 2 min.",
                "9.Laisser refroidir.",
                "10.Hacher finement une tête d'ail. Ciseler les feuilles de céleri.",
                "11.Dans un bol, mélanger le jus de citron avec le vinaigre de vin blanc.",
                "12.Ajouter l'ail, le céleri, le cumin et la coriandre.",
                "13.Verser l'huile en fouettant la vinaigrette énergiquement.",
                "14.Disposer alternativement dans un plat (ou directement dans les assiettes) les rondelles de tomates et d'aubergine.",
                "15.Arroser de vinaigrette.",
                "16.Recouvrir de film étirable.",
                "17.Laisser reposer au réfrigérateur environ 4 h.",
                "18.Décorer avec la ciboulette et les feuilles de basilic au moment de servir.",
            ],
            
            "Feuilleté boeuf courgette" => [
                "1.Couper les courgettes dans la longueur en lamelles pas trop fines.",
                "2.Faire revenir dans une casserole avec de l'huile d'olive, l'ail et la viande",
                "3.Saler et poivrer, faire cuire 3 minutes",
                "4.Ajouter les courgettes en gardant quelques lamelles pour la décoration",
                "5.Laisser revenir trois à quatre minutes",
                "6.Découper 4 rectangles la pâte feuilletée.",
                "7.Les farcir avec la viande et la mozzarella",
                "8.Les refermer comme un bonbon en les nouant aux extrémités avec des bandes de papier sulfurisé humidifiées.",
                "9.Enfourner pendant 20 minutes à 200°C",
                "10.Sortir du four et remplacer les bandes de papier par de la ciboulette. Et déposer joliment des lamelles de courgettes dans l'ouverture et ajouter un filet d'huile d'olive et de la ciboulette ciselée.",
            ],
        ];

        foreach($recipesList as $key => $recipe) {
            $newRecipe = new Recipes();

            $newRecipe->setName($recipe["name"]);
            $newRecipe->setPicture($recipe["picture"]);

            // je set les ingredient pour une recette
            foreach($ingredientsList[$newRecipe->getName()] as $ingredient) {
                $newIngredient = new Ingredients();

                $newIngredient->setName($ingredient["name"]);
                $newIngredient->setQuantities($ingredient["quantities"]);
                $newIngredient->setUnit($ingredient["unit"]);

                $manager->persist($newIngredient);

                $newRecipe->addIngredient($newIngredient);
            }

            // je set les étapes pour une recettes
            foreach($stepsList[$newRecipe->getName()] as $step) {
                $newStep = new Steps();

                $newStep->setText($step);

                $manager->persist($newStep);

                $newRecipe->addStep($newStep);
            }

            $manager->persist($newRecipe);
        }

        $manager->flush();
    }
}

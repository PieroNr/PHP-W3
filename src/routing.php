<?php
/**
 * Classe permettant le routing
 */
class Routes {


    private $routes = array();
    private $routesName = array();
    private $routesPath = array();
    private $routesControlleur = array();
    private $routesAction = array();
    private $idRoutes = 0;
    private $routeIndexName;
    private $routeIndexPath;
    private $routeIndexControlleur;
    private $routeIndexAction;
    private $error404 = false;

    /**
     *
     * @param string $routeName
     * @param string $urlPath
     * @param string $controller
     * @param string $action
     */
    public function initRoute($routeName, $urlPath, $controller, $action) {
        // On remplit les attributs de la class par des tableaux associatifs qui correspondent à l'id d'une route
        $this->routesName[$routeName] = $this->idRoutes;
        $this->routesPath[$urlPath] = $this->idRoutes;
        $this->routesControlleur[$controller] = $this->idRoutes;
        $this->routesAction[$action] = $this->idRoutes;

        // On remplit un tableau qui à comme clef l'id de la route et comme valeurs les données de la route
        $this->routes[$this->idRoutes] = array("name" => $routeName, "path" => $urlPath, "controlleur" => $controller, "action" => $action);

        // Le nombre de routes augmente, on met à jour notre id
        $this->idRoutes++;
    }

    /**
     *
     * @param string $routeName
     * @return string
     */
    public function urlFor($routeName) {
        // Si la route existe, on retourne son URL
        if (array_key_exists($routeName, $this->routesName)) {
            return "/" . $this->routes[$this->routesName[$routeName]]["path"];
        } elseif ($routeName == $this->routeIndexName) { // Sinon, on test si la route correspond à la page d'accueil
            return "/" . $this->routeIndexPath;
        } else { // Sinon, on retourne une chaîne vide
            return "";
        }
    }

    /**
     *
     * @param string $urlPath
     * @return array|bool
     */
    public function getControlleur($urlPath) {
        // Si l'URL existe, on retourne le contrôleur et l'action associés
        if (array_key_exists($urlPath, $this->routesPath)) {
            return array($this->routes[$this->routesPath[$urlPath]]["controlleur"], $this->routes[$this->routesPath[$urlPath]]["action"]);
        } elseif ($urlPath == null || $urlPath == "" || $urlPath == $this->routeIndexName) { // Si l'URL correspond à la page d'accueil, on retourne son template
            return array($this->routeIndexControlleur, $this->routeIndexAction);
        } else { // Sinon on déclare une erreur 404
            return $this->error404 = true;
        }
    }

    /**
     *
     * @param string $routeName
     * @param string $urlPath
     * @param string $template
     */
    public function initIndexRoute($routeName, $urlPath, $template) {
        $this->routeIndexName = $routeName;
        $this->routeIndexPath = $urlPath;
        $this->routeIndexControlleur = $template;
        $this->routeIndexAction = 'index';
    }

    /**
     * Retourne true s'il y a une erreur 404
     * @return boolean
     */
    public function isError404() {
        if ($this->error404 == true) {
            return true;
        }
        return false;
    }

}
<?php
function routeString() {
    $returnValue = null;
    $request = getParam();
    $requestAction = (empty($request['action']))?'':$request['action'];
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (!empty($request['page']) && $request['page'] == 'ban') {
            switch ($requestAction) {
                case 'create': $returnValue = 'GET_BAN_CREATE'; break;
                case 'edit': $returnValue = 'GET_BAN_EDIT'; break;
                case 'show': $returnValue = 'GET_BAN_SHOW'; break;
                default: $returnValue = 'GET_BAN_INDEX';
            }
        }
        if (!empty($request['page']) && $request['page'] == 'user') {
            switch ($requestAction) {
                case 'create': $returnValue = 'GET_USER_CREATE'; break;
                case 'edit': $returnValue = 'GET_USER_EDIT'; break;
                case 'show': $returnValue = 'GET_USER_SHOW'; break;
                default: $returnValue = 'GET_USER_INDEX';
            }
        }
        if (empty($request['page']) && empty($request['action'])) {
            $returnValue = 'GET_HOME';
        }
    } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (!empty($request['page']) && $request['page'] == 'ban') {
            switch ($requestAction) {
                case 'store': $returnValue = 'POST_BAN_STORE'; break;
                case 'update': $returnValue = 'POST_BAN_UPDATE'; break;
                case 'delete': $returnValue = 'POST_BAN_DELETE'; break;
            }
        }
        if (!empty($request['page']) && $request['page'] == 'user') {
            switch ($requestAction) {
                case 'store': $returnValue = 'POST_USER_STORE'; break;
                case 'update': $returnValue = 'POST_USER_UPDATE'; break;
                case 'delete': $returnValue = 'POST_USER_DELETE'; break;
            }
        }
    }
    return $returnValue;
}

function route($name,$id=0) {
    $idStr = ($id!=0)?'&id='.$id:'';
    switch ($name) {
        case 'GET_HOME': return 'index.php'; break;
        case 'GET_BAN_CREATE': return 'index.php?page=ban&action=create'; break;
        case 'GET_BAN_EDIT': return 'index.php?page=ban&action=edit'.$idStr; break;
        case 'GET_BAN_SHOW': return 'index.php?page=ban&action=show'.$idStr; break;
        case 'GET_BAN_INDEX': return 'index.php?page=ban'; break;
        case 'GET_USER_CREATE': return 'index.php?page=user&action=create'; break;
        case 'GET_USER_EDIT': return 'index.php?page=user&action=edit'.$idStr; break;
        case 'GET_USER_SHOW': return 'index.php?page=user&action=show'.$idStr; break;
        case 'GET_USER_INDEX': return 'index.php?page=user'; break;
        case 'POST_BAN_STORE': return 'index.php'; break;
        case 'POST_BAN_UPDATE': return 'index.php'; break;
        case 'POST_BAN_DELETE': return 'index.php'; break;
        case 'POST_USER_STORE': return 'index.php'; break;
        case 'POST_USER_UPDATE': return 'index.php'; break;
        case 'POST_USER_DELETE': return 'index.php'; break;
        default: return '';
    }
}

function getParam() {
    $param = [];
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        foreach($_GET as $key => $value) {
            $param[$key] = trim(htmlentities(strip_tags($value), ENT_QUOTES | ENT_IGNORE, "UTF-8"));
        }
    } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
        foreach($_POST as $key => $value) {
            $param[$key] = trim(htmlentities(strip_tags($value), ENT_QUOTES | ENT_IGNORE, "UTF-8"));
        }
    } else {
        foreach($_REQUEST as $key => $value) {
            $param[$key] = trim(htmlentities(strip_tags($value), ENT_QUOTES | ENT_IGNORE, "UTF-8"));
        }
    }
    return $param;
}

function redirect($routeName) {
    global $dbConnection;
    $routePath = route($routeName);
    $uri = $_SERVER['REQUEST_URI'];
    $parts = explode('/',$uri);
    $dir = $_SERVER['SERVER_NAME'];
    for ($i=0;$i<count($parts)-1;$i++) $dir .= $parts[$i]."/";
    $prefix = "http://".$dir;
    $url = $prefix.$routePath;
    $dbConnection->close();
    if (strlen(trim($routePath))>0) header( 'Location: '.$url) ;
    else header( 'Location: '.$prefix) ;
    exit();
}
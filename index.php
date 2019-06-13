<?php
use TrainingMvc\HomeController;
use TrainingMvc\BanController;
use TrainingMvc\UserController;

//===========================================
// kết nối database
require_once 'db_connection.php'; // chèn file db_connection
$dbConnection = dbOpen(); // mở kết nối database

//===========================================
// thực hiện route
require_once 'routes/web.php'; // chèn file route
$routeString = routeString(); // lấy chuỗi định danh route
$request = getParam(); // lấy tham số client gửi lên
//-------------------------------------------
require_once 'controllers/HomeController.php'; // chèn file HomeController
require_once 'controllers/BanController.php'; // chèn file BanController
require_once 'controllers/UserController.php'; // chèn file UserController
//-------------------------------------------
switch ($routeString) { // gọi method@controller tương ứng với chuỗi định danh route
    case 'GET_HOME': $controller = new HomeController(); $controller->index(); break;
    case 'GET_BAN_CREATE': $controller = new BanController(); $controller->create(); break;
    case 'GET_BAN_EDIT': $controller = new BanController(); $controller->edit($request); break;
    case 'GET_BAN_SHOW': $controller = new BanController(); $controller->show($request); break;
    case 'GET_BAN_INDEX': $controller = new BanController(); $controller->index(); break;
    case 'GET_USER_CREATE': $controller = new UserController(); $controller->create(); break;
    case 'GET_USER_EDIT': $controller = new UserController(); $controller->edit($request); break;
    case 'GET_USER_SHOW': $controller = new UserController(); $controller->show($request); break;
    case 'GET_USER_INDEX': $controller = new UserController(); $controller->index(); break;
    case 'POST_BAN_STORE': $controller = new BanController(); $controller->store($request); break;
    case 'POST_BAN_UPDATE': $controller = new BanController(); $controller->update($request); break;
    case 'POST_BAN_DELETE': $controller = new BanController(); $controller->destroy($request); break;
    case 'POST_USER_STORE': $controller = new UserController(); $controller->store($request); break;
    case 'POST_USER_UPDATE': $controller = new UserController(); $controller->update($request); break;
    case 'POST_USER_DELETE': $controller = new UserController(); $controller->destroy($request); break;
    default: echo 'Lỗi 404 PAGE NOT FOUND';
}

//============================================
// chạy hàm đóng kết nối database
$dbConnection->close();
<?php
require_once __DIR__ . '/../controllers/EtudiantController.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($uri) {
    case '/tp_php/public/':
        case '/tp_php/public/index.php':
            include __DIR__ . '/../views/login.php';
            break;

    case '/tp_php/public/register':
        EtudiantController::store();
        break;

    case '/tp_php/public/inscription':
        EtudiantController::create();
        break;

    case '/tp_php/public/login':
        EtudiantController::loginForm();
        break;
    
    case '/tp_php/public/loginpost':
        EtudiantController::login();
        break;

    case '/tp_php/public/soumission':
        include __DIR__ . '/../views/soumission.php';
        break;
            
    case '/tp_php/public/submit':
        EtudiantController::submitProject();
        break;
        
    case '/tp_php/public/affectation':
        include __DIR__ . '/../views/affectation.php';
        break;   
        
    case '/tp_php/public/liste':
        include __DIR__ . '/../views/liste.php';
        break;   

    default:
        http_response_code(404);
        echo "Page non trouvée pour $uri";
}

<?php

switch ($script_url) {

    case '/inscriptions/' :
    case '/inscriptions/home/' :
        $home = new home();
        echo $home->display();
    break;

    case '/inscriptions/upload/' :
        include('src/upload.php');
    break;

    case '/inscriptions/atachements/delete/' :
        include('src/delete_file.php');
    break;


    case '/inscriptions/profile/' :    
        $profile = new profile();
        echo $profile->edit();
    break;


    case '/inscriptions/update-email/' :
        $profile = new profile();
        echo $profile->email();
    break;


    case '/inscriptions/update-password/' :
        $profile = new profile();
        echo $profile->password();
    break;


    case '/inscriptions/characters/' :
        $characters = new characters();
        echo $characters->getList();
    break;


    case '/inscriptions/characters/edit/' :
        $characters = new characters();
        echo $characters->edit();
    break;


    case '/inscriptions/characters/erase/' :
        $characters = new characters();
        echo $characters->erase();
    break;


    case '/inscriptions/events/' :
        $event = new events();
        echo $event->getList();
    break;


    case '/inscriptions/events/register/' :
        $event = new events();
        echo $event->register();
    break;


    case '/inscriptions/cards/' :
        $card = new cards();
        echo $card->getList();
    break;

    case '/inscriptions/cards/edit/' :
        $card = new cards();
        echo $card->edit();
    break;

    case '/inscriptions/cards/erase/' :
        $card = new cards();
        echo $card->erase();
    break;

    case '/inscriptions/events/sheet/' :
        $event = new events();
        echo $event->displayCharacterSheet();
    break;

    default :

        /*************************************************************/
        /* SI LA SESSION N'EST PAS UN ADMIN, ON REDIRIGE VERS home */
        /*************************************************************/
        if (!isset($_SESSION['player']['admin']) || $_SESSION['player']['admin'] == 0) {
            header('Location: /inscriptions');
            die();
        }

        if ($maintenance->isLock() == 2) {
            echo $maintenance->screenLock(false);
            die();
        }

        $no_player_page = true;

}
<?php

switch ($script_url) {

    case '/inscriptions/admin/news/' :
        $news = new news();
        echo $news->getAdminList();
    break;

    case '/inscriptions/admin/news/edit/' :
        $news = new news();
        echo $news->edit();
    break;

    case '/inscriptions/admin/news/erase/' :
        $news = new news();
        echo $news->erase();
    break;


    case '/inscriptions/admin/races/' :
        $races = new races();
        echo $races->getAdminList();
    break;

    case '/inscriptions/admin/races/edit/' :
        $races = new races();
        echo $races->edit();
    break;

    case '/inscriptions/admin/races/erase/' :
        $races = new races();
        echo $races->erase();
    break;



    case '/inscriptions/admin/corporations/' :
        $corporations = new corporations();
        echo $corporations->getAdminList();
    break;

    case '/inscriptions/admin/corporations/edit/' :
        $corporations = new corporations();
        echo $corporations->edit();
    break;

    case '/inscriptions/admin/corporations/erase/' :
        $corporations = new corporations();
        echo $corporations->erase();
    break;


    case '/inscriptions/admin/professions/' :
        $professions = new professions();
        echo $professions->getAdminList();
    break;

    case '/inscriptions/admin/professions/edit/' :
        $professions = new professions();
        echo $professions->edit();
    break;

    case '/inscriptions/admin/professions/erase/' :
        $professions = new professions();
        echo $professions->erase();
    break;



    case '/inscriptions/admin/players/' :
        $players = new players();
        echo $players->getAdminList();
    break;

    case '/inscriptions/admin/players/display/' :
        $players = new players();
        echo $players->display();
    break;

    case '/inscriptions/admin/players/erase/' :
        $players = new players();
        echo $players->erase();
    break;

    case '/inscriptions/admin/players/lock/' :
        $players = new players();
        echo $players->lock();
    break;

    case '/inscriptions/admin/players/connectas/' :
        $players = new players();
        echo $players->connectas();
    break;

    case '/inscriptions/admin/players/send/' :
        $players = new players();
        echo $players->send();
    break;

    case '/inscriptions/admin/players/back/' :
        $players = new players();
        echo $players->back();
    break;



    case '/inscriptions/admin/characters/' :
        $characters = new characters();
        echo $characters->getAdminList();
    break;

    case '/inscriptions/admin/characters/display/' :
        $characters = new characters();
        echo $characters->display();
    break;

    case '/inscriptions/admin/characters/erase/' :
        $characters = new characters();
        echo $characters->adminErase();
    break;

    case '/inscriptions/admin/characters/kill/' :
        $characters = new characters();
        echo $characters->kill();
    break;

    case '/inscriptions/admin/characters/rankup/' :
        $characters = new characters();
        echo $characters->rankup();
    break;

    case '/inscriptions/admin/characters/health/' :
        $characters = new characters();
        echo $characters->healthcheck();
    break;    

    case '/inscriptions/admin/characters/edit/' :
        $characters = new characters();
        echo $characters->adminEdit();
    break;



    case '/inscriptions/admin/options/' :
        $event_options = new eventOptions();
        echo $event_options->getAdminList();
    break;

    case '/inscriptions/admin/options/edit/' :
        $event_options = new eventOptions();
        echo $event_options->edit();
    break;

    case '/inscriptions/admin/options/erase/' :
        $event_options = new eventOptions();
        echo $event_options->erase();
    break;

    case '/inscriptions/admin/options/lock/' :
        $event_options = new eventOptions();
        echo $event_options->lock();
    break;



    case '/inscriptions/admin/events/' :
        $events = new events();
        echo $events->getAdminList();
    break;

    case '/inscriptions/admin/events/edit/' :
        $events = new events();
        echo $events->edit();
    break;

    case '/inscriptions/admin/events/erase/' :
        $events = new events();
        echo $events->erase();
    break;

    case '/inscriptions/admin/events/registrations/' :
        $events = new events();
        echo $events->showRegistrations();
    break;

    case '/inscriptions/admin/events/excel/' :
        $events = new events();
        echo $events->downloadListExcel();
    break;



    case '/inscriptions/admin/attendees/' :
        $events = new events();
        echo $events->getAttendeesList();
    break;

    case '/inscriptions/admin/attendees/display/' :
        $events = new events();
        echo $events->displayAttendees();
    break;

    case '/inscriptions/admin/events/attendees/print/' :
        $events = new events();
        echo $events->printAttendees();
    break;


    case '/inscriptions/admin/maintenance/' :
        $maintenance = new maintenance();
        echo $maintenance->edit();
    break;
    



    case '/inscriptions/admin/ressources/' :
        $ressources = new ressources();
        echo $ressources->getAdminList();
    break;

    case '/inscriptions/admin/ressources/edit/' :
        $ressources = new ressources();
        echo $ressources->edit();
    break;

    case '/inscriptions/admin/ressources/erase/' :
        $ressources = new ressources();
        echo $ressources->erase();
    break;


    case '/inscriptions/admin/recipes/' :
        $recipes = new recipes();
        echo $recipes->getAdminList();
    break;

    case '/inscriptions/admin/recipes/edit/' :
        $recipes = new recipes();
        echo $recipes->edit();
    break;

    case '/inscriptions/admin/recipes/erase/' :
        $recipes = new recipes();
        echo $recipes->erase();
    break;


    case '/inscriptions/admin/feats/' :
        $feats = new feats();
        echo $feats->getAdminList();
    break;

    case '/inscriptions/admin/feats/edit/' :
        $feats = new feats();
        echo $feats->edit();
    break;

    case '/inscriptions/admin/feats/erase/' :
        $feats = new feats();
        echo $feats->erase();
    break;


    case '/inscriptions/admin/skills/' :
        $skills = new skills();
        echo $skills->getAdminList();
    break;

    case '/inscriptions/admin/skills/edit/' :
        $skills = new skills();
        echo $skills->edit();
    break;

    case '/inscriptions/admin/skills/erase/' :
        $skills = new skills();
        echo $skills->erase();
    break;


    case '/inscriptions/admin/planets/' :
        $planets = new planets();
        echo $planets->getAdminList();
    break;

    case '/inscriptions/admin/planets/edit/' :
        $planets = new planets();
        echo $planets->edit();
    break;

    case '/inscriptions/admin/planets/erase/' :
        $planets = new planets();
        echo $planets->erase();
    break;
    

    default :
        
        if (isset($no_player_page) && $no_player_page) {
            http_response_code(404);
            $template = get_template('navbar', array('active_menu' => '404'));
            $template .= get_template('404', array());

            echo render($template);
            die();

        }

}
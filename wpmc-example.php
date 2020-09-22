<?php
/*
* Plugin Name: WP Magic Crud Example
* Description: Provides a clean example of how to use Magic admin CRUD plugin for WordPress plugin
* Version:     1.0
* Author:      Moises Heberle
* License:     GPLv2 or later
* License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

defined( 'ABSPATH' ) or die( 'Not allowed' );

add_action('wpmc_entities', function($entities){
    $entities['team'] = [
        'table_name' => 'mc_teams',
        'default_order' => 'name',
        'display_field' => 'name',
        'singular' => 'Team',
        'plural' => 'Teams',
        'fields' => [
            'name' => [
                'label' => 'Name',
                'type' => 'text',
                'required' => true,
                'flags' => ['list','sort','view','add','edit'],
            ],
            'players' => [
                'label' => 'Players',
                'type' => 'one_to_many',
                'ref_entity' => 'player',
                'ref_column' => 'team_id',
                'flags' => ['list','sort','view','add','edit'],
            ],
        ]
    ];

    $entities['player'] = [
        'table_name' => 'mc_players',
        'default_order' => 'name',
        'display_field' => 'name',
        'singular' => 'Player',
        'plural' => 'Players',
        'fields' => [
            'name' => [
                'label' => 'Name',
                'type' => 'text',
                'required' => true,
                'flags' => ['list','sort','view','add','edit'],
            ],
            'lastname' => [
                'label' => 'Last name',
                'type' => 'text',
                'flags' => ['list','sort','view','add','edit'],
            ],
            'email' => [
                'label' => 'E-mail',
                'type' => 'email',
                'flags' => ['list','sort','view','add','edit'],
            ],
            'team_id' => [
                'label' => 'Team',
                'type' => 'belongs_to',
                'ref_entity' => 'team',
                'required' => true,
                'flags' => ['list','sort','view','add','edit'],
            ],
        ]
    ];

    $entities['game'] = [
        'table_name' => 'mc_games',
        'default_order' => 'name',
        'display_field' => 'name',
        'singular' => 'Game',
        'plural' => 'Games',
        'fields' => [
            'name' => [
                'label' => 'Name',
                'type' => 'text',
                'required' => true,
                'flags' => ['list','sort','view','add','edit'],
            ],
            'players' => [
                'label' => 'Players',
                'type' => 'has_many',
                'ref_entity' => 'player',
                'pivot_table' => 'mc_game_players',
                'pivot_left' => 'game_id',
                'pivot_right' => 'player_id',
                'flags' => ['list','sort','view','add','edit'],
            ],
        ]
    ];

    return $entities;
}, 10, 2);
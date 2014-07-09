<?php

/***************************************************************
 * Extension Manager/Repository config file for ext: "dm_simplecalendar"
 *
 * Manual updates:
 * Only the data in the array - anything else is removed by next write.
 * "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array(
    'title' => 'SimpleCalendar',
    'description' => 'With this extension you can create appointments and display them in a calendar view.',
    'category' => 'plugin',
    'author' => 'Salvatore Eckel, Kai Ratzeburg',
    'author_email' => 'salvaracer@gmx.de, hello@kai-ratzeburg.de',
    'author_company' => 'Die Medialen GmbH',
    'shy' => '',
    'priority' => '',
    'module' => '',
    'state' => 'beta',
    'internal' => '',
    'uploadfolder' => '0',
    'createDirs' => '',
    'modify_tables' => '',
    'clearCacheOnLoad' => 0,
    'lockType' => '',
    'version' => '0.1.2',
    'constraints' => array(
        'depends' => array(
            'typo3' => '6.0.0-6.2.99',
        ),
        'conflicts' => array(
        ),
        'suggests' => array(
        ),
    ),
);
?>
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
    'description' => '',
    'category' => 'plugin',
    'author' => 'Kai Ratzeburg, Salvatore Eckel',
    'author_email' => 'hello@kai-ratzeburg.de, salvatore.eckel@diemedialen.de',
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
    'version' => '0.1.1',
    'constraints' => array(
        'depends' => array(
            'extbase' => '6.0',
            'fluid' => '6.0',
            'typo3' => '6.0',
        ),
        'conflicts' => array(
        ),
        'suggests' => array(
        ),
    ),
);
?>
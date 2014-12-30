<?php
if (!defined ('TYPO3_MODE')) {
    die ('Access denied.');
}

$TCA['tx_dmsimplecalendar_domain_model_appointment'] = array(
    'ctrl' => $TCA['tx_dmsimplecalendar_domain_model_appointment']['ctrl'],
    'interface' => array(
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, startdate, enddate, location, description, shortdescription, calendar, categories, media, pre_appointment',
    ),
    'types' => array(
        '1' => array('showitem' => 'title, startdate, enddate, location, description, shortdescription, calendar, categories, pre_appointment,--div--;Referenzen,media,--div--;Translate,sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource;;1,--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,starttime, endtime,hidden, '),
    ),
    'palettes' => array(
        '1' => array('showitem' => ''),
    ),
    'columns' => array(
        'sys_language_uid' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
            'config' => array(
                'type' => 'select',
                'foreign_table' => 'sys_language',
                'foreign_table_where' => 'ORDER BY sys_language.title',
                'items' => array(
                    array('LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1),
                    array('LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0)
                ),
            ),
        ),
        'l10n_parent' => array(
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
            'config' => array(
                'type' => 'select',
                'items' => array(
                    array('', 0),
                ),
                'foreign_table' => 'tx_dmsimplecalendar_domain_model_appointment',
                'foreign_table_where' => 'AND tx_dmsimplecalendar_domain_model_appointment.pid=###CURRENT_PID### AND tx_dmsimplecalendar_domain_model_appointment.sys_language_uid IN (-1,0)',
            ),
        ),
        'l10n_diffsource' => array(
            'config' => array(
                'type' => 'passthrough',
            ),
        ),
        't3ver_label' => array(
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            )
        ),
        'hidden' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
            'config' => array(
                'type' => 'check',
            ),
        ),
        'title' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:dm_simplecalendar/Resources/Private/Language/locallang_db.xlf:tx_dmsimplecalendar_domain_model_appointment.title',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ),
        ),
        'starttime' => array(
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
            'config' => array(
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0,
                'range' => array(
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ),
            ),
        ),
        'endtime' => array(
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
            'config' => array(
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0,
                'range' => array(
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ),
            ),
        ),
        'location' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:dm_simplecalendar/Resources/Private/Language/locallang_db.xlf:tx_dmsimplecalendar_domain_model_appointment.location',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'description' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:dm_simplecalendar/Resources/Private/Language/locallang_db.xlf:tx_dmsimplecalendar_domain_model_appointment.description',
            'config' => array(
                'type' => 'text',
                'cols' => '40',
                'rows' => '15',
                'wrap' => 'off',
                'eval' => 'trim'
            ),
            'defaultExtras' => 'richtext[]'
        ),
        'shortdescription' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:dm_simplecalendar/Resources/Private/Language/locallang_db.xlf:tx_dmsimplecalendar_domain_model_appointment.shortdescription',
            'config' => array(
                'type' => 'text',
                'cols' => '40',
                'rows' => '10',
                'wrap' => 'off',
                'eval' => 'trim'
            ),
            //'defaultExtras' => 'richtext[]'
        ),
        'startdate' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:dm_simplecalendar/Resources/Private/Language/locallang_db.xlf:tx_dmsimplecalendar_domain_model_appointment.startdate',
            'config' => array(
                'type' => 'input',
                'size' => 10,
                'eval' => 'datetime,required',
                'checkbox' => 1,
                'default' => time()
            ),
        ),
        'enddate' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:dm_simplecalendar/Resources/Private/Language/locallang_db.xlf:tx_dmsimplecalendar_domain_model_appointment.enddate',
            'config' => array(
                'type' => 'input',
                'size' => 10,
                'eval' => 'datetime',
                'checkbox' => 1,
                'default' => time()
            ),
        ),
        'calendar' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:dm_simplecalendar/Resources/Private/Language/locallang_db.xlf:tx_dmsimplecalendar_domain_model_appointment.calendar',
            'config' => array(
                'type' => 'inline',
                'foreign_table' => 'tx_dmsimplecalendar_domain_model_calendar',
                'minitems' => 0,
                'maxitems' => 1,
                'appearance' => array(
                    'collapseAll' => 0,
                    'levelLinksPosition' => 'top',
                    'showSynchronizationLink' => 1,
                    'showPossibleLocalizationRecords' => 1,
                    'showAllLocalizationLink' => 1
                ),
            ),
        ),
        'calendar' => array(
            'config' => array(
                'type' => 'passthrough',
            ),
        ),
        'media' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:dm_simplecalendar/Resources/Private/Language/locallang_db.xlf:tx_dmsimplecalendar_domain_model_appointment.media',
            'label' => 'Media',
            'config' => array(
                'type' => 'inline',
                'foreign_table' => 'tx_dmsimplecalendar_domain_model_media',
                'minitems' => 0,
                'maxitems' => 1,
                'appearance' => array(
                    'collapseAll' => 0,
                    'levelLinksPosition' => 'top',
                    'showSynchronizationLink' => 1,
                    'showPossibleLocalizationRecords' => 1,
                    'showAllLocalizationLink' => 1
                ),
            ),
        ),
    ),
);

?>
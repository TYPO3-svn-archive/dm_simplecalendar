<?php
if (!defined ('TYPO3_MODE')) {
    die ('Access denied.');
}

$TCA['tx_dmsimplecalendar_domain_model_appointment'] = array(
    'ctrl' => $TCA['tx_dmsimplecalendar_domain_model_appointment']['ctrl'],
    'interface' => array(
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, startdate, enddate, location, description, shortdescription, calendar, attachments, categories, pre_appointment',
    ),
    'types' => array(
        '1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title, startdate, enddate, location, description, shortdescription, calendar, attachments, categories, pre_appointment,--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,starttime, endtime'),
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
            'defaultExtras' => 'richtext[]'
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
        'categories' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:dm_simplecalendar/Resources/Private/Language/locallang_db.xlf:tx_dmsimplecalendar_domain_model_appointment.categories',
            'config' => array(
                'type' => 'select',
                'foreign_table' => 'tx_dmsimplecalendar_domain_model_category',
                'MM' => 'tx_dmsimplecalendar_appointment_category_mm',
                'size' => 10,
                'autoSizeMax' => 30,
                'maxitems' => 9999,
                'multiple' => 0,
                'wizards' => array(
                    '_PADDING' => 1,
                    '_VERTICAL' => 1,
                    'edit' => array(
                        'type' => 'popup',
                        'title' => 'Edit',
                        'script' => 'wizard_edit.php',
                        'icon' => 'edit2.gif',
                        'popup_onlyOpenIfSelected' => 1,
                        'JSopenParams' => 'height=600,width=580,status=0,menubar=0,scrollbars=1',
                        ),
                    'add' => Array(
                        'type' => 'script',
                        'title' => 'Create new',
                        'icon' => 'add.gif',
                        'params' => array(
                            'table' => 'tx_dmsimplecalendar_domain_model_category',
                            'pid' => '###CURRENT_PID###',
                            'setValue' => 'prepend'
                            ),
                        'script' => 'wizard_add.php',
                    ),
                ),
            ),
        ),
        'attachments' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:dm_simplecalendar/Resources/Private/Language/locallang_db.xlf:tx_dmsimplecalendar_domain_model_appointment.attachments',
            'config' => array(
                'type' => 'select',
                'foreign_table' => 'tx_dmsimplecalendar_domain_model_attachment',
                'MM' => 'tx_dmsimplecalendar_appointment_attachment_mm',
                'size' => 5,
                'max' => 5,
                'autoSizeMax' => 5,
                'maxitems' => 9999,
                'multiple' => 0,
                'wizards' => array(
                    '_PADDING' => 1,
                    '_VERTICAL' => 1,
                    'edit' => array(
                        'type' => 'popup',
                        'title' => 'Edit',
                        'script' => 'wizard_edit.php',
                        'icon' => 'edit2.gif',
                        'popup_onlyOpenIfSelected' => 1,
                        'JSopenParams' => 'height=600,width=580,status=0,menubar=0,scrollbars=1',
                        ),
                    'add' => Array(
                        'type' => 'script',
                        'title' => 'Create new',
                        'icon' => 'add.gif',
                        'params' => array(
                            'table' => 'tx_dmsimplecalendar_domain_model_attachment',
                            'pid' => '###CURRENT_PID###',
                            'setValue' => 'prepend'
                            ),
                        'script' => 'wizard_add.php',
                    ),
                ),
            ),
        ),
    ),
);

?>
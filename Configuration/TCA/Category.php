<?php
if (!defined ('TYPO3_MODE')) {
    die ('Access denied.');
}

$TCA['tx_dmsimplecalendar_domain_model_category'] = array(
    'ctrl' => $TCA['tx_dmsimplecalendar_domain_model_category']['ctrl'],
    'interface' => array(
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, color',
    ),
    'types' => array(
        '1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title, color,--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,starttime, endtime'),
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
                'foreign_table' => 'tx_dmsimplecalendar_domain_model_category',
                'foreign_table_where' => 'AND tx_dmsimplecalendar_domain_model_category.pid=###CURRENT_PID### AND tx_dmsimplecalendar_domain_model_category.sys_language_uid IN (-1,0)',
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
        'title' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:dm_simplecalendar/Resources/Private/Language/locallang_db.xlf:tx_dmsimplecalendar_domain_model_category.title',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ),
        ),
        'color' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:dm_simplecalendar/Resources/Private/Language/locallang_db.xlf:tx_dmsimplecalendar_domain_model_category.color',
            'config' => array(
                'type' => 'input',
                'size' => 10,
                'eval' => 'trim',
                'wizards' => array(
                        'colorChoice' => array(
                                'type' => 'colorbox',
                                'title' => 'LLL:EXT:dm_simplecalendar/Resources/Private/Language/locallang_db.xlf:tx_dmsimplecalendar_domain_model_category.color',
                                'module' => array(
                                        'name' => 'wizard_colorpicker',
                                ),
                                'dim' => '25x25',
                                'tableStyle' => 'border: solid 1px black; margin-left: 20px;',
                                'JSopenParams' => 'height=850,width=640,status=0,menubar=0,scrollbars=1',
                                'exampleImg' => 'EXT:dm_simplecalendar/Resources/Public/Images/colorScale.png',
                        )
                )
            ),
        ),
    ),
);

?>
<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "me_placeholder".
 *
 * Auto generated 09-10-2012 13:49
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array(
    'title' => 'm:e Placeholder',
    'description' => 'Find marker in source code and replace it with editable content. To edit content is a RTE available. ' .
        'For placeholder you can set a storage page id. Furthermore you can individual pages exclude from replacement.',
    'category' => 'fe',
    'version' => '1.1.2',
    'state' => 'stable',
    'uploadfolder' => false,
    'createDirs' => null,
    'clearcacheonload' => false,
    'author' => 'move:elevator',
    'author_email' => 'typo3@move-elevator.de',
    'author_company' => 'move:elevator',
    'constraints' =>
        array(
            'depends' =>
                array(
                    'typo3' => '6.2.0-7.6.99'
                ),
        ),
);

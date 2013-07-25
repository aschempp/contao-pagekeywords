<?php

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2010 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 *
 * PHP version 5
 * @copyright  terminal42 gmbh 2009-2013
 * @author     Andreas Schempp <andreas.schempp@terminal42.ch>
 * @license    LGPL
 */


/**
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_page']['palettes']['regular']	= preg_replace('@([,|;]description)([,|;])@', '$1,keywords$2', $GLOBALS['TL_DCA']['tl_page']['palettes']['regular']);
$GLOBALS['TL_DCA']['tl_page']['palettes']['root']		= str_replace(';{dns_legend}', ',description,keywords;{dns_legend}', $GLOBALS['TL_DCA']['tl_page']['palettes']['root']);


/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_page']['fields']['keywords'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_page']['keywords'],
	'exclude'                 => true,
	'inputType'               => 'textarea',
	'eval'                    => array('style'=>'height:60px;', 'tl_class'=>'clr'),
);


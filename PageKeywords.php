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


class PageKeywords extends Frontend
{

	public function addPageKeywords($objPageRegular, $objLayout)
	{
		global $objPage;

		// Search parent pages
		if (!strlen($objPage->keywords) || !strlen($objPage->keywords))
		{
			$objTrail = $this->Database->execute("SELECT * FROM tl_page WHERE id IN (" . implode(',', $objPage->trail) . ") ORDER BY id=" . implode(' DESC, id=', array_reverse($objPage->trail)) . " DESC");

			while( $objTrail->next() )
			{
				if (in_array($objTrail->type, array('forward', 'redirect', 'error_403', 'error_404')))
					continue;

				if (!strlen($objPage->keywords) && strlen($objTrail->keywords))
				{
					$objPage->keywords = $objTrail->keywords;
				}

				if (!strlen($objPage->description) && strlen($objTrail->description))
				{
					$objPage->description = $objTrail->description;
				}

				if (strlen($objPage->keywords) && strlen($objPage->description))
				{
					break;
				}
			}
		}

		if (strlen($objPage->keywords))
		{
			$GLOBALS['TL_KEYWORDS'] = $objPage->keywords . (strlen($GLOBALS['TL_KEYWORDS']) ? (',' . $GLOBALS['TL_KEYWORDS']) : '');
		}
	}
}


<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * TYPOlight webCMS
 * Copyright (C) 2005 Leo Feyer
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 2.1 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at http://www.gnu.org/licenses/.
 *
 * PHP version 5
 * @copyright  Andreas Schempp 2009
 * @author     Andreas Schempp <andreas@schempp.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
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


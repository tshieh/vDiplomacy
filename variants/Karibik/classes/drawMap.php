<?php
/*
	Copyright (C) 2011 Oliver Auth

	This file is part of the Karibik variant for webDiplomacy

	The Karibik variant for webDiplomacy is free software: you can redistribute
	it and/or modify it under the terms of the GNU Affero General Public License 
	as published by the Free Software Foundation, either version 3 of the License,
	or (at your option) any later version.

	The Karibik variant for webDiplomacy is distributed in the hope that it will be
	useful, but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. 
	See the GNU General Public License for more details.

	You should have received a copy of the GNU Affero General Public License
	along with webDiplomacy. If not, see <http://www.gnu.org/licenses/>.

*/

defined('IN_CODE') or die('This script can not be run by itself.');

// Transform command
class Transform_drawMap extends drawMap
{
	private $trafo=array();
	
	public function drawSupportHold($fromTerrID, $toTerrID, $success)
	{
		if ($toTerrID < 1000) return parent::drawSupportHold($fromTerrID, $toTerrID, $success);
		
		$toTerrID = $toTerrID - 1000;
		if ($success)
			$this->trafo[$fromTerrID]=$toTerrID;

		$this->drawTransform($fromTerrID, $toTerrID, $success);
	}
	
	// If a unit did a transform draw the new unit-type on the board instead of the old...
	public function addUnit($terrID, $unitType)
	{
		if (array_key_exists($terrID,$this->trafo))
			return parent::addUnit($this->trafo[$terrID], ($unitType == 'Fleet' ? 'Army' : 'Fleet'));
		parent::addUnit($terrID, $unitType);
	}

	// Draw the transformation circle:
	protected function drawTransform($fromTerrID, $toTerrID, $success)
	{
	
		$terrID = ($success ?  $toTerrID : $fromTerrID);
		
		if ( $fromTerrID != $toTerrID )
			$this->drawMove($fromTerrID,$toTerrID, $success);
		
		$darkblue  = $this->color(array(40, 80,130));
		$lightblue = $this->color(array(70,150,230));
		
		list($x, $y) = $this->territoryPositions[$terrID];
		
		$width=($this->fleet['width'])+($this->fleet['width'])/2;
		
		imagefilledellipse ( $this->map['image'], $x, $y, $width, $width, $darkblue);
		imagefilledellipse ( $this->map['image'], $x, $y, $width-2, $width-2, $lightblue);
		
		if ( !$success ) $this->drawFailure(array($x-1, $y),array($x+2, $y));
	}
}

class KaribikVariant_drawMap extends Transform_drawMap
{
	protected $countryColors = array(
		0 => array(226, 198, 158), // Neutral
  		1 => array(114, 146, 103), // Brasil
  		2 => array(160, 138, 117), // Columbia
  		3 => array(196, 143, 133), // Cuba
		4 => array(164, 196, 153), // Mexico
  		5 => array(168, 126, 159), // Paraquay
		6 => array(121, 175, 198), // Peru
  		7 => array( 64, 108, 128), // USA
  		8 => array(234, 234, 175), // Venezuela
	);

	protected function resources() {
		if( $this->smallmap )
		{
			return array(
				'map'     =>'variants/Karibik/resources/smallmap.png',
				'army'    =>'contrib/smallarmy.png',
				'fleet'   =>'contrib/smallfleet.png',
				'names'   =>'variants/Karibik/resources/smallmapNames.png',
				'standoff'=>'images/icons/cross.png'
			);
		}
		else
		{
			return array(
				'map'     =>'variants/Karibik/resources/map.png',
				'army'    =>'contrib/army.png',
				'fleet'   =>'contrib/fleet.png',
				'names'   =>'variants/Karibik/resources/mapNames.png',
				'standoff'=>'images/icons/cross.png'
			);
		}
	}
	
	protected function color(array $color, $image=false)
	{
		if ( ! is_array($image) )
			$image = $this->map;

		list($r, $g, $b) = $color;

		$colorRes = imagecolorexact($image['image'], $r, $g, $b);
		if ($colorRes == -1)
			$colorRes = imageColorAllocate($image['image'], $r, $g, $b);

 		return $colorRes;
 	}	
}

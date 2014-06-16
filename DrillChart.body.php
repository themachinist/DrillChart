<?php
/**
 * DrillChart.php -- Drill/Tap size chart for mediawiki
 *
 *  This program is free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program; if not, write to the Free Software
 *  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 *
 * @file
 * @ingroup Extensions
 * @author Evan Prodromou <evan@vinismo.com>
 */

if ( !defined( 'MEDIAWIKI' ) ) {
	exit( 1 );
}

class SpecialDrillChart extends SpecialPage {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct( 'DrillChart' );
		$wgSpecialPageGroups[ 'DrillChart' ] => 'specialpages-group-chartstoolsandcalculators';
	}

	function execute( $par ) {
		$this->addResourceModules();

		$request = $this->getRequest();
		$output = $this->getOutput();

		$output->addModules( array( 'flexigrid', 'ext.DrillChart' ) );
		$this->setHeaders();
		$output->addWikiText( '<noscript>You must enable javascript to use this page.</noscript><table class="flexigrid"></table>' );
	}

	function addResourceModules() {
		$wgResourceModules['ext.DrillChart'] = array(
		'scripts' => array( 'js/ext.DrillChart.js' ),
		'localBasePath' => __DIR__,
		'remoteExtPath' => 'DrillChart'
		);
	}

	function parseChartDatabase() {
		$csv = 'DrillChart.csv';
		$array = array_map("str_getcsv", explode("\n", $csv));
		return json_encode($array);
	}
}
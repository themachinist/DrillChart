<?php
/**
* DrillChart.php -- Use a DrillChart-based interface to start new articles
* Copyright 2007 Vinismo, Inc. (http://vinismo.com/)
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
*  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-USA
*
* @file
* @ingroup Extensions
* @author Evan Prodromou <evan@vinismo.com>
*/

/** I know that I am not supposed to do any of the crap that follows this comment
 * but I really don't care about this non-production extension adhering to MW standards
 * Can't really see an ROI for doing it that way.
 */
if ($_GET['data']) {
	$csv = file_get_contents('TapDrill_Chart.csv');
	$array = array_map("str_getcsv", explode("\n", $csv));
	echo json_encode($array);
	exit(1);
}

# credits
$wgExtensionCredits['ext.flexigrid'][] = array(
    'path' => __FILE__,
    'name' => 'Flexigrid Extension',
    'author' => 'David Winslow @the_machinist_', 
    'url' => 'https://www.mediawiki.org/wiki/Extension:Flexigrid', 
    'description' => 'Add Flexigrid support to mediawiki tables',
    'version'  => 0,
    'license-name' => "n/a",
);

$wgAutoloadClasses['SpecialDrillChart'] = $dir . 'DrillChart.body.php'; # Tell MediaWiki to load the extension body.
$wgExtensionMessagesFiles['DrillChart'] = $dir . 'DrillChart.i18n.php'; # Load internationalization file
$wgExtensionMessagesFiles['DrillChartAliases'] = $dir . 'DrillChart.alias.php';
$wgSpecialPages['DrillChart'] = 'SpecialDrillChart'; # Let MediaWiki know about your new special page.
?>
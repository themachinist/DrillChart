<?php
/**
* DrillChart.php
* @file
* @ingroup Extensions
* @author David Winslow <the@machini.st>
*/

# credits
$wgExtensionCredits['DrillChart'][] = array(
    'path' => __FILE__,
    'name' => 'Drill Chart Extension',
    'author' => 'David Winslow @the_machinist_', 
    'url' => 'https://www.mediawiki.org/wiki/Extension:DrillChart', 
    'description' => 'Add Flexigrid support to mediawiki tables',
    'version'  => 0,
    'license-name' => "n/a",
);
$wgResourceModules['ext.DrillChart'] = array(
	'scripts' => 'ext.DrillChart.js',
	'localBasePath' => __DIR__,
	'remoteExtPath' => 'DrillChart',
	'position' => 'top'
);
$wgResourceModules['flexigrid'] = array(
	'scripts' => 'js/flexigrid.js',
	'localBasePath' => "$IP/extensions/Flexigrid",
	'remoteExtPath' => 'Flexigrid',
	'styles' => array('css/flexigrid.css' => array( 'media' => 'screen' ) )
);

$dir = __DIR__ . '/';
$wgAutoloadClasses['SpecialDrillChart'] = $dir . 'DrillChart.body.php'; # Tell MediaWiki to load the extension body.
$wgExtensionMessagesFiles['DrillChart'] = $dir . 'DrillChart.i18n.php'; # Load internationalization file
$wgExtensionMessagesFiles['DrillChartAliases'] = $dir . 'DrillChart.alias.php';
$wgSpecialPages['DrillChart'] = 'SpecialDrillChart'; # Let MediaWiki know about your new special page.
?>

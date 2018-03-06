<?php
use Cake\Core\Configure;

$pm_defalut_price = [
    'SSMESH' => 116.6,
    'SECDRFRM' => 9.65,
    'SECDRCRNSTK' => 0.88,
    'SECWNFRM9' => 5.08,
    'SECWNCRNSTK9' => 0.66,
    '7MMDG' => 29.21,
    'DGDRFRM' => 5.65,
    'DGDRCRNSTK' => 0.7,
	'DGWNFRM9' => 4.58,
	'INSPETMSH' => 3.27,
	'INSMSH' => 1.68,
	'INSDRFRM' => 6.75,
	'INSDRCRNSTK' => 0.7,
	'INSWNFRM9' => 1.53,
	'INSWNCRNSTK9' => 0.22,
	'PERFMESH' => 55,
	'SECDRWDGPT2' => 0,
	'SECDRWDGPT1' => 4.93,
	'HNG' => 0.97,
	'SNGLOCKSLD' => 29.52,
	'SNGLOCKHNG' => 27.47,
	'TRPLOCKSLD' => 42.11,
	'TRPLOCKHNG' => 41.42,
	'LCKCYL' => 8,
	'INSSPLN' => 0.51,
	'PERFWEG' => 4.93,
];

$config = ['PM_DEFAULT_PRICE' =>  $pm_defalut_price];

?>
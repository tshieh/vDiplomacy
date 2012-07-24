<?php
// This is file installs the map data for the AnarchyInTheUK variant
defined('IN_CODE') or die('This script can not be run by itself.');
require_once("variants/install.php");

InstallTerritory::$Territories=array();
$countries=$this->countries;
$territoryRawData=array(
	array('North Atlantic', 'Sea', 'No', 0, 91, 198, 52, 185),
	array('Niarbyl Bay', 'Sea', 'No', 0, 220, 226, 130, 163),
	array('Douglas Bay', 'Sea', 'No', 0, 349, 230, 222, 176),
	array('Irish Sea', 'Sea', 'No', 0, 41, 619, 21, 392),
	array('Menai Straits', 'Sea', 'No', 0, 214, 353, 137, 304),
	array('Mersey Estuary', 'Sea', 'No', 0, 376, 344, 251, 248),
	array('Cardigan Bay', 'Sea', 'No', 0, 178, 561, 108, 412),
	array('N.Bristol Channel', 'Sea', 'No', 0, 267, 688, 136, 528),
	array('S.Bristol Channel', 'Sea', 'No', 0, 192, 819, 114, 576),
	array('Avon Estuary', 'Sea', 'No', 0, 430, 711, 264, 530),
	array('English Channel', 'Sea', 'No', 0, 377, 971, 186, 695),
	array('South Coast', 'Sea', 'No', 0, 564, 891, 423, 650),
	array('Straights of Dover', 'Sea', 'No', 0, 925, 922, 664, 654),
	array('Dutch Crossing', 'Sea', 'No', 0, 973, 758, 672, 490),
	array('Thames Estuary', 'Sea', 'No', 0, 927, 619, 629, 458),
	array('Humber Estuary', 'Sea', 'No', 0, 919, 422, 601, 248),
	array('North Sea', 'Sea', 'No', 0, 972, 131, 655, 115),
	array('Northeast Coast', 'Sea', 'No', 0, 758, 125, 526, 145),
	array('Cumbria', 'Coast', 'Yes', 0, 445, 187, 297, 148),
	array('Northumberland', 'Coast', 'Yes', 2, 540, 49, 356, 66),
	array('Tyne & Wear', 'Coast', 'Yes', 2, 587, 117, 397, 84),
	array('Durham', 'Coast', 'Yes', 2, 544, 173, 373, 120),
	array('Cleveland', 'Coast', 'Yes', 0, 628, 181, 435, 128),
	array('Lancashire', 'Coast', 'No', 0, 473, 289, 316, 231),
	array('N.Yorkshire', 'Coast', 'No', 0, 642, 234, 405, 183),
	array('Merseyside', 'Coast', 'Yes', 1, 453, 367, 305, 266),
	array('W.Yorkshire', 'Land', 'Yes', 0, 568, 308, 399, 226),
	array('Humberside', 'Coast', 'Yes', 0, 676, 333, 460, 235),
	array('N.Lincolnshire', 'Coast', 'Yes', 6, 755, 400, 490, 282),
	array('Derbyshire & Nottinghamshire', 'Land', 'No', 0, 608, 447, 407, 328),
	array('S.Yorkshire', 'Land', 'No', 0, 600, 369, 413, 268),
	array('Cheshire', 'Coast', 'Yes', 1, 483, 390, 319, 303),
	array('Greater Manchester', 'Land', 'Yes', 0, 513, 370, 349, 271),
	array('Staffordshire', 'Land', 'No', 0, 534, 483, 355, 326),
	array('Shropshire', 'Land', 'No', 0, 466, 490, 310, 353),
	array('S.Lincolnshire', 'Coast', 'Yes', 6, 715, 468, 490, 341),
	array('Leicestershire', 'Land', 'Yes', 0, 626, 516, 429, 379),
	array('W.Midlands', 'Land', 'Yes', 0, 564, 547, 386, 392),
	array('Warwickshire', 'Land', 'No', 0, 609, 548, 396, 427),
	array('Hereford & Worcester', 'Land', 'No', 0, 464, 609, 305, 438),
	array('Gloucestershire', 'Coast', 'Yes', 4, 535, 631, 358, 462),
	array('Oxfordshire', 'Land', 'No', 0, 607, 641, 406, 464),
	array('Northants.', 'Land', 'Yes', 0, 639, 584, 437, 422),
	array('Cambs.', 'Land', 'No', 0, 750, 563, 516, 412),
	array('Norfolk', 'Coast', 'Yes', 6, 843, 500, 583, 373),
	array('Suffolk', 'Coast', 'No', 0, 854, 586, 588, 429),
	array('Essex', 'Coast', 'No', 0, 796, 653, 552, 476),
	array('Hertfs.', 'Land', 'No', 0, 737, 628, 504, 458),
	array('Beds.', 'Land', 'No', 0, 695, 618, 479, 443),
	array('Bucks.', 'Land', 'No', 0, 673, 669, 459, 479),
	array('London', 'Land', 'Yes', 3, 739, 707, 517, 510),
	array('Kent', 'Coast', 'Yes', 3, 834, 750, 579, 549),
	array('E.Sussex', 'Coast', 'Yes', 0, 773, 776, 534, 562),
	array('Surrey', 'Land', 'Yes', 3, 690, 751, 493, 538),
	array('W.Sussex', 'Coast', 'No', 0, 702, 777, 459, 591),
	array('Hampshire', 'Coast', 'No', 0, 618, 785, 418, 568),
	array('Berkshire', 'Land', 'No', 0, 665, 705, 455, 513),
	array('Wiltshire', 'Land', 'Yes', 4, 542, 745, 362, 554),
	array('Dorset', 'Coast', 'Yes', 0, 524, 830, 320, 598),
	array('Somerset', 'Coast', 'Yes', 0, 461, 769, 301, 548),
	array('Avon', 'Coast', 'Yes', 4, 487, 688, 325, 503),
	array('Devon', 'Coast', 'No', 0, 365, 814, 217, 605),
	array('Devon (North Coast)', 'Coast', 'No', 5, 330, 780, 187, 570),
	array('Devon (South Coast)', 'Coast', 'No', 5, 342, 866, 219, 624),
	array('Cornwall', 'Coast', 'Yes', 0, 264, 850, 131, 643),
	array('Isle of White', 'Coast', 'Yes', 0, 615, 834, 423, 611),
	array('Gwent', 'Coast', 'No', 0, 438, 647, 292, 471),
	array('Glamorgan', 'Coast', 'Yes', 5, 394, 693, 257, 503),
	array('S.Powys', 'Land', 'Yes', 0, 390, 626, 256, 452),
	array('Dyfed', 'Coast', 'Yes', 5, 337, 608, 203, 452),
	array('Dyfed (North Coast)', 'Coast', 'No', 5, 325, 565, 212, 409),
	array('Dyfed (South Coast)', 'Coast', 'No', 5, 310, 642, 197, 458),
	array('Pembrokeshire', 'Coast', 'Yes', 5, 237, 659, 161, 471),
	array('N.Powys', 'Land', 'Yes', 0, 385, 539, 253, 387),
	array('Gwynedd', 'Coast', 'No', 0, 349, 470, 220, 342),
	array('Clwyd', 'Coast', 'No', 0, 408, 440, 267, 315),
	array('Anglesey', 'Coast', 'Yes', 1, 300, 393, 188, 287),
	array('Isle of Man', 'Coast', 'Yes', 1, 282, 235, 175, 168)
);

foreach($territoryRawData as $territoryRawRow)
{
	list($name, $type, $supply, $countryID, $x, $y, $sx, $sy)=$territoryRawRow;
	new InstallTerritory($name, $type, $supply, $countryID, $x, $y, $sx, $sy);
}
unset($territoryRawData);

$bordersRawData=array(
	array('North Atlantic','Niarbyl Bay','Yes','No'),
	array('North Atlantic','Irish Sea','Yes','No'),
	array('North Atlantic','Menai Straits','Yes','No'),
	array('North Atlantic','North Sea','Yes','No'),
	array('Niarbyl Bay','Douglas Bay','Yes','No'),
	array('Niarbyl Bay','Menai Straits','Yes','No'),
	array('Niarbyl Bay','Isle of Man','Yes','No'),
	array('Douglas Bay','Menai Straits','Yes','No'),
	array('Douglas Bay','Mersey Estuary','Yes','No'),
	array('Douglas Bay','Cumbria','Yes','No'),
	array('Douglas Bay','Lancashire','Yes','No'),
	array('Douglas Bay','Isle of Man','Yes','No'),
	array('Irish Sea','Menai Straits','Yes','No'),
	array('Irish Sea','Cardigan Bay','Yes','No'),
	array('Irish Sea','N.Bristol Channel','Yes','No'),
	array('Irish Sea','S.Bristol Channel','Yes','No'),
	array('Irish Sea','English Channel','Yes','No'),
	array('Menai Straits','Mersey Estuary','Yes','No'),
	array('Menai Straits','Cardigan Bay','Yes','No'),
	array('Menai Straits','Gwynedd','Yes','No'),
	array('Menai Straits','Anglesey','Yes','No'),
	array('Mersey Estuary','Lancashire','Yes','No'),
	array('Mersey Estuary','Merseyside','Yes','No'),
	array('Mersey Estuary','Cheshire','Yes','No'),
	array('Mersey Estuary','Gwynedd','Yes','No'),
	array('Mersey Estuary','Clwyd','Yes','No'),
	array('Cardigan Bay','N.Bristol Channel','Yes','No'),
	array('Cardigan Bay','Dyfed (North Coast)','Yes','No'),
	array('Cardigan Bay','Pembrokeshire','Yes','No'),
	array('Cardigan Bay','Gwynedd','Yes','No'),
	array('N.Bristol Channel','S.Bristol Channel','Yes','No'),
	array('N.Bristol Channel','Avon Estuary','Yes','No'),
	array('N.Bristol Channel','Glamorgan','Yes','No'),
	array('N.Bristol Channel','Dyfed (South Coast)','Yes','No'),
	array('N.Bristol Channel','Pembrokeshire','Yes','No'),
	array('S.Bristol Channel','Avon Estuary','Yes','No'),
	array('S.Bristol Channel','English Channel','Yes','No'),
	array('S.Bristol Channel','Devon (North Coast)','Yes','No'),
	array('S.Bristol Channel','Cornwall','Yes','No'),
	array('Avon Estuary','Gloucestershire','Yes','No'),
	array('Avon Estuary','Somerset','Yes','No'),
	array('Avon Estuary','Avon','Yes','No'),
	array('Avon Estuary','Devon (North Coast)','Yes','No'),
	array('Avon Estuary','Gwent','Yes','No'),
	array('Avon Estuary','Glamorgan','Yes','No'),
	array('English Channel','South Coast','Yes','No'),
	array('English Channel','Straights of Dover','Yes','No'),
	array('English Channel','Cornwall','Yes','No'),
	array('South Coast','Straights of Dover','Yes','No'),
	array('South Coast','Dutch Crossing','Yes','No'),
	array('South Coast','E.Sussex','Yes','No'),
	array('South Coast','W.Sussex','Yes','No'),
	array('South Coast','Hampshire','Yes','No'),
	array('South Coast','Dorset','Yes','No'),
	array('South Coast','Devon (South Coast)','Yes','No'),
	array('South Coast','Cornwall','Yes','No'),
	array('South Coast','Isle of White','Yes','No'),
	array('Straights of Dover','Dutch Crossing','Yes','No'),
	array('Dutch Crossing','Thames Estuary','Yes','No'),
	array('Dutch Crossing','Humber Estuary','Yes','No'),
	array('Dutch Crossing','North Sea','Yes','No'),
	array('Dutch Crossing','Kent','Yes','No'),
	array('Dutch Crossing','E.Sussex','Yes','No'),
	array('Thames Estuary','Humber Estuary','Yes','No'),
	array('Thames Estuary','Suffolk','Yes','No'),
	array('Thames Estuary','Essex','Yes','No'),
	array('Thames Estuary','Kent','Yes','No'),
	array('Humber Estuary','North Sea','Yes','No'),
	array('Humber Estuary','Northeast Coast','Yes','No'),
	array('Humber Estuary','Humberside','Yes','No'),
	array('Humber Estuary','N.Lincolnshire','Yes','No'),
	array('Humber Estuary','S.Lincolnshire','Yes','No'),
	array('Humber Estuary','Norfolk','Yes','No'),
	array('Humber Estuary','Suffolk','Yes','No'),
	array('North Sea','Northeast Coast','Yes','No'),
	array('North Sea','Northumberland','Yes','No'),
	array('Northeast Coast','Northumberland','Yes','No'),
	array('Northeast Coast','Tyne & Wear','Yes','No'),
	array('Northeast Coast','Durham','Yes','No'),
	array('Northeast Coast','Cleveland','Yes','No'),
	array('Northeast Coast','N.Yorkshire','Yes','No'),
	array('Northeast Coast','Humberside','Yes','No'),
	array('Cumbria','Northumberland','No','Yes'),
	array('Cumbria','Durham','No','Yes'),
	array('Cumbria','Lancashire','Yes','Yes'),
	array('Cumbria','N.Yorkshire','No','Yes'),
	array('Northumberland','Tyne & Wear','Yes','Yes'),
	array('Northumberland','Durham','No','Yes'),
	array('Tyne & Wear','Durham','Yes','Yes'),
	array('Durham','Cleveland','Yes','Yes'),
	array('Durham','N.Yorkshire','No','Yes'),
	array('Cleveland','N.Yorkshire','Yes','Yes'),
	array('Lancashire','N.Yorkshire','No','Yes'),
	array('Lancashire','Merseyside','Yes','Yes'),
	array('Lancashire','W.Yorkshire','No','Yes'),
	array('Lancashire','Greater Manchester','No','Yes'),
	array('N.Yorkshire','W.Yorkshire','No','Yes'),
	array('N.Yorkshire','Humberside','Yes','Yes'),
	array('N.Yorkshire','S.Yorkshire','No','Yes'),
	array('Merseyside','Cheshire','Yes','Yes'),
	array('Merseyside','Greater Manchester','No','Yes'),
	array('W.Yorkshire','Derbyshire & Nottinghamshire','No','Yes'),
	array('W.Yorkshire','S.Yorkshire','No','Yes'),
	array('W.Yorkshire','Greater Manchester','No','Yes'),
	array('Humberside','N.Lincolnshire','Yes','Yes'),
	array('Humberside','Derbyshire & Nottinghamshire','No','Yes'),
	array('Humberside','S.Yorkshire','No','Yes'),
	array('N.Lincolnshire','Derbyshire & Nottinghamshire','No','Yes'),
	array('N.Lincolnshire','S.Lincolnshire','Yes','Yes'),
	array('Derbyshire & Nottinghamshire','S.Yorkshire','No','Yes'),
	array('Derbyshire & Nottinghamshire','Cheshire','No','Yes'),
	array('Derbyshire & Nottinghamshire','Greater Manchester','No','Yes'),
	array('Derbyshire & Nottinghamshire','Staffordshire','No','Yes'),
	array('Derbyshire & Nottinghamshire','S.Lincolnshire','No','Yes'),
	array('Derbyshire & Nottinghamshire','Leicestershire','No','Yes'),
	array('Derbyshire & Nottinghamshire','Warwickshire','No','Yes'),
	array('Cheshire','Greater Manchester','No','Yes'),
	array('Cheshire','Staffordshire','No','Yes'),
	array('Cheshire','Shropshire','No','Yes'),
	array('Cheshire','Clwyd','Yes','Yes'),
	array('Staffordshire','Shropshire','No','Yes'),
	array('Staffordshire','W.Midlands','No','Yes'),
	array('Staffordshire','Warwickshire','No','Yes'),
	array('Staffordshire','Hereford & Worcester','No','Yes'),
	array('Shropshire','Hereford & Worcester','No','Yes'),
	array('Shropshire','N.Powys','No','Yes'),
	array('Shropshire','Clwyd','No','Yes'),
	array('S.Lincolnshire','Leicestershire','No','Yes'),
	array('S.Lincolnshire','Cambs.','No','Yes'),
	array('S.Lincolnshire','Norfolk','Yes','Yes'),
	array('Leicestershire','Warwickshire','No','Yes'),
	array('Leicestershire','Northants.','No','Yes'),
	array('Leicestershire','Cambs.','No','Yes'),
	array('W.Midlands','Warwickshire','No','Yes'),
	array('W.Midlands','Hereford & Worcester','No','Yes'),
	array('Warwickshire','Hereford & Worcester','No','Yes'),
	array('Warwickshire','Gloucestershire','No','Yes'),
	array('Warwickshire','Oxfordshire','No','Yes'),
	array('Warwickshire','Northants.','No','Yes'),
	array('Hereford & Worcester','Gloucestershire','No','Yes'),
	array('Hereford & Worcester','Gwent','No','Yes'),
	array('Hereford & Worcester','S.Powys','No','Yes'),
	array('Hereford & Worcester','N.Powys','No','Yes'),
	array('Gloucestershire','Oxfordshire','No','Yes'),
	array('Gloucestershire','Wiltshire','No','Yes'),
	array('Gloucestershire','Avon','Yes','Yes'),
	array('Gloucestershire','Gwent','Yes','Yes'),
	array('Oxfordshire','Northants.','No','Yes'),
	array('Oxfordshire','Bucks.','No','Yes'),
	array('Oxfordshire','Berkshire','No','Yes'),
	array('Oxfordshire','Wiltshire','No','Yes'),
	array('Northants.','Cambs.','No','Yes'),
	array('Northants.','Beds.','No','Yes'),
	array('Northants.','Bucks.','No','Yes'),
	array('Cambs.','Norfolk','No','Yes'),
	array('Cambs.','Suffolk','No','Yes'),
	array('Cambs.','Essex','No','Yes'),
	array('Cambs.','Hertfs.','No','Yes'),
	array('Cambs.','Beds.','No','Yes'),
	array('Norfolk','Suffolk','Yes','Yes'),
	array('Suffolk','Essex','Yes','Yes'),
	array('Essex','Hertfs.','No','Yes'),
	array('Essex','London','No','Yes'),
	array('Essex','Kent','Yes','Yes'),
	array('Hertfs.','Beds.','No','Yes'),
	array('Hertfs.','Bucks.','No','Yes'),
	array('Hertfs.','London','No','Yes'),
	array('Beds.','Bucks.','No','Yes'),
	array('Bucks.','London','No','Yes'),
	array('Bucks.','Surrey','No','Yes'),
	array('Bucks.','Berkshire','No','Yes'),
	array('London','Kent','No','Yes'),
	array('London','Surrey','No','Yes'),
	array('Kent','E.Sussex','Yes','Yes'),
	array('Kent','Surrey','No','Yes'),
	array('E.Sussex','Surrey','No','Yes'),
	array('E.Sussex','W.Sussex','Yes','Yes'),
	array('Surrey','W.Sussex','No','Yes'),
	array('Surrey','Hampshire','No','Yes'),
	array('Surrey','Berkshire','No','Yes'),
	array('W.Sussex','Hampshire','Yes','Yes'),
	array('Hampshire','Berkshire','No','Yes'),
	array('Hampshire','Wiltshire','No','Yes'),
	array('Hampshire','Dorset','Yes','Yes'),
	array('Hampshire','Isle of White','Yes','Yes'),
	array('Berkshire','Wiltshire','No','Yes'),
	array('Wiltshire','Dorset','No','Yes'),
	array('Wiltshire','Somerset','No','Yes'),
	array('Wiltshire','Avon','No','Yes'),
	array('Dorset','Somerset','No','Yes'),
	array('Dorset','Devon','No','Yes'),
	array('Dorset','Devon (South Coast)','Yes','No'),
	array('Somerset','Avon','Yes','Yes'),
	array('Somerset','Devon','No','Yes'),
	array('Somerset','Devon (North Coast)','Yes','No'),
	array('Devon','Cornwall','No','Yes'),
	array('Devon (North Coast)','Cornwall','Yes','No'),
	array('Devon (South Coast)','Cornwall','Yes','No'),
	array('Gwent','Glamorgan','Yes','Yes'),
	array('Gwent','S.Powys','No','Yes'),
	array('Glamorgan','S.Powys','No','Yes'),
	array('Glamorgan','Dyfed','No','Yes'),
	array('Glamorgan','Dyfed (South Coast)','Yes','No'),
	array('S.Powys','Dyfed','No','Yes'),
	array('S.Powys','N.Powys','No','Yes'),
	array('Dyfed','Pembrokeshire','No','Yes'),
	array('Dyfed','N.Powys','No','Yes'),
	array('Dyfed','Gwynedd','No','Yes'),
	array('Dyfed (North Coast)','Pembrokeshire','Yes','No'),
	array('Dyfed (North Coast)','Gwynedd','Yes','No'),
	array('Dyfed (South Coast)','Pembrokeshire','Yes','No'),
	array('N.Powys','Gwynedd','No','Yes'),
	array('N.Powys','Clwyd','No','Yes'),
	array('Gwynedd','Clwyd','Yes','Yes'),
	array('Gwynedd','Anglesey','Yes','Yes')
);

foreach($bordersRawData as $borderRawRow)
{
	list($from, $to, $fleets, $armies)=$borderRawRow;
	InstallTerritory::$Territories[$to]  ->addBorder(InstallTerritory::$Territories[$from],$fleets,$armies);
}
unset($bordersRawData);

InstallTerritory::runSQL($this->mapID);
InstallCache::terrJSON($this->territoriesJSONFile(),$this->mapID);
?>

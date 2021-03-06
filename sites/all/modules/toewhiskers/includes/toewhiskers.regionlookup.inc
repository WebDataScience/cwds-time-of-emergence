<?php

function toewhiskers_getregionarray() {
  $options = array(
    '2.1.01' => 'WA - Adams',
    '2.1.02' => 'WA - Asotin',
'2.1.03' => 'WA - Benton',
'2.1.04' => 'WA - Chelan',
'2.1.05' => 'WA - Clallam',
'2.1.06' => 'WA - Clark',
'2.1.07' => 'WA - Columbia',
'2.1.08' => 'WA - Cowlitz',
'2.1.09' => 'WA - Douglas',
'2.1.10' => 'WA - Ferry',
'2.1.11' => 'WA - Franklin',
'2.1.12' => 'WA - Garfield',
'2.1.13' => 'WA - Grant',
'2.1.14' => 'WA - Grays Harbor',
'2.1.15' => 'WA - Island',
'2.1.16' => 'WA - Jefferson',
'2.1.17' => 'WA - King',
'2.1.18' => 'WA - Kitsap',
'2.1.19' => 'WA - Kittitas',
'2.1.20' => 'WA - Klickitat',
'2.1.21' => 'WA - Lewis',
'2.1.22' => 'WA - Lincoln',
'2.1.23' => 'WA - Mason',
'2.1.24' => 'WA - Okanogan',
'2.1.25' => 'WA - Pacific',
'2.1.26' => 'WA - Pend Oreille',
'2.1.27' => 'WA - Pierce',
'2.1.28' => 'WA - San Juan',
'2.1.29' => 'WA - Skagit',
'2.1.30' => 'WA - Skamania',
'2.1.31' => 'WA - Snohomish',
'2.1.32' => 'WA - Spokane',
'2.1.33' => 'WA - Stevens',
'2.1.34' => 'WA - Thurston',
'2.1.35' => 'WA - Wahkiakum',
'2.1.36' => 'WA - Walla Walla',
'2.1.37' => 'WA - Whatcom',
'2.1.38' => 'WA - Whitman',
'2.1.39' => 'WA - Yakima',
'2.2.01' => 'ID - Ada',
'2.2.02' => 'ID - Adams',
'2.2.03' => 'ID - Bannock',
'2.2.04' => 'ID - Bear Lake',
'2.2.05' => 'ID - Benewah',
'2.2.06' => 'ID - Bingham',
'2.2.07' => 'ID - Blaine',
'2.2.08' => 'ID - Boise',
'2.2.09' => 'ID - Bonner',
'2.2.10' => 'ID - Bonneville',
'2.2.11' => 'ID - Boundary',
'2.2.12' => 'ID - Butte',
'2.2.13' => 'ID - Camas',
'2.2.14' => 'ID - Canyon',
'2.2.15' => 'ID - Caribou',
'2.2.16' => 'ID - Cassia',
'2.2.17' => 'ID - Clark',
'2.2.18' => 'ID - Clearwater',
'2.2.19' => 'ID - Custer',
'2.2.20' => 'ID - Elmore',
'2.2.21' => 'ID - Franklin',
'2.2.22' => 'ID - Fremont',
'2.2.23' => 'ID - Gem',
'2.2.24' => 'ID - Gooding',
'2.2.25' => 'ID - Idaho',
'2.2.26' => 'ID - Jefferson',
'2.2.27' => 'ID - Jerome',
'2.2.28' => 'ID - Kootenai',
'2.2.29' => 'ID - Latah',
'2.2.30' => 'ID - Lemhi',
'2.2.31' => 'ID - Lewis',
'2.2.32' => 'ID - Lincoln',
'2.2.33' => 'ID - Madison',
'2.2.34' => 'ID - Minidoka',
'2.2.35' => 'ID - Nez Perce',
'2.2.36' => 'ID - Oneida',
'2.2.37' => 'ID - Owyhee',
'2.2.38' => 'ID - Payette',
'2.2.39' => 'ID - Power',
'2.2.40' => 'ID - Shoshone',
'2.2.41' => 'ID - Teton',
'2.2.42' => 'ID - Twin Falls',
'2.2.43' => 'ID - Valley',
'2.2.44' => 'ID - Washington',
'2.3.01' => 'OR - Baker',
'2.3.02' => 'OR - Benton',
'2.3.03' => 'OR - Clackamas',
'2.3.04' => 'OR - Clatsop',
'2.3.05' => 'OR - Columbia',
'2.3.06' => 'OR - Coos',
'2.3.07' => 'OR - Crook',
'2.3.08' => 'OR - Curry',
'2.3.09' => 'OR - Deschutes',
'2.3.10' => 'OR - Douglas',
'2.3.11' => 'OR - Gilliam',
'2.3.12' => 'OR - Grant',
'2.3.13' => 'OR - Harney',
'2.3.14' => 'OR - Hood River',
'2.3.15' => 'OR - Jackson',
'2.3.16' => 'OR - Jefferson',
'2.3.17' => 'OR - Josephine',
'2.3.18' => 'OR - Klamath',
'2.3.19' => 'OR - Lake',
'2.3.20' => 'OR - Lane',
'2.3.21' => 'OR - Lincoln',
'2.3.22' => 'OR - Linn',
'2.3.23' => 'OR - Malheur',
'2.3.24' => 'OR - Marion',
'2.3.25' => 'OR - Morrow',
'2.3.26' => 'OR - Multnomah',
'2.3.27' => 'OR - Polk',
'2.3.28' => 'OR - Sherman',
'2.3.29' => 'OR - Tillamook',
'2.3.30' => 'OR - Umatilla',
'2.3.31' => 'OR - Union',
'2.3.32' => 'OR - Wallowa',
'2.3.33' => 'OR - Wasco',
'2.3.34' => 'OR - Washington',
'2.3.35' => 'OR - Wheeler',
'2.3.36' => 'OR - Yamhill',
  );
  return($options);
}
 
 
function toewhiskers_get_streamflow_regions_array() {
  $streamflow = array(
    '6.1.12115000' => 'WA - Cedar River near Cedar Falls (12115000)',
    '6.1.12020000' => 'WA - Chehalis River near Doty (12020000)',
'6.1.12436100' => 'WA - Columbia River at Grand Coulee Dam (12436100)',
'6.1.12054000' => 'WA - Duckabush River near Brinnon (12054000)',
'6.1.12048000' => 'WA - Dungeness River near Sequim (12048000)',
'6.1.12113000' => 'WA - Green River near Auburn (12113000)',
'6.1.12401500' => 'WA - Kettle River near Ferry (12401500)',
'6.1.12404500' => 'WA - Kettle River near Laurier (12404500)',
'6.1.12431000' => 'WA - Little Spokane River at Dartford (12431000)',
'6.1.12083000' => 'WA - Mineral Creek near Mineral (12083000)',
'6.1.12082500' => 'WA - Nisqually River near National (12082500)',
'6.1.12205000' => 'WA - North Fork Nooksack River bl Cascade Creek nr Glacier (12205000)',
'6.1.12056500' => 'WA - North Fork Skokomish R bl Staircase Rpds nr Hoodsport (12056500)',
'6.1.12167000' => 'WA - North Fork Stillaguamish River near Arlington (12167000)',
'6.1.12093500' => 'WA - Puyallup River near Orting (12093500)',
'6.1.12115500' => 'WA - Rex River near Cedar Falls (12115500)',
'6.1.12035000' => 'WA - Satsop River near Satsop (12035000)',
'6.1.12186000' => 'WA - Sauk River above Whitechuck R near Darrington (12186000)',
'6.1.12189500' => 'WA - Sauk River near Sauk (12189500)',
'6.1.12442500' => 'WA - Similkameen River near Nighthawk (12442500)',
'6.1.12200500' => 'WA - Skagit River near Mount Vernon (12200500)',
'6.1.12134500' => 'WA - Skykomish River near Gold Bar (12134500)',
'6.1.12150800' => 'WA - Snohomish River near Monroe (12150800)',
'6.1.12149000' => 'WA - Snoqualmie River near Carnation (12149000)',
'6.1.12451000' => 'WA - Stehekin River at Stehekin (12451000)',
'6.1.12175500' => 'WA - Thunder Creek near Newhalem (12175500)',
'6.1.12098500' => 'WA - White River near Buckley (12098500)',
'6.1.14092500' => 'WA - Yakima River at Parker (14092500)',
'6.2.13185000' => 'ID - Boise River near Twin Springs (13185000)',
'6.2.13313000' => 'ID - Johnson Creek at Yellow Pine (13313000)',
'6.2.13337000' => 'ID - Lochsa River near Lowell (13337000)',
'6.2.12306500' => 'ID - Moyie River at Eastport (12306500)',
'6.2.13317000' => 'ID - Salmon River at White Bird (13317000)',
'6.2.13336500' => 'ID - Selway River near Lowell (13336500)',
'6.2.13289710' => 'ID - Snake River at Brownlee Dam (13289710)',
'6.2.13037500' => 'ID - Snake River near Heise (13037500)',
'6.2.13186000' => 'ID - South Fork Boise River near Featherville (13186000)',
'6.2.13235000' => 'ID - South Fork Payette River at Lowman (13235000)',
'6.2.12414500' => 'ID - St Joe River at Calder (12414500)',
'6.3.14209500' => 'OR - Clackamas River above Three Lynx Creek (14209500)',
'6.3.14103950' => 'OR - Columbia River at the Dalles (14103950)',
'6.3.14092500' => 'OR - Deschutes River at Pelton Dam (14092500)',
'6.3.14113000' => 'OR - Klickitat River near Pitt (14113000)',
'6.3.14182500' => 'OR - Little North Santiam River near Mehama (14182500)',
'6.3.14141500' => 'OR - Little Sandy River near Bull Run (14141500)',
'6.3.14190500' => 'OR - Luckiamute River near Suver (14190500)',
'6.3.14178000' => 'OR - No Santiam River blw Boulder Creek Near Detroit (14178000)',
'6.3.14154500' => 'OR - Row River above Pitcher Creek nr Dorena (14154500)',
'6.3.14142500' => 'OR - Sandy River below Bull Run River nr Bull Run (14142500)',
'6.4.12340000' => 'MT - Blackfoot River near Bonner (12340000)',
'6.4.12363000' => 'MT - Flathead River at Columbia Falls (12363000)',
'6.4.12358500' => 'MT - Middle Fork Flathead River near West Glacier (12358500)',
'6.4.12355500' => 'MT - North Fork Flathead River near Columbia Falls (12355500)',
'6.4.13011000' => 'MT - Snake River near Moran (13011000)',
    '6.5.13010500' => 'WY - Jackson Lake near Moran (13010500)',
  );
  //asort($streamflow);
  return($streamflow);
}
		
		
function toewhiskers_get_watershed_array() {
  $watershed = array(
'4.17.110001' => 'WA - Fraser (17110001)',
'4.17.110003' => 'WA - San Juan Islands (17110003)',
'4.17.110002' => 'WA - Straight of Georgia (17110002)',
'4.17.020014' => 'WA - Banks Lake (17020014)',
'4.17.020005' => 'WA - Chief Joseph (17020005)',
'4.17.020003' => 'WA - Colville (17020003)',
'4.17.110021' => 'WA - Crescent-Hoko (17110021)',
'4.17.110016' => 'WA - Deschutes (17110016)',
'4.17.110020' => 'WA - Dungeness-Elwha (17110020)',
'4.17.110013' => 'WA - Duwamish (17110013)',
'4.17.020001' => 'WA - Franklin D. Roosevelt Lake (17020001)',
'4.17.100105' => 'WA - Grays Harbor (17100105)',
'4.17.100101' => 'WA - Hoh-Quillayute (17100101)',
'4.17.110018' => 'WA - Hood Canal (17110018)',
'4.17.020002' => 'WA - Kettle (17020002)',
'4.17.070106' => 'WA - Klickitat (17070106)',
'4.17.020009' => 'WA - Lake Chelan (17020009)',
'4.17.110012' => 'WA - Lake Washington (17110012)',
'4.17.080002' => 'WA - Lewis (17080002)',
'4.17.100104' => 'WA - Lower Chehalis (17100104)',
'4.17.080005' => 'WA - Lower Cowlitz (17080005)',
'4.17.020015' => 'WA - Lower Crab (17020015)',
'4.17.110007' => 'WA - Lower Skagit (17110007)',
'4.17.060110' => 'WA - Lower Snake (17060110)',
'4.17.060107' => 'WA - Lower Snake-Tucannon (17060107)',
'4.17.010307' => 'WA - Lower Spokane (17010307)',
'4.17.030003' => 'WA - Lower Yakima (17030003)',
'4.17.020008' => 'WA - Methow (17020008)',
'4.17.020012' => 'WA - Moses Coulee (17020012)',
'4.17.030002' => 'WA - Naches (17030002)',
'4.17.110015' => 'WA - Nisqually (17110015)',
'4.17.110004' => 'WA - Nooksack (17110004)',
'4.17.020006' => 'WA - Okanogan (17020006)',
'4.17.110019' => 'WA - Puget Sound (17110019)',
'4.17.110014' => 'WA - Puyallup (17110014)',
'4.17.100102' => 'WA - Queets-Quinault (17100102)',
'4.17.020004' => 'WA - Sanpoil (17020004)',
'4.17.110006' => 'WA - Sauk (17110006)',
'4.17.020007' => 'WA - Similkameen (17020007)',
'4.17.110017' => 'WA - Skokomish (17110017)',
'4.17.110009' => 'WA - Skykomish (17110009)',
'4.17.110011' => 'WA - Snohomish (17110011)',
'4.17.110010' => 'WA - Snoqualmie (17110010)',
'4.17.110008' => 'WA - Stillaguamish (17110008)',
'4.17.100103' => 'WA - Upper Chehalis (17100103)',
'4.17.020010' => 'WA - Upper Columbia-Entiat (17020010)',
'4.17.020016' => 'WA - Upper Columbia-Priest Rapids (17020016)',
'4.17.080004' => 'WA - Upper Cowlitz (17080004)',
'4.17.020013' => 'WA - Upper Crab (17020013)',
'4.17.110005' => 'WA - Upper Skagit (17110005)',
'4.17.030001' => 'WA - Upper Yakima (17030001)',
'4.17.020011' => 'WA - Wenatchee (17020011)',
'4.17.100106' => 'WA - Willpa Bay (17100106)',
'4.17.010306' => 'WA (ID) - Hangman (17010306)',
'4.17.010308' => 'WA (ID) - Little Spokane (17010308)',
'4.17.060103' => 'WA (ID, OR) - Lower Snake-Asotin (17060103)',
'4.17.060108' => 'WA (ID) - Palouse (17060108)',
'4.17.010216' => 'WA (ID) - Pend Oreille (17010216)',
'4.17.060109' => 'WA (ID) - Rock (17060109)',
'4.17.080003' => 'WA (OR) - Lower Columbia-Clatskanie (17080003)',
'4.17.070101' => 'WA (OR) - Middle Columbia-Lake Wallula (17070101)',
'4.17.070102' => 'WA (OR) - Walla Walla (17070102)',
'4.17.040206' => 'ID - American Falls (17040206)',
'4.17.040214' => 'ID - Beaver-Camas (17040214)',
'4.17.040218' => 'ID - Big Lost (17040218)',
'4.17.040219' => 'ID - Big Wood (17040219)',
'4.17.040216' => 'ID - Birch (17040216)',
'4.17.040207' => 'ID - Blackfoot (17040207)',
'4.17.050112' => 'ID - Boise-Mores (17050112)',
'4.17.050101' => 'ID - C.J. Strike Reservoir (17050101)',
'4.17.040220' => 'ID - Camas (17040220)',
'4.17.040201' => 'ID - Idaho Falls (17040201)',
'4.17.040209' => 'ID - Lake Walcott (17040209)',
'4.17.060204' => 'ID - Lemhi (17060204)',
'4.17.040217' => 'ID - Little Lost (17040217)',
'4.17.060210' => 'ID - Little Salmon (17060210)',
'4.17.040221' => 'ID - Little Wood (17040221)',
'4.17.060303' => 'ID - Lochsa (17060303)',
'4.17.050114' => 'ID - Lower Boise (17050114)',
'4.17.060206' => 'ID - Lower Middle Fork Salmon (17060206)',
'4.17.060308' => 'ID - Lower North Fork Clearwater (17060308)',
'4.17.060209' => 'ID - Lower Salmon (17060209)',
'4.17.060302' => 'ID - Lower Selway (17060302)',
'4.17.040215' => 'ID - Medicine Lodge (17040215)',
'4.17.060304' => 'ID - Middle Fork Clearwater (17060304)',
'4.17.050121' => 'ID - Middle Fork Payette (17050121)',
'4.17.060207' => 'ID - Middle Salmon-Chamberlain (17060207)',
'4.17.060203' => 'ID - Middle Salmon-Panther (17060203)',
'4.17.050111' => 'ID - North and Middle Forks Boise (17050111)',
'4.17.050123' => 'ID - North Fork Payette (17050123)',
'4.17.060202' => 'ID - Pashimeroi (17060202)',
'4.17.050122' => 'ID - Payette (17050122)',
'4.17.040208' => 'ID - Portneuf (17040208)',
'4.17.050113' => 'ID - South Fork Boise (17050113)',
'4.17.060305' => 'ID - South Fork Clearwater (17060305)',
'4.17.010302' => 'ID - South Fork Coeur D Alene.  (17010302)',
'4.17.050120' => 'ID - South Fork Payette (17050120)',
'4.17.060208' => 'ID - South Fork Salmon (17060208)',
'4.17.010304' => 'ID - St. Joe (17010304)',
'4.17.010301' => "ID - Upper Coeur d'Alene (17010301)",
'4.17.060205' => 'ID - Upper Middle Fork Salmon (17060205)',
'4.17.060307' => 'ID - Upper North Fork Clearwater (17060307)',
'4.17.060201' => 'ID - Upper Salmon (17060201)',
'4.17.060301' => 'ID - Upper Selway (17060301)',
'4.17.040212' => 'ID - Upper Snake-Rock (17040212)',
'4.17.050124' => 'ID - Weiser (17050124)',
'4.17.040205' => 'ID - Willow (17040205)',
'4.17.060306' => 'ID (WA) - Clearwater (17060306)',
'4.17.010303' => 'ID (WA) - Coeur D Alene Lake.  (17010303)',
'4.17.050103' => 'ID (WA) - Middle Snake-Succor (17050103)',
'4.17.010214' => 'ID (WA) - Pend Oreille Lake (17010214)',
'4.17.010215' => 'ID (WA) - Priest (17010215)',
'4.17.010305' => 'ID (WA) - Upper Spokane (17010305)',
'4.17.010104' => 'ID (MT) - Lower Kootenai (17010104)',
'4.17.010105' => 'ID (MT) - Moyie (17010105)',
'4.17.040211' => 'ID (NV, UT) - Goose (17040211)',
'4.17.050102' => 'ID (NV) - Bruneau (17050102)',
'4.17.050104' => 'ID (NV) - Upper Owyhee (17050104)',
'4.17.040210' => 'ID (UT) - Raft (17040210)',
'4.17.040203' => 'ID (WY) - Lower Henrys (17040203)',
'4.17.040104' => 'ID (WY) - Palisades (17040104)',
'4.17.040204' => 'ID (WY) - Teton (17040204)',
'4.17.040202' => 'ID (WY) - Upper Henrys (17040202)',
'4.17.100205' => 'OR - Alsea (17100205)',
'4.17.070303' => 'OR - Beaver-South Fork (17070303)',
'4.17.050118' => 'OR - Bully (17050118)',
'4.17.050202' => 'OR - Burnt (17050202)',
'4.17.090011' => 'OR - Clackamas (17090011)',
'4.17.090002' => 'OR - Coast Fork Willamette (17090002)',
'4.17.100304' => 'OR - Coos (17100304)',
'4.17.100305' => 'OR - Coquille (17100305)',
'4.17.050109' => 'OR - Crooked-Rattlesnake (17050109)',
'4.17.120003' => 'OR - Donner and Blitzen (17120003)',
'4.17.120001' => 'OR - Harney-Malheur Lakes (17120001)',
'4.17.060102' => 'OR - Imnaha. Oregon (17060102)',
'4.17.120006' => 'OR - Lake Abert (17120006)',
'4.17.070302' => 'OR - Little Deschutes (17070302)',
'4.17.070305' => 'OR - Lower Crooked (17070305)',
'4.17.070306' => 'OR - Lower Deschutes (17070306)',
'4.17.070204' => 'OR - Lower John Day (17070204)',
'4.17.050117' => 'OR - Lower Malheur (17050117)',
'4.17.050110' => 'OR - Lower Owyhee (17050110)',
'4.17.100310' => 'OR - Lower Rouge (17100310)',
'4.17.090012' => 'OR - Lower Willamette (17090012)',
'4.17.090004' => 'OR - Mckenzie (17090004)',
'4.17.070203' => 'OR - Middle Fork John Day (17070203)',
'4.17.090001' => 'OR - Middle Fork Willamette (17090001)',
'4.17.100308' => 'OR - Middle Rouge (17100308)',
'4.17.090007' => 'OR - Middle Willamette (17090007)',
'4.17.090009' => 'OR - Molalla-Pudding (17090009)',
'4.17.100201' => 'OR - Necanicum (17100201)',
'4.17.100202' => 'OR - Nehalem (17100202)',
'4.17.070202' => 'OR - North Fork John Day (17070202)',
'4.17.090005' => 'OR - North Santiam (17090005)',
'4.17.100301' => 'OR - North Umpqua (17100301)',
'4.17.050203' => 'OR - Powder (17050203)',
'4.17.100204' => 'OR - Siletz-Yaquina (17100204)',
'4.17.100207' => 'OR - Siltcoos (17100207)',
'4.17.120004' => 'OR - Silver (17120004)',
'4.17.120002' => 'OR - Silvies (17120002)',
'4.17.100206' => 'OR - Siuslaw (17100206)',
'4.17.100306' => 'OR - Sixes (17100306)',
'4.17.090006' => 'OR - South Santiam (17090006)',
'4.17.100302' => 'OR - South Umpqua (17100302)',
'4.17.120005' => 'OR - Summer Lake (17120005)',
'4.17.070307' => 'OR - Trout (17070307)',
'4.17.090010' => 'OR - Tualatin (17090010)',
'4.17.070103' => 'OR - Umatilla (17070103)',
'4.17.100303' => 'OR - Umpqua (17100303)',
'4.17.070304' => 'OR - Upper Crooked (17070304)',
'4.17.070301' => 'OR - Upper Deschutes (17070301)',
'4.17.060104' => 'OR - Upper Grande Ronde (17060104)',
'4.17.070201' => 'OR - Upper John Day (17070201)',
'4.17.050116' => 'OR - Upper Malheur (17050116)',
'4.17.100307' => 'OR - Upper Rouge (17100307)',
'4.17.090003' => 'OR - Upper Willamette (17090003)',
'4.17.060105' => 'OR - Wallowa (17060105)',
'4.17.050119' => 'OR - Wiilow (17050119)',
'4.17.070104' => 'OR - Willow (17070104)',
'4.17.100203' => 'OR - Wilson-Trask-Nestucca (17100203)',
'4.17.090008' => 'OR - Yamhill (17090008)',
'4.17.080006' => 'OR (WA) - Lower Columbia (17080006)',
'4.17.080001' => 'OR (WA) - Lower Columbia-Sandy (17080001)',
'4.17.060106' => 'OR (WA) - Lower Grande Ronde (17060106)',
'4.17.070105' => 'OR (WA) - Middle Columbia-Hood (17070105)',
'4.17.050201' => 'OR (ID) - Brownlee Reservoir (17050201)',
'4.17.060101' => 'OR (ID) - Hells Canyon (17060101)',
'4.17.050108' => 'OR (ID) - Jordan (17050108)',
'4.17.050107' => 'OR (ID, NV) - Middle Owyhee (17050107)',
'4.17.050115' => 'OR (ID) - Middle Snake-Payette (17050115)',
'4.17.100312' => 'OR (CA) -  Chetco (17100312)',
'4.17.100311' => 'OR (CA) -  Illinois (17100311)',
'4.17.100309' => 'OR (CA) - Applegate (17100309)',
'4.17.120007' => 'OR (NV, CA) - Warner Lakes (17120007)',
'4.17.120009' => 'OR (NV) - Alvord Lake (17120009)',
'4.17.120008' => 'OR (NV) - Guano (17120008)',
'4.17.010205' => 'MT - Bitterroot (17010205)',
'4.17.010203' => 'MT - Blackfoot (17010203)',
'4.17.010102' => 'MT - Fisher (17010102)',
'4.17.010208' => 'MT - Flathead Lake (17010208)',
'4.17.010202' => 'MT - Flint-Rock (17010202)',
'4.17.010212' => 'MT - Lower Flathead (17010212)',
'4.17.010204' => 'MT - Middle Clark Fork (17010204)',
'4.17.010207' => 'MT - Middle Fork Flathead (17010207)',
'4.17.010206' => 'MT - North Fork Flathead (17010206)',
'4.17.010209' => 'MT - South Fork Flathead (17010209)',
'4.17.010210' => 'MT - Stillwater (17010210)',
'4.17.010211' => 'MT - Swan (17010211)',
'4.17.010201' => 'MT - Upper Clark Fork (17010201)',
'4.17.010103' => 'MT - Yaak (17010103)',
'4.17.010213' => 'MT (ID) - Lower Clark Fork (17010213)',
'4.17.010101' => 'MT (ID) - Upper Kootenai (17010101)',
'4.17.050105' => 'NV (ID, OR) - South Fork Owyhee (17050105)',
'4.17.040213' => 'NV (ID) - Salmon Falls (17040213)',
'4.17.050106' => 'NV (OR, ID) - East Little Owyhee (17050106)',
	);
  //asort($watershed);
  return($watershed);
}

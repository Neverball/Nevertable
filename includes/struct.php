<?php
# ***** BEGIN LICENSE BLOCK *****
# This file is part of Nevertable .
# Copyright (c) 2004 Francois Guillet and contributors. All rights
# reserved.
#
# Nevertable is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
# 
# Nevertable is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
# 
# You should have received a copy of the GNU General Public License
# along with Nevertable; if not, write to the Free Software
# Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
#
# ***** END LICENSE BLOCK *****
#

include_once "tag.strings.en.php";

/*****************/
/* TABLE STRUCTS */
/*****************/

$types = array (
    array("name" => "best time"),
    array("name" => "most coins"),
    array("name" => "freestyle"),
    array("name" => "all"), //use by admin
    );
$folders = array (
    array("name" => "contest"),
    array("name" => "incoming"),
    array("name" => "trash"),
    array("name" => "oldones"),
    );

$newonly = array ("off", "3 days", "1 week", "2 weeks", "1 month");

$userlevel = array (0=>"root", 1=>"admin", 10=>"moderator", 20=>"member", 30=>"guest");

$rank = array("5", "10", "20", "40");

$levels = array (
    1 => "01",
    2 => "02",
    3 => "03",
    4 => "04",
    5 => "05",
    6 => "06",
    7 => "07",
    8 => "08",
    9 => "09",
    10 => "10",
    11 => "11",
    12 => "12",
    13 => "13",
    14 => "14",
    15 => "15",
    16 => "16",
    17 => "17",
    18 => "18",
    19 => "19",
    20 => "20",
    21 => "21",
    22 => "22",
    23 => "23",
    24 => "24",
    25 => "25",
    );

function GetShot($set_path, $map_solfile)
{
    global $config;
    return "<img src=\"".ROOT_PATH.$config['shot_dir'].$set_path."/".str_replace("sol", "jpg", $map_solfile)."\" alt=\"\" />";
}

function GetShotMini($set_path, $map_solfile, $width="")
{
    global $config;
    if (empty($width))
      return GetShot($map_solfile);
    else
      return "<img src=\"".ROOT_PATH.$config['shot_dir'].$set_path."/".str_replace("sol", "jpg", $map_solfile)."\" alt=\"\" width=\"".$width."\"/>";
}

function get_level_by_name($name)
{
    return $name-1;
}

function get_type_by_name($name)
{
    global $types;
    
    foreach ($types as $nb => $value)
    {
        if  (strcmp($types[$nb]["name"],$name) == 0)
            return $nb;
    }

    echo "Erreur de codage dans un appel a  get_type_by_name().";
    exit;
}

function get_folder_by_name($name)
{
    global $folders;
    
    foreach ($folders as $nb => $value)
    {
        if  (strcmp($folders[$nb]["name"],$name) == 0)
            return $nb;
    }

    echo "Erreur de codage dans un appel a  get_folder_by_name().";
    exit;
}

function get_folder_by_number($nb)
{
    global $folders;
    return $folders[$nb]["name"];
}

function get_type_by_number($nb)
{
    global $types;
    return $types[$nb]["name"];
}

function get_newonly_by_name($name)
{
    global $newonly;
    return array_search($name, $newonly);
}

function get_newonly_by_number($nb)
{
    global $newonly;
    return $newonly[$nb];
}

function get_userlevel_by_name($name)
{
    global $userlevel;
    foreach ($userlevel as $nb => $levelname)
    {
        if  (strcmp($levelname,$name) == 0)
            return $nb;
    }
    echo "Erreur de codage dans un appel a  get_userlevel_by_name().";
    exit;
}

function get_userlevel_by_number($nb)
{
    global $userlevel;
    return $userlevel[$nb];
}

function CalculRank($this_record)
{
  global $rank;
  if ($this_record == 0)
    return 0;
  else if ($this_record < $rank[0])
    return 1;
  else if ($this_record < $rank[1])
    return 2;
  else if ($this_record < $rank[2])
    return 3;
  else if ($this_record < $rank[3])
    return 4;
  else 
    return 5;
}

   
/*****************/
/* GUI STRUCTS   */
/*****************/

$toolbar_el = array (
    "strong" => "tbStrong",
    "em"     => "tbEm",
    "ins"    => "tbUnderline",
    "bquote" => "tbQuote",
    "link"   => "tbLink",
    "img_link" => "tbImg",
    );

$themes = array(
    "Sulfur",
    "Oxygen",
    "Lithium",
    );

$icons = array (
    "best time"   => "besttime.png",
    "most coins"  => "mostcoins.png",
    "freestyle"   => "freestyle.png",
    "new"         => "new.png",
    "attach"      => "attach.png",
    "edit"        => "edit.png",
    "del"         => "del.png",
    "best"        => "best.png",
    "rank"        => "rank.png",
    "del"         => "del.png",
    "trash"       => "trash.png",
    "arrow"       => "arrow.gif",
    "undo"        => "undo.png",
    "tocontest+"  => "tocontest+.png",
    "tocontestx"  => "tocontestx.png",
    "top"         => "top.jpg",
    );

function get_theme_by_name($name)
{
    global $themes;
    return array_search($name, $themes);
}


/*****************/
/* OTHER         */
/*****************/

/* types for getimagesize() */
$imagetypes = array (
    1 => "GIF",
    2 => "JPG",
    3 => "PNG",
    4 => "SWF",
    5 => "PSD",
    6 => "BMP",
    7 => "TIF",
    8 => "TIF",
    9 => "JPC",
    10 => "JP2",
    11 => "JPX",
    12 => "JB2",
    13 => "SWC",
    14 => "IFF",
    15 => "WBMP",
    16 => "XBM",
    );
?>

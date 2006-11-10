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

define('ROOT_PATH', "../");
include_once ROOT_PATH ."config.inc.php";
include_once ROOT_PATH ."includes/common.php";
include_once ROOT_PATH ."includes/classes.php";
include_once ROOT_PATH ."classes/class.dialog_admin.php";

//args process
$args = get_arguments($_POST, $_GET);

$table = new Nvrtbl("DialogAdmin");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<?php $table->PrintHtmlHead("Nevertable - Neverball Hall of Fame"); ?>

<body>
<div id="page">
<?php   $table->PrintTop();  ?>
<div id="main">
<?php

function closepage()
{  global $table;
    echo "</div><!-- fin \"main\" -->\n";
    $table->Close();
    $table->PrintFooter();
    echo "</div><!-- fin \"page\" -->\n";
    echo "</body>\n";
    echo "</html>\n";
}


$tagboard = new TagBoard($table->dialog->db, $table->dialog->bbcode, $table->dialog->smilies, $table->dialog->style);

if (!Auth::Check(get_userlevel_by_name("moderator")))
{          
  button_error("You have to be moderator to access tag  !", 400);
  button_back();
  closepage();
  exit;
}

$nextargs = "tag_moder.php?";

if($args['to'] == "edit")
{
    button("Editing tag #".$args['id']. " ...", 200);
    $nextargs = "tag_moder.php?id=".$args['id'];
}

if(isset($args['tag']))
{
   if (!isset($args['id']) || empty($args['id']))
   {
      button_error("No tag selected, can't post from mod panel.", 300);
   }
   else if(empty($args['tag_pseudo']) || empty($args['content']))
   {
      button_error($strings['tag_emptyfield'], 300);
   }
   else
   {
    if (!$tagboard->Update($args['id'], $args['content'], $args['tag_pseudo'], $args['tag_link']))
      button_error($tagboard->GetError(), 400);
   }
}

if($args['to'] == "del")
{
    if (isset($args['id']) && !empty($args['id']))
    {
      if (!$tagboard->Purge($args['id']))
      {
        button_error($tagboard->GetError(), 400);
      }
      else
      {
        button("tag #".$args['id']." deleted", 300);
      }
    }
}

$tagboard->dialog->Tags(true);
$tagboard->dialog->TagForm();
$tagboard->PrintOut();

if($args['to'] == "edit")
{
    $tagboard->db->RequestInit("SELECT", "tags");
    $tagboard->db->RequestGenericFilter("id", $args['id']);
    if(!$tagboard->db->Query())
      button_error($tagboard->db->GetError(), 400);
    $val = $tagboard->db->FetchArray();
    echo "<script type=\"text/javascript\">update_tagform_fields('".
        JavaScriptize($val['pseudo'])."','".
        JavaScriptize($val['link'])."','".
        JavaScriptize($val['content'])."')</script>\n";
}


button("<a href=\"admin.php\">Return admin panel</a>", 300);
?>
</div> <!-- fin main-->
<?php
$table->Close();
$table->PrintFooter();
?>

</div><!-- fin "page" -->
</body>
</html>
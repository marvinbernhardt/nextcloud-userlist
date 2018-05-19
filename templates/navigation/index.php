<?php
style('userlist', 'navigation');
?>

<ul id="userlist-navigation">
<li>
    <a href="#" search-group="">Alle</a>
</li>
<?php
foreach($_['grouplist'] as $group)
{
    $gid = $group['gid'];
?>
<li>
    <a href="#" search-group="<?php p($gid);?>"><?php p($gid);?></a>
</li>
<?php
}
?>
</ul>

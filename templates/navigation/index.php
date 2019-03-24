<?php
style('userlist', 'navigation');
?>

<ul id="userlist-navigation">
<li>
    <a href="#" search-group="">Alle</a>
</li>
<?php
foreach($_['circlescircles'] as $circle)
{
    $name = $circle['name'];
?>
<li>
    <a href="#" search-group="<?php p($name);?>"><?php p($name);?></a>
</li>
<?php
}
?>
</ul>

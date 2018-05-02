<?php
print_r($_['list'][0]);
foreach($_['list'] as $x => $x_value)
{
    p("Nummer=" . $x . ", Json=" . $x_value['data']);
?>
<br>
<?php
}
?>

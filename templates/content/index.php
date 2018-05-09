<?php
script('userlist', 'content');
?>

<div id="users">
    <input class="search" placeholder="Suchen..." />
    <table style="width:100%">
        <thead>
            <tr>
                <th class="sort" data-sort="name">Name</th>
                <th>E-Mail-Adresse</th>
                <th>Telefonnummer</th>
                <th class="sort" data-sort="groups">Gruppen</th>
            </tr>
        </thead>
        <tbody class="list">
<?php
foreach($_['list'] as $x => $x_value)
{
    $user_info = json_decode($x_value['dat']);
?>
<tr>
    <td class="name">
<?php
    p($user_info->{'displayname'}->{'value'});
?>
    </td>
    <td class="email">
        <a href="mailto:<?php p($user_info->{'email'}->{'value'}); ?>">
<?php
    p($user_info->{'email'}->{'value'});
?>
        </a>
    </td>
    <td class="">
<?php
    p($user_info->{'phone'}->{'value'});
?>
    </td>
    <td class="groups">
<?php
    p($x_value['groups']);
?>
    </td>
</tr>
<?php
}
?>
        </tbody>
    </table>
</div>

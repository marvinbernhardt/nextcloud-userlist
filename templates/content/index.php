<?php
script('userlist', 'content');
style('userlist', 'content');
?>

<div id="userlist">
    <h2>Liste aller Benutzer</h2>
    <input id="userlist-search" class="search" placeholder="Suchen..." />
    <table style="width:100%">
        <thead>
            <tr>
                <th class="sort" data-sort="name">Name</th>
                <th class="sort" data-sort="groups">Gruppen</th>
                <th class="sort" data-sort="email">E-Mail-Adresse</th>
                <th class="sort" data-sort="phone">Telefonnummer</th>
            </tr>
        </thead>
        <tbody class="list">

<?php
foreach($_['userlist'] as $user)
{
    $user_info = json_decode($user['account_data']);
?>

<tr>
    <td class="name">
        <?php p($user_info->{'displayname'}->{'value'}); ?>
    </td>
    <td class="groups">
<?php
    foreach(explode(", ", $user['groups']) as $group)
    {
        p($group);
?><br>
<?php
    }
?>
    </td>
    <td class="email">
        <a href="mailto:<?php p($user_info->{'email'}->{'value'}); ?>">
            <?php p($user_info->{'email'}->{'value'}); ?>
        </a>
    </td>
    <td class="phone">
        <?php p($user_info->{'phone'}->{'value'}); ?>
    </td>
</tr>
<?php
}
?>
        </tbody>
    </table>
    <br>
    <h2>E-Mail-Adressen zum Kopieren</h2>
    <div id="userlist-emaillist"></div>
    <button id="userlist-emaillist-copy">In die Zwischenablage kopieren</button>
</div>

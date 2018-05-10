var navigation_links = document.querySelectorAll("#userlist-navigation a");

for (var i = 0; i < navigation_links.length; i++) (function(i) {
    var group = navigation_links[i].getAttribute("search-group");
    navigation_links[i].onclick = function() {
        if (group === "") {
            userList.filter();
        } else {
            userList.filter(
                function(item) {
                    if (item.values().groups.includes(group.concat("<br>"))) {
                        return true;
                    } else {
                        return false;
                    }
                }
            );
        }
    };
})(i);

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
        show_emails(group);
    };
})(i);


function show_emails(group) {
    var email_list = document.querySelector("#userlist-emaillist");
    var email_array = [];
    for (var i = 0; i < userList.matchingItems.length; i++) {
        var email_link_string = userList.matchingItems[i].values().email;

        // cleaning from <a> tag
        var div = document.createElement("div");
        div.innerHTML = email_link_string;
        var email_link_clean = div.textContent || div.innerText || "";

        email_array.push(email_link_clean);
    }
    email_list.innerHTML = email_array.join(", ");

    var email_links = document.querySelectorAll('#userlist-emaillist a');
}

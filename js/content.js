var userList = new List('userlist', {valueNames: ['name', 'circles', 'email', 'phone']});
var navigation = document.querySelector("#userlist-navigation");
var navigation_links = document.querySelectorAll("#userlist-navigation a");
var email_list = document.querySelector("#userlist-emaillist");
var copy_button = document.querySelector("#userlist-emaillist-copy");
var search_field = document.querySelector("#userlist-search");

show_emails();
userList.on("updated", show_emails);
userList.on("searchStart", function() {userList.filter()});
copy_button.onclick = function() {selectAndCopyText(email_list)};

for (var i = 0; i < navigation_links.length; i++) (function(i) {
    var group = navigation_links[i].getAttribute("search-group");
    navigation_links[i].onclick = function() {
        if (group === "") {
            userList.search();
            search_field.value = "";
            userList.filter();
        } else {
            userList.search();
            search_field.value = "";
            userList.filter(
                function(item) {
                    if (item.values().circles.includes(group.concat("<br>"))) {
                        return true;
                    } else {
                        return false;
                    }
                }
            );
        }
    };
})(i);

function show_emails() {
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
}

function selectAndCopyText(node) {
    if (document.body.createTextRange) {
        const range = document.body.createTextRange()
        range.moveToElementText(node)
        range.select()
        document.execCommand("Copy");
    } else if (window.getSelection) {
        const selection = window.getSelection()
        const range = document.createRange()
        range.selectNodeContents(node)
        selection.removeAllRanges()
        selection.addRange(range)
        document.execCommand("Copy");
    } else {
        console.warn("Could not select text in node: Unsupported browser.")
    }
}

var options = {
    valueNames: ['name', 'groups', 'email', 'phone']
};

var userList = new List('userlist', options);

function selectText(node) {
    node = document.getElementById(node)

    if (document.body.createTextRange) {
        const range = document.body.createTextRange()
        range.moveToElementText(node)
        range.select()
    } else if (window.getSelection) {
        const selection = window.getSelection()
        const range = document.createRange()
        range.selectNodeContents(node)
        selection.removeAllRanges()
        selection.addRange(range)
    } else {
        console.warn("Could not select text in node: Unsupported browser.")
    }
}

function emails_to_clipboard() {
    selectText("userlist-emaillist");
    document.execCommand("Copy");
}

document.getElementById("userlist-emaillist-copy").onclick = function() {emails_to_clipboard()};

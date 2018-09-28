window.onload = function () {
    checkSelectionStatus();
}

function selectAllLinks(state) {
    var list = document.getElementsByName('linkCheckBox');
    var n = list.length;

    for (var i = 0; i < n; i++) {
        list[i].checked = state;
    }

    checkSelectionStatus();
}

function copyLinks() {
    var list = document.getElementsByName('linkCheckBox');
    var n = list.length;
    var text = '';

    for (var i = 0; i < n; i++) {
        if (list[i].checked) {
            text += list[i].value + '\n';
        }
    }

    copyTextToClipboard(text);
}

function copyTextToClipboard(text) {
    var textArea = document.createElement('textarea');

    //
    // *** This styling is an extra step which is likely not required. ***
    //
    // Why is it here? To ensure:
    // 1. the element is able to have focus and selection.
    // 2. if element was to flash render it has minimal visual impact.
    // 3. less flakyness with selection and copying which **might** occur if
    //    the textarea element is not visible.
    //
    // The likelihood is the element won't even render, not even a flash,
    // so some of these are just precautions. However in IE the element
    // is visible whilst the popup box asking the user for permission for
    // the web page to copy to the clipboard.
    //

    // Place in top-left corner of screen regardless of scroll position.
    textArea.style.position = 'fixed';
    textArea.style.top = 0;
    textArea.style.left = 0;

    // Ensure it has a small width and height. Setting to 1px / 1em
    // doesn't work as this gives a negative w/h on some browsers.
    textArea.style.width = '2em';
    textArea.style.height = '2em';

    // We don't need padding, reducing the size if it does flash render.
    textArea.style.padding = 0;

    // Clean up any borders.
    textArea.style.border = 'none';
    textArea.style.outline = 'none';
    textArea.style.boxShadow = 'none';

    // Avoid flash of white box if rendered for any reason.
    textArea.style.background = 'transparent';

    textArea.value = text;

    document.body.appendChild(textArea);

    textArea.select();

    var copyStatus = document.getElementById('copyStatus');

    try {
        var successful = document.execCommand('copy');

        if (successful) {
            copyStatus.innerHTML = 'Links have been copied to clipboard';
        }
        else {
            copyStatus.innerHTML = 'Links cannot be copied to clipboard';
        }
    } catch (err) {
        copyStatus.innerHTML = 'An error occurred when coping links to clipboard';
    }

    document.body.removeChild(textArea);
}

function checkSelectionStatus() {
    var list = document.getElementsByName('linkCheckBox');
    var n = list.length;
    var selectAllCheckBox = document.getElementById('selectAllCheckBox');

    selectAllCheckBox.checked = true;

    try {
        var size = 0;

        for (var i = 0; i < n; i++) {
            if (list[i].checked) {
                var pieces = list[i].value.split('|');

                size += parseInt(pieces[3]);
            }
            else {
                selectAllCheckBox.checked = false;
            }
        }

        document.getElementById('totalSize').innerHTML = formatSize(size, 2);
    } catch (e) { }
}

function formatSize(size, precision) {
    if (size != 0) {
        // Log(n, a) = Log(n, 2) / Log(a, 2)
        var order = Math.floor(Math.log2(size) / Math.log2(1024));
        var length = size / Math.pow(1024, order);
        return length.toFixed(precision) + ' ' + byteAbbreviations[order];
    }
    else {
        return '0 B';
    }
}

var byteAbbreviations = ['B', 'KB', 'MB', 'GB'];
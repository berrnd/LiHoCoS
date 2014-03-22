function GetUrlParameter(param) {
    var pageUrl = window.location.search.substring(1);
    var urlVars = pageUrl.split('&');
    for (var i = 0; i < urlVars.length; i++)
    {
        var paramName = urlVars[i].split('=');
        if (paramName[0] === param)
            return paramName[1];
    }
}

function NowIsoString() {
    var date = new Date().toISOString();
    date = date.substring(0, 19);
    return date.split('T').join(' ');
}
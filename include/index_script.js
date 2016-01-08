var refreshtimer;

window.onload = function() {
	$(".switch").bootstrapSwitch();
	loadAll();
	
	if (getCookie("BungeeStatus") == "") setCookie("BungeeStatus", "true,60");
	
	$("#toolbar input[name=refresh]").bootstrapSwitch("state", Boolean(getCookie("BungeeStatus").split(",")[0]));
	$("#toolbar select[name=interval]").val(getCookie("BungeeStatus").split(",")[1]);
	
	if (Boolean(getCookie("BungeeStatus").split(",")[0])) startAutoRefresh();
	
	$("#toolbar input[name=refresh]").on('switchChange.bootstrapSwitch', function(event, state) {
		cookie = getCookie("BungeeStatus").split(",");
		cookie[0] = state;
		setCookie("BungeeStatus", cookie.join(","));
        
        if (state) {
            startAutoRefresh();
            loadAll();
        } else {
        	stopAutoRefresh();
        }
	});
	
	$("#toolbar select[name=interval]").on('change', function() {
		cookie = getCookie("BungeeStatus").split(",");
		cookie[1] = this.value;
		setCookie("BungeeStatus", cookie.join(","));
		
		stopAutoRefresh();
        startAutoRefresh();
	});
};

function startAutoRefresh() {
    refreshTimer = setInterval(loadAll, getCookie("BungeeStatus").split(",")[1] * 1000);
}

function stopAutoRefresh() {
    window.clearTimeout(refreshTimer);
}


function loadServer(id) {
	$.getJSON(
        "ajax/get.php?server=" + id, 
        function(data) {
            if (data.Online) {
                $(".server-" + id + " .players").html(data.Players + "/" + data.MaxPlayers);
                $(".server-" + id + " .status").html("ONLINE");
                $(".server-" + id + " .status").removeClass("offline");
                $(".server-" + id + " .status").addClass("online");
                
                $(".server-" + id + " .description").html(data.Description);
                $(".server-" + id + " .description").removeClass("offline");
            } else {
                $(".server-" + id + " .players").html("-/-");
                $(".server-" + id + " .status").html("OFFLINE");
                $(".server-" + id + " .status").removeClass("online");
                $(".server-" + id + " .status").addClass("offline");
                
                $(".server-" + id + " .description").html((data.Offline_reason ? data.Offline_reason : data.Description));
                $(".server-" + id + " .description").addClass((data.Offline_reason ? "offline" : ""));
            }
        }
    );
}

function loadAll() {
	var i = 0;
	$("#servers .server").each(function() {
		loadServer(i);
		i++;
	});
}


function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) != -1) return c.substring(name.length,c.length);
    }
    return "";
}

function setCookie(cname, cvalue) {
    var now = new Date();
    var time = now.getTime();
    time += 3600 * 1000;
    now.setTime(time);
    document.cookie = cname + "=" + cvalue + '; expires=' + now.toUTCString();
}
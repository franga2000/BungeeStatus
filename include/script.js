var refreshTimer;

window.onload = function() {
    if (getCookie("BungeeStatus") === "") setCookie("BungeeStatus", "true,60000");
    
	$("tr").fadeOut(0);
	$(".auto-refresh").html('<label for="refresh">Auto refresh:</label><input type="checkbox" name="refresh" class="switch" /><label for="timer">Refresh timer: </label><select name="timer" style="margin: 10px;"><option value="1000">1 sec.</option><option value="10000">10 sec.</option><option value="30000">30 sec.</option><option value="60000">1 min.</option><option value="600000">10 min.</option></select>');
	$(".switch").bootstrapSwitch();
	
	refresh();
	fadeIn();
	
	startAutoRefresh();
	
	if (getCookie("BungeeStatus").split(",")[0] == "true") {
		$(".auto-refresh input").bootstrapSwitch("state", true);
	}
	
	$(".auto-refresh select").val(getCookie("BungeeStatus").split(",")[1]);
	
	$(".auto-refresh input").on('switchChange.bootstrapSwitch', function(event, state) {
		cookieData = getCookie("BungeeStatus").split(",");
		cookieData[0] = state;
		
		setCookie("BungeeStatus", cookieData.join(","));
        
        if (state) {
            startAutoRefresh();
        } else {
            stopAutoRefresh();
        }
	});
	
	$(".auto-refresh select").on('change', function() {
		cookieData = getCookie("BungeeStatus").split(",");
		cookieData[1] = this.value;
		
		setCookie("BungeeStatus", cookieData.join(","));
		
		stopAutoRefresh();
        startAutoRefresh();
	});
};

function fadeIn() {
	var i = 0;
	function loop () {
		setTimeout(function () {
		$("#row_"+i).fadeIn(500);
			i++;
			if (i < 10) loop();
	}, 100);
	}
	loop();
}

function refresh() {
    var i = 0;
    $(".server").each(function() {
        //setTimeout(function() {
        	loadServer(i);
        //}, i*10);
        i++;
    });
}

function loadServer(id) {
    $.getJSON(
        "API/get.php?server=" + id, 
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

function startAutoRefresh() {
    refreshTimer = setInterval(function(){ refresh() }, getCookie("BungeeStatus").split(",")[1]);
}

function stopAutoRefresh() {
    window.clearTimeout(refreshTimer);
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
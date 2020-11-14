
const WEBSITE = "http://localhost/mnads";
//const WEBSITE = "http://adslead.asia"

// The pattern to split each row in the stack trace string
const STACK_TRACE_SPLIT_PATTERN = /(?:Error)?\n(?:\s*at\s+)?/;
// For browsers, like Chrome, IE, Edge and more.
const STACK_TRACE_ROW_PATTERN1 = /^.+?\s\((.+?):\d+:\d+\)$/;
// For browsers, like Firefox, Safari, some variants of Chrome and maybe other browsers.
const STACK_TRACE_ROW_PATTERN2 = /^(?:.*?@)?(.*?):\d+(?::\d+)?$/;

const getFileParams = () => {
    const stack = new Error().stack;
    const row = stack.split(STACK_TRACE_SPLIT_PATTERN, 2)[1];
    const [, url] = row.match(STACK_TRACE_ROW_PATTERN1) || row.match(STACK_TRACE_ROW_PATTERN2) || [];
    if (!url) {
        console.warn("Something went wrong. You should debug it and find out why.");
        return;
    }
    try {
        const urlObj = new URL(url);
        return urlObj.searchParams; // This feature doesn't exists in IE, in this case you should use urlObj.search and handle the query parsing by yourself.
    } catch (e) {
        console.warn(`The URL '${url}' is not valid.`);
    }
}

var token = "";


// jQuery
$(document).ready( function () {

	const params = getFileParams();
	token = params.get('code');


	// //Load config
	$.ajax({ //Process the form using $.ajax()
        type: 'GET', //Method type
        url: WEBSITE + '/api/getuserinfo', //Your form processing file URL
        data: "token=" + token, //Forms name
        dataType: 'json',
        async: false,
        cache: false,
        timeout: 100000,
        success: function (data) {

            if (data.status) { //If fails

            	//LOAD BUTTON
            	loadButtons(data.data.call[0].phone_number,data.data.call[0].id,data.data.fb[0].facebook_id,
            		data.data.fb[0].id,data.data.zalo[0].zalo_name,data.data.zalo[0].id);

            	//HANDLE MAP AND CONTACT 
			 	$('#pd_contact').click(function() {
			  		loadContactForm(data.data.contact[0].number,data.data.contact[0].description,data.data.contact[0].id);
			  	});

				$('#pd_map_button').click(function() {
			  		loadMap(data.data.map[0].map,data.data.map[0].id);
			  	});
			

            } else {
                $('#success').fadeIn(1000).append('<p>' + data.posted + '</p>'); //If successful, than throw a success message
            }
        },
        error: function (data, textStatus, errorThrown) {
	    	if(textStatus == "timeout") {
	      		alert("Got timeout");
	    	}
	  	}
    });
 

});


function loadButtons(callphone,call_id,facebook,facebook_id,zalo,zalo_id) {

	//MAKE BUTTON CALL
	var str = loadLeftBoard(callphone,call_id,facebook,facebook_id,zalo,zalo_id);
	
	//MAKE LEFT BOARD
	str = str + makeButtonCall(callphone,call_id);

	$("body").append(str);	

}

function makeButtonCall(callphone,call_id) {

	var str = "<a id='call-now-2-3' onclick='writelogcall(" + call_id + ");' href='tel:" + callphone + "' class='fancybox'>";
	str = str + "<div class='coccoc-alo-phone coccoc-alo-green coccoc-alo-show' id='coccoc-alo-phoneIcon'>";
	str = str + "<div class='coccoc-alo-ph-circle'></div><div class='coccoc-alo-ph-circle-fill'></div><div class='coccoc-alo-ph-img-circle'></div>";
	str = str + "</div></a>";

	return str;
}


function loadLeftBoard(callphone,call_id,facebook,facebook_id,zalo,zalo_id) {

	var str = "<div class='pd_ck_leftboard'><div class='pd_ck_button'>"
	str = str + "<a href='tel: " + callphone + "' onclick='writelogcall(" + call_id + ")';><div class='pd_call_button pd_button pd_tooltip'><span class='pd_call_button_tip button_tip'>Gọi ngay cho chúng tôi</span></div></a>"
	str = str + "<a href='" + facebook + "' onclick='writefacebookLog(" + facebook_id + ");' target='_blank'><div class='pd_facebook_button pd_button pd_tooltip'><span class='pd_facebook_button_tip button_tip'>Chat ngay cho chúng tôi</span></div></a>"
	str = str + "<a href='https://zalo.me/" + zalo + "' onclick='writezalolog(" + zalo_id + ");' target='_blank'><div class='pd_zalo_button pd_button pd_tooltip'><span class='pd_zalo_button_ti button_tip'>Gọi Zalo ngay cho chúng tôi</span></div></a>"
	str = str + "<div id='pd_map_button' class='pd_map_button pd_button pd_tooltip'><span class='pd_map_button_tip button_tip'>Xem vi trí của chúng tôi</span></div>"
	str = str + "<div id='pd_contact' class='pd_contact_button pd_button pd_tooltip'><span class='pd_contact_button_tip button_tip'>Liên hệ ngay cho chúng tôi</span></div>"
	str = str + "</div></div>";

	return str;
}


function loadContactForm(placeholder_std, placeholder_description,contact_id) {

	var str = "<div class='pd_bg'><div class='pd_popup_content'><a id='pd_close' class='close pd_close' onclick='closeFormContact();'>x</a><h2>LIÊN HỆ</h2>";
        str = str + "<label for='country'>Số Điện Thoại</label>";
        str = str + "<input type='text' class='pd_std' id='pd_sdt' placeholder='" + placeholder_std +  "'>";
 		str = str + "<label for='address'>Nội Dung</label>";
        str = str + "<textarea class='pd_content' name='pd_content' placeholder='" + placeholder_description + "'></textarea>";
        str = str + "<label id='pd_contact_message' class='warning' style='display:none;color:red'>CÁM ƠN BẠN ĐÃ LIỆN HỆ VỚI CHÚNG TÔI. CHUNG TÔI SẼ LIÊN LẠC LẠI NGAY</label>";
        str = str + "<input type='button' class='pd_send' value='Gửi' onclick='writecontactlog( + " + contact_id + ")'></div></div>";

    $("body").append(str);

}

//WRITE ZALO LOG
function writecontactlog(contact_id) {

	$.getJSON("https://www.iplocate.io/api/lookup/",
        function(data){
            var ip = data.ip;
			var location = data.city + "-" + data.country;

			var sdt = $(".pd_std").val();
			var description = $(".pd_content").val();

			params = "token=" + token + "&lienhe_id=" + contact_id + "&mobile=" + sdt + "&description=" + description + "&ip=" + ip + "&location=" + location;
			console.log(params);

			$.ajax({ //Process the form using $.ajax()
		        type: 'POST', //Method type
		        url: WEBSITE + '/api/contactlog', //Your form processing file URL
		        data: params, //Forms name
		        dataType: 'json',
		        timeout: 100000,
		        success: function (data) {
		        	 if (data.status) { //If fails
		        	 	$("#pd_contact_message").show();
		        	 } else {
		        	 	$('#success').fadeIn(1000).append('<p>' + data.posted + '</p>');
		        	 }
		        }
		     });
        }
    );	
}


//WRITE CALL LOG
function writelogcall(call_id) {

	$.getJSON("https://www.iplocate.io/api/lookup/",
        function(data){
            var ip = data.ip;
			var location = data.city + "-" + data.country;

			params = "token=" + token + "&call_id=" + call_id + "&ip=" + ip + "&location=" + location;
			console.log(params);

			$.ajax({ //Process the form using $.ajax()
		        type: 'POST', //Method type
		        url: WEBSITE + '/api/calllog', //Your form processing file URL
		        data: params, //Forms name
		        dataType: 'json',
		        timeout: 100000,
		        success: function (data) {
		        	 if (data.status) { //If fails

		        	 } else {
		        	 	$('#success').fadeIn(1000).append('<p>' + data.posted + '</p>');
		        	 }
		        }
		     });
        }
    );	
}

//WRITE FACEBOOK MESSAGE LOG
function writefacebookLog(facebook_id) {

	$.getJSON("https://www.iplocate.io/api/lookup/",
        function(data){
            var ip = data.ip;
			var location = data.city + "-" + data.country;

			params = "token=" + token + "&facebook_id=" + facebook_id + "&ip=" + ip + "&location=" + location;
			console.log(params);

			$.ajax({ //Process the form using $.ajax()
		        type: 'POST', //Method type
		        url: WEBSITE + '/api/chatfblog', //Your form processing file URL
		        data: params, //Forms name
		        dataType: 'json',
		        timeout: 100000,
		        success: function (data) {
		        	 if (data.status) { //If fails

		        	 } else {
		        	 	$('#success').fadeIn(1000).append('<p>' + data.posted + '</p>');
		        	 }
		        }
		     });
        }
    );	
}

//WRITE ZALO LOG
function writezalolog(zalo_id) {

	$.getJSON("https://www.iplocate.io/api/lookup/",
        function(data){
            var ip = data.ip;
			var location = data.city + "-" + data.country;

			params = "token=" + token + "&zalo_id=" + zalo_id + "&ip=" + ip + "&location=" + location;
			console.log(params);

			$.ajax({ //Process the form using $.ajax()
		        type: 'POST', //Method type
		        url: WEBSITE + '/api/chatzalolog', //Your form processing file URL
		        data: params, //Forms name
		        dataType: 'json',
		        timeout: 100000,
		        success: function (data) {
		        	 if (data.status) { //If fails

		        	 } else {
		        	 	$('#success').fadeIn(1000).append('<p>' + data.posted + '</p>');
		        	 }
		        }
		     });
        }
    );	
}


//WRITE ZALO LOG
function writemaplog(map_id) {

	$.getJSON("https://www.iplocate.io/api/lookup/",
        function(data){
            var ip = data.ip;
			var location = data.city + "-" + data.country;

			params = "token=" + token + "&map_id=" + map_id + "&ip=" + ip + "&location=" + location;
			console.log(params);

			$.ajax({ //Process the form using $.ajax()
		        type: 'POST', //Method type
		        url: WEBSITE + '/api/maplog', //Your form processing file URL
		        data: params, //Forms name
		        dataType: 'json',
		        timeout: 100000,
		        success: function (data) {
		        	 if (data.status) { //If fails

		        	 } else {
		        	 	$('#success').fadeIn(1000).append('<p>' + data.posted + '</p>');
		        	 }
		        }
		     });
        }
    );	
}



function closeFormContact() {
	$(".pd_bg").hide();
}


function loadMap(maps,map_id) {

	//WRITE LOG
	writemaplog(map_id);

	//SHOW MAP
	var str = "<div class='pd_bg'><div class='pd_popup_content_map'><a id='pd_close' class='close pd_close' onclick='closeFormContact();'>x</a>";
	str = str + maps + "</div></div>";
	$("body").append(str);

}






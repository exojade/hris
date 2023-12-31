/*
 
 Copyright (c) 2009 Anant Garg (anantgarg.com | inscripts.com)
 
 This script may be used for non-commercial purposes only. For any
 commercial purposes, please contact the author at 
 anant.garg@inscripts.com
 
 THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
 OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
 HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
 WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
 OTHER DEALINGS IN THE SOFTWARE.
 
 */
var single = 'single';
var group = 'group';
var windowFocus = true;
var username;
var chatHeartbeatCount = 0;
var minChatHeartbeat = 1000;
var maxChatHeartbeat = 33000;
var chatHeartbeatTime = minChatHeartbeat;
var originalTitle;
var blinkOrder = 0;

var chatboxFocus = new Array();
var newMessages = new Array();
var newMessagesWin = new Array();
var chatBoxes = new Array();



$(document).ready(function () {
    originalTitle = document.title;
    //  startChatSession();

    $([window, document]).blur(function () {
        windowFocus = false;
    }).focus(function () {
        windowFocus = true;
        document.title = originalTitle;
    });
});

function restructureChatBoxes() {
    align = 0;
    for (x in chatBoxes) {
        chatboxtitle = chatBoxes[x];

        if ($("#chatbox_" + chatboxtitle).css('display') != 'none') {
            if (align == 0) {
                $("#chatbox_" + chatboxtitle).css('right', '20px');
            } else {
                width = (align) * (300 + 7) + 20;
                $("#chatbox_" + chatboxtitle).css('right', width + 'px');
            }
            align++;
        }
    }
}

function chatWith(chatuser, user_name, sender_id, chat_type, message_type) {
    createChatBox(chatuser, false, user_name, false, sender_id, chat_type, message_type);
    $("#chatbox_" + chatuser + " .chatboxtextarea").focus();
	
}

function createChatBox(chatboxtitle, minimizeChatBox, user_name, newMsgContent, reciever_id, chat_type, message_type) {
		
				
				
		var testSound = new Audio();
		testSound.src = "/chat/assets/facebook_pop.mp3";
		testSound.play();
		Push.create('Hi there!', {
			body: 'This is a notification.',
			icon: 'icon.png',
			timeout: 8000,               // Timeout before notification closes automatically.
			vibrate: [100, 100, 100],    // An array of vibration pulses for mobile devices.
			onClick: function() {
				// Callback for when the notification is clicked. 
				console.log(this);
			}  
		});
		
					console.log("lost");
    var send_by = chatboxtitle;
    if (chat_type == 'group') {
        chatboxtitle = 'group1';
    } else {
        chatboxtitle = chatboxtitle;
    }
	
	
    if ($("#chatbox_" + chatboxtitle).length > 0) {
        if ($("#chatbox_" + chatboxtitle).css('display') == 'none') {
            $("#chatbox_" + chatboxtitle).css('display', 'block');
            restructureChatBoxes();
        }
        $("#chatbox_" + chatboxtitle + " .chatboxtextarea").focus();
	
        appendChat(send_by, user_name, newMsgContent, 'no', reciever_id, chat_type, message_type);
        return;
    }

    var def = {
        header: $('#headertmpl').text,
    };
    var all_data = {
        chat_type: chat_type.toString(),
        reciever_id: reciever_id.toString(),
        newMsgContent: newMsgContent.toString(),
        user_name: user_name.toString(),
        minimizeChatBox: minimizeChatBox.toString(),
        chatboxtitle: chatboxtitle.toString(),
        send_by: send_by.toString(),
        tthis: this,
    };
    var pagefn = doT.template($('#headertmpl').html());
    var temp = pagefn(all_data);
    // console.log(all_data);
    $(" <div />").attr("id", "chatbox_group1")
            .addClass("chatbox")
            .html(temp)
            .appendTo($("body"));
    uploader.listenOnInput(document.getElementById("siofu_input" + reciever_id));
//    $(" <div />").attr("id", "chatbox_" + chatboxtitle)
//            .addClass("chatbox")
//            .html('<div class="chatboxhead"><div class="chatboxtitle">' + user_name + '</div><div class="chatboxoptions"><a href="javascript:void(0)" onclick="javascript:toggleChatBoxGrowth(\'' + chatboxtitle + '\')">-</a> <a href="javascript:void(0)" onclick="javascript:closeChatBox(\'' + chatboxtitle + '\')">X</a></div><br clear="all"/></div><div class="chatboxcontent"></div><div><input type="file" name="file"/></div><div class="chatboxinput typingspan' + reciever_id + '' + send_by + '"><textarea class="chatboxtextarea" onkeydown="javascript:return checkChatBoxInputKey(event,this,\'' + send_by + '\',\'' + reciever_id + '\',\'' + chat_type + '\');"></textarea></div>')
//            .appendTo($("body"));
    $("#chatbox_" + chatboxtitle).css('bottom', '0px');
    chatBoxeslength = 0;
    for (x in chatBoxes) {
        if ($("#chatbox_" + chatBoxes[x]).css('display') != 'none') {
            chatBoxeslength++;
        }
    }
    if (chatBoxeslength == 0) {
        $("#chatbox_" + chatboxtitle).css('right', '20px');
    } else {
        width = (chatBoxeslength) * (300 + 7) + 20;
        $("#chatbox_" + chatboxtitle).css('right', width + 'px');
    }
    chatBoxes.push(chatboxtitle);

    if (minimizeChatBox == 1) {
        minimizedChatBoxes = new Array();

        if ($.cookie('chatbox_minimized')) {
            minimizedChatBoxes = $.cookie('chatbox_minimized').split(/\|/);
        }
        minimize = 0;
        for (j = 0; j < minimizedChatBoxes.length; j++) {
            if (minimizedChatBoxes[j] == chatboxtitle) {
                minimize = 1;
            }
        }

        if (minimize == 1) {
            $('#chatbox_' + chatboxtitle + ' .chatboxcontent').css('display', 'none');
            $('#chatbox_' + chatboxtitle + ' .chatboxinput').css('display', 'none');
        }
    }

    chatboxFocus[chatboxtitle] = false;

    $("#chatbox_" + chatboxtitle + " .chatboxtextarea").blur(function () {
        chatboxFocus[chatboxtitle] = false;
        $("#chatbox_" + chatboxtitle + " .chatboxtextarea").removeClass('chatboxtextareaselected');
    }).focus(function () {
        chatboxFocus[chatboxtitle] = true;
        newMessages[chatboxtitle] = false;
        $('#chatbox_' + chatboxtitle + ' .chatboxhead').removeClass('chatboxblink');
        $("#chatbox_" + chatboxtitle + " .chatboxtextarea").addClass('chatboxtextareaselected');
    });

    $("#chatbox_" + chatboxtitle).click(function () {
        if ($('#chatbox_' + chatboxtitle + ' .chatboxcontent').css('display') != 'none') {
            $("#chatbox_" + chatboxtitle + " .chatboxtextarea").focus();
        }
    });

    $("#chatbox_" + chatboxtitle).show();
    //  console.log('opening the new box' + "reciever_id = " + reciever_id);
	
    appendChat(send_by, user_name, newMsgContent, 'yes', reciever_id, chat_type, message_type);


}


function chatHeartbeat() {

    var itemsfound = 0;

    if (windowFocus == false) {

        var blinkNumber = 0;
        var titleChanged = 0;
        for (x in newMessagesWin) {
            if (newMessagesWin[x] == true) {
                ++blinkNumber;
                if (blinkNumber >= blinkOrder) {
                    document.title = x + ' says...';
                    titleChanged = 1;
                    break;
                }
            }
        }

        if (titleChanged == 0) {
            document.title = originalTitle;
            blinkOrder = 0;
        } else {
            ++blinkOrder;
        }

    } else {
        for (x in newMessagesWin) {
            newMessagesWin[x] = false;
        }
    }

    for (x in newMessages) {
        if (newMessages[x] == true) {
            if (chatboxFocus[x] == false) {
                //FIXME: add toggle all or none policy, otherwise it looks funny
                $('#chatbox_' + x + ' .chatboxhead').toggleClass('chatboxblink');
            }
        }
    }

    $.ajax({
        url: "chat.php?action=chatheartbeat",
        cache: false,
        dataType: "json",
        success: function (data) {

            $.each(data.items, function (i, item) {
                if (item) { // fix strange ie bug

                    chatboxtitle = item.f;

                    if ($("#chatbox_" + chatboxtitle).length <= 0) {
                        createChatBox(chatboxtitle);
                    }
                    if ($("#chatbox_" + chatboxtitle).css('display') == 'none') {
                        $("#chatbox_" + chatboxtitle).css('display', 'block');
                        restructureChatBoxes();
                    }

                    if (item.s == 1) {
                        item.f = username;
                    }

                    if (item.s == 2) {
                        $("#chatbox_" + chatboxtitle + " .chatboxcontent").append('<div class="chatboxmessage"><span class="chatboxinfo">' + item.m + '</span></div>');
                    } else {
                        newMessages[chatboxtitle] = true;
                        newMessagesWin[chatboxtitle] = true;
                        $("#chatbox_" + chatboxtitle + " .chatboxcontent").append('<div class="chatboxmessage"><span class="chatboxmessagefrom">' + item.f + ':&nbsp;&nbsp;</span><span class="chatboxmessagecontent">' + item.m + '</span></div>');
                    }

                    $("#chatbox_" + chatboxtitle + " .chatboxcontent").scrollTop($("#chatbox_" + chatboxtitle + " .chatboxcontent")[0].scrollHeight);
                    itemsfound += 1;
                }
            });

            chatHeartbeatCount++;

            if (itemsfound > 0) {
                chatHeartbeatTime = minChatHeartbeat;
                chatHeartbeatCount = 1;
            } else if (chatHeartbeatCount >= 10) {
                chatHeartbeatTime *= 2;
                chatHeartbeatCount = 1;
                if (chatHeartbeatTime > maxChatHeartbeat) {
                    chatHeartbeatTime = maxChatHeartbeat;
                }
            }

            setTimeout('chatHeartbeat();', chatHeartbeatTime);
        }});
}

function closeChatBox(chatboxtitle) {
	console.log('#chatbox_' + chatboxtitle);
    $('#chatbox_' + 'group1').css('display', 'none');
	
    restructureChatBoxes();

}

function toggleChatBoxGrowth(chatboxtitle) {
    if ($('#chatbox_group1' + ' .chatboxcontent').css('display') == 'none') {

        var minimizedChatBoxes = new Array();

        if ($.cookie('chatbox_minimized')) {
            minimizedChatBoxes = $.cookie('chatbox_minimized').split(/\|/);
        }

        var newCookie = '';

        for (i = 0; i < minimizedChatBoxes.length; i++) {
            if (minimizedChatBoxes[i] != chatboxtitle) {
                newCookie += chatboxtitle + '|';
            }
        }

        newCookie = newCookie.slice(0, -1)


        $.cookie('chatbox_minimized', newCookie);
        $('#chatbox_group1'  + ' .chatboxcontent').css('display', 'block');
        $('#chatbox_group1'  + ' .chatboxinput').css('display', 'block');
        $("#chatbox_group1"  + " .chatboxcontent").scrollTop($("#chatbox_" + chatboxtitle + " .chatboxcontent")[0].scrollHeight);
    } else {

        var newCookie = chatboxtitle;

        if ($.cookie('chatbox_minimized')) {
            newCookie += '|' + $.cookie('chatbox_minimized');
        }


        $.cookie('chatbox_minimized', newCookie);
        $('#chatbox_group1'  + ' .chatboxcontent').css('display', 'none');
        $('#chatbox_group1' + ' .chatboxinput').css('display', 'none');
    }

}
function appendChat(user_id, name, message, flag, sender_id, chat_type, message_type) {
    if (chat_type != "group") {
        if (flag == "yes") {
            $("#chatbox_group" + user_id + " .chatboxcontent").html();
            // send ajax call to get previous messages
            $.ajax({
                url: global_url + "home/getAllMessages",
                type: "POST",
                data: {uid: user_id, chat_type: chat_type},
                success: function (data) {
                    var obj = JSON.parse(data);
					$('#chatAudio')[0].play();
                    $("#chatbox_" + user_id + " .chatboxcontent").append(obj.html);
                    $("#chatbox_" + user_id + " .chatboxcontent").scrollTop($("#chatbox_" + user_id + " .chatboxcontent")[0].scrollHeight);
                }
            });
        } else {
            if (typeof message !== 'undefined' && $.trim(message) != "" && message != false) {
                if (message_type == "file") {
                    $("#chatbox_" + user_id + " .chatboxcontent").append('<div class="chatboxmessage sender"><span class="chatboxmessagefrom sender">' + name + ':&nbsp;&nbsp;</span><span class="chatboxmessagecontent"><a target="_blank" href="' + global_url + 'attachments/org/' + message.new_name + '"><br/><img class="txtpng" src="' + global_url + 'assets/images/txt.png"/> &nbsp;&nbsp; ' + message.event.file.name + ' </a></span></div>');
                    $("#chatbox_" + user_id + " .chatboxcontent").scrollTop($("#chatbox_" + user_id + " .chatboxcontent")[0].scrollHeight);
                } else {

                    $("#chatbox_" + user_id + " .chatboxcontent").append('<div class="chatboxmessage sender"><span class="chatboxmessagefrom sender">' + name + ':&nbsp;&nbsp;</span><span class="chatboxmessagecontent">' + message + '</span></div>');
                    $("#chatbox_" + user_id + " .chatboxcontent").scrollTop($("#chatbox_" + user_id + " .chatboxcontent")[0].scrollHeight);
                }
            }
        }
    } else {
        if (flag == "yes") {
            $("#chatbox_group1" + " .chatboxcontent").html();
            // send ajax call to get previous messages
            $.ajax({
                url: global_url + "home/getAllMessages",
                type: "POST",
                data: {uid: user_id, chat_type: chat_type},
                success: function (data) {
                    var obj = JSON.parse(data);
			
                    $("#chatbox_group1" + " .chatboxcontent").append(obj.html);
                    $("#chatbox_group1" + " .chatboxcontent").scrollTop($("#chatbox_group1" + " .chatboxcontent")[0].scrollHeight);
                }
            });
        } else {
            if (typeof message !== 'undefined' && $.trim(message) != "" && message != false) {
                if (message_type == "file") {
                    $("#chatbox_group1"  + " .chatboxcontent").append('<div class="chatboxmessage sender"><span class="chatboxmessagefrom sender">' + name + ':&nbsp;&nbsp;</span><span class="chatboxmessagecontent"><a target="_blank" href="' + global_url + 'attachments/org/' + message.new_name + '"><br/><img class="txtpng" src="' + global_url + 'assets/images/txt.png"/> &nbsp;&nbsp; ' + message.event.file.name + ' </a></span></div>');
                    $("#chatbox_group1" + " .chatboxcontent").scrollTop($("#chatbox_group1" + " .chatboxcontent")[0].scrollHeight);
                } else {
                    $("#chatbox_group1"  + " .chatboxcontent").append('<div class="chatboxmessage sender"><span class="chatboxmessagefrom sender">' + name + ':&nbsp;&nbsp;</span><span class="chatboxmessagecontent">' + message + '</span></div>');
                    $("#chatbox_group1"  + " .chatboxcontent").scrollTop($("#chatbox_group1" + " .chatboxcontent")[0].scrollHeight);
                }

            }
        }
    }
	
	
	


}
function checkChatBoxInputKey(event, chatboxtextarea, other_id, my_id, chat_type) {

    if (event.keyCode == 13 && event.shiftKey == 0) {
        var message = $(chatboxtextarea).val();
        message = message.replace(/^\s+|\s+$/g, "");
	
        $(chatboxtextarea).val('');
        $(chatboxtextarea).focus();
        $(chatboxtextarea).css('height', '44px');
        if (message != '') {
            //$.post("chat.php?action=sendchat", {to: chatboxtitle, message: message} , function(data){
            message = message.replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/\"/g, "&quot;");
//            $("#chatbox_" + other_id + " .chatboxcontent").append('<div class="chatboxmessage"><span class="chatboxmessagefrom">' + chat_name + ':&nbsp;&nbsp;</span><span class="chatboxmessagecontent">' + message + '</span></div>');
//            $("#chatbox_" + other_id + " .chatboxcontent").scrollTop($("#chatbox_" + other_id + " .chatboxcontent")[0].scrollHeight);
            $.ajax({
                url: global_url + "home/save_info",
                type: "POST",
                data: {name: chat_name, message: message, uid_to: other_id, chat_type: chat_type},
                success: function (data) {
                    if (chat_type == "group") {
                        var boxid = other_id;
                        var mesg = '<div class="chatboxmessage reciever"><span class="chatboxmessagefrom reciever">:' + chat_name + '</span><span class="chatboxmessagecontent rec">' + message + '</span></div>';
                        $("#chatbox_group" + boxid + " .chatboxcontent").append(mesg);
                        $("#chatbox_group" + boxid + " .chatboxcontent").scrollTop($("#chatbox_group" + boxid + " .chatboxcontent")[0].scrollHeight);
                        $("#messageInput").val('');
                    } else {
                        var boxid = other_id;
                        var mesg = '<div class="chatboxmessage reciever"><span class="chatboxmessagefrom reciever">:' + chat_name + '</span><span class="chatboxmessagecontent rec">' + message + '</span></div>';
                        $("#chatbox_" + boxid + " .chatboxcontent").append(mesg);
                        $("#chatbox_" + boxid + " .chatboxcontent").scrollTop($("#chatbox_" + boxid + " .chatboxcontent")[0].scrollHeight);
                        $("#messageInput").val('');
                    }
                    my_scoket.emit('private-message', {name: chat_name, message: message, reciever_id: boxid, sender_id: my_id, chat_type: chat_type});

                }
            });
            //});
        }
        chatHeartbeatTime = minChatHeartbeat;
        chatHeartbeatCount = 1;
        my_scoket.emit('typingnodetstop', {reciever_id: other_id, sender_id: my_id});
        return false;
    } else {
        my_scoket.emit('typingnode', {reciever_id: other_id, sender_id: my_id});
    }

    var adjustedHeight = chatboxtextarea.clientHeight;
    var maxHeight = 94;

    if (maxHeight > adjustedHeight) {
        adjustedHeight = Math.max(chatboxtextarea.scrollHeight, adjustedHeight);
        if (maxHeight)
            adjustedHeight = Math.min(maxHeight, adjustedHeight);
        if (adjustedHeight > chatboxtextarea.clientHeight)
            $(chatboxtextarea).css('height', adjustedHeight + 8 + 'px');
    } else {
        $(chatboxtextarea).css('overflow', 'auto');
    }

}

function startChatSession() {
    $.ajax({
        url: "chat.php?action=startchatsession",
        cache: false,
        dataType: "json",
        success: function (data) {

            username = data.username;

            $.each(data.items, function (i, item) {
                if (item) { // fix strange ie bug

                    chatboxtitle = item.f;

                    if ($("#chatbox_" + chatboxtitle).length <= 0) {
                        createChatBox(chatboxtitle, 1);
                    }

                    if (item.s == 1) {
                        item.f = username;
                    }

                    if (item.s == 2) {
                        $("#chatbox_" + chatboxtitle + " .chatboxcontent").append('<div class="chatboxmessage"><span class="chatboxinfo">' + item.m + '</span></div>');
                    } else {
                        $("#chatbox_" + chatboxtitle + " .chatboxcontent").append('<div class="chatboxmessage"><span class="chatboxmessagefrom">' + item.f + ':&nbsp;&nbsp;</span><span class="chatboxmessagecontent">' + item.m + '</span></div>');
                    }
                }
            });

            for (i = 0; i < chatBoxes.length; i++) {
                chatboxtitle = chatBoxes[i];
                $("#chatbox_" + chatboxtitle + " .chatboxcontent").scrollTop($("#chatbox_" + chatboxtitle + " .chatboxcontent")[0].scrollHeight);
                setTimeout('$("#chatbox_"+chatboxtitle+" .chatboxcontent").scrollTop($("#chatbox_"+chatboxtitle+" .chatboxcontent")[0].scrollHeight);', 100); // yet another strange ie bug
            }

            setTimeout('chatHeartbeat();', chatHeartbeatTime);

        }});
}

/**
 * Cookie plugin
 *
 * Copyright (c) 2006 Klaus Hartl (stilbuero.de)
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 *
 */

jQuery.cookie = function (name, value, options) {
    if (typeof value != 'undefined') { // name and value given, set cookie
        options = options || {};
        if (value === null) {
            value = '';
            options.expires = -1;
        }
        var expires = '';
        if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
            var date;
            if (typeof options.expires == 'number') {
                date = new Date();
                date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
            } else {
                date = options.expires;
            }
            expires = '; expires=' + date.toUTCString(); // use expires attribute, max-age is not supported by IE
        }
        // CAUTION: Needed to parenthesize options.path and options.domain
        // in the following expressions, otherwise they evaluate to undefined
        // in the packed version for some reason...
        var path = options.path ? '; path=' + (options.path) : '';
        var domain = options.domain ? '; domain=' + (options.domain) : '';
        var secure = options.secure ? '; secure' : '';
        document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
    } else { // only name given, get cookie
        var cookieValue = null;
        if (document.cookie && document.cookie != '') {
            var cookies = document.cookie.split(';');
            for (var i = 0; i < cookies.length; i++) {
                var cookie = jQuery.trim(cookies[i]);
                // Does this cookie string begin with the name we want?
                if (cookie.substring(0, name.length + 1) == (name + '=')) {
                    cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                    break;
                }
            }
        }
        return cookieValue;
    }
};
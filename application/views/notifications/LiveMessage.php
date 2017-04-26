<script>
function sendMessage(sendName, recvName, msgData, callBack)
{
	var req = $.post("<?php echo base_url() . "Message/send";?>", {sender: sendName, receiver: recvName, msgs: msgData});
	req.done(callBack);
}

function getMessages(sendName, recvName, callBack)
{
	var req = $.post("<?php echo base_url() . "Message/showMessages";?>", {sender: sendName, receiver: recvName});
	req.done(function(data)
	{
		var messages = data.split("\r\n");
		callBack(messages);
	});
}

function getBuyers(callBack)
{
	var req = $.post("<?php echo base_url() . "Notification/getBuyers"?>");
	req.done(function(data)
	{
		var messages = data.split("\r\n\r\n");
		for (var i = 0; i < messages.length; i++)
		{
			messages[i] = messages[i].split("\r\n");
		}
		callBack(messages);
	});
}

function getSellers(callBack)
{
	var req = $.post("<?php echo base_url() . "Notification/getSellers"?>");
	req.done(function(data)
	{
		var messages = data.split("\r\n\r\n");
		for (var i = 0; i < messages.length; i++)
		{
			messages[i] = messages[i].split("\r\n");
		}
		callBack(messages);
	});
}

</script>
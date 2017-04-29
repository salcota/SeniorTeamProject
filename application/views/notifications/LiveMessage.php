<script>
function sendMessage(sendName, recvName, msgData, callBack)
{
	var req = $.post("<?php echo base_url() . "Message/send";?>", {sender: sendName, receiver: recvName, msgs: msgData});
	req.done(callBack);
}

function getMessages(partnerID, partnerSeller, callBack)
{
	var destination = "<?php echo base_url() . "Notification/get_all_notifications/";?>" + partnerID + "/";
	if (partnerSeller)
		destination += "1";
	else
		destination += "0";
	
	var req = $.post(destination, {});
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
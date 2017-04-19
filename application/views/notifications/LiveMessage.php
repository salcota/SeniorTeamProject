<script>
function getUsers(callBack)
{
	var userList = $.post("<?php echo base_url() . "Message/getUsers"?>", {});
	userList.done(function (data) {
		var users = data.split("\r\n");
		callBack(users);
	});
}

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
</script>
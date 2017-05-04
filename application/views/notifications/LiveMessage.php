<script>
function LiveMessage(userID) {
	// Constants
	this.splitDetails = "\r\n";
	this.splitData = "\r\n\r\n";
	this.controller = "<?php echo base_url() . "Notification/";?>";
	
	// Run-time vars
	this.myID = userID;

	this.otherID = -1;
	this.otherSeller = false;
	this.itemID = -1;
	
	var parent = this;
	
	this.select = function(partnerID, partnerSeller, itemID = -1)
	{
		this.otherID = partnerID;
		this.otherSeller = partnerSeller;
		this.itemID = itemID;
	}

	this.getMessages = function(start, count, callBack)
	{
		if (this.otherID < 0)
			return;
		
		var destination = this.controller + "get_messages/" + this.otherID + "/";
		if (this.otherSeller)
			destination += "1";
		else
			destination += "0";
		
		destination += "/" + start + "/" + count;
		
		var req = $.post(destination, {});
		
		req.done(function(data)
		{
			var messages = data.split(parent.splitData);
			
			for (var i = 0; i < messages.length; i++)
			{
				messages[i] = messages[i].split(parent.splitDetails);
				messages[i][1] = parent.b64DecodeUnicode(messages[i][1]);
			}
			
			if (messages.length > 0)
				parent.itemID = messages[messages.length - 1][2];
			
			callBack(messages);
		});
	}
	
	this.countMessages = function(callBack)
	{
		if (this.otherID < 0)
			return;
		
		var destination = this.controller + "countNotifications/" + this.otherID + "/";
		if (this.otherSeller)
			destination += "1";
		else
			destination += "0";
		
		var req = $.post(destination, {});
		
		req.done(function(data)
		{
			callBack(data);
		});
	}
	
	this.countUnread = function(callBack)
	{
		if (this.otherID < 0)
			return;
		
		var destination = this.controller + "unread/" + this.otherID + "/";
		if (this.otherSeller)
			destination += "1";
		else
			destination += "0";
		
		var req = $.post(destination, {});
		
		req.done(function(data)
		{
			callBack(data);
		});
	}
	
	this.sendMessage = function(message, callBack = function(){})
	{
		if (this.otherID < 0 || this.itemID < 0 || message.length == 0)
			return;
		
		var req = $.post(this.controller + "send_notification", {receiver: this.otherID, item: this.itemID, msg: message});
		
		req.done(function(data)
		{
			callBack();
		});
	}

	this.getBuyers = function(callBack)
	{
		var req = $.post(this.controller + "getBuyers");
		
		req.done(function(data)
		{
			var messages = data.split(parent.splitData);
			for (var i = 0; i < messages.length; i++)
			{
				messages[i] = messages[i].split(parent.splitDetails);
			}
			callBack(messages);
		});
	}

	this.getSellers = function(callBack)
	{
		var req = $.post(this.controller + "getSellers");
		
		req.done(function(data)
		{
			var messages = data.split(parent.splitData);
			for (var i = 0; i < messages.length; i++)
			{
				messages[i] = messages[i].split(parent.splitDetails);
			}
			callBack(messages);
		});
	}
	
	this.b64EncodeUnicode = function(str) {
		return btoa(encodeURIComponent(str).replace(/%([0-9A-F]{2})/g, function(match, p1) {
			return String.fromCharCode('0x' + p1);
		}));
	}
	
	this.b64DecodeUnicode = function(str) {
		return decodeURIComponent(atob(str).split('').map(function(c) {
			return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
		}).join(''));
	}
}

</script>
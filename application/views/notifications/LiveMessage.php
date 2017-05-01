<script>
function LiveMessage(userID, username) {
	// Constants
	this.splitDetails = '<br>';
	this.splitData = '<br><br>';
	this.controller = "<?php echo base_url() . "Notification/";?>";
	
	// Run-time vars
	this.myID = userID;
	this.myName = username;

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

	this.getMessages = function(callBack)
	{
		if (this.otherID < 0)
			return;
		
		var destination = this.controller + "get_all_notifications/" + this.otherID + "/";
		if (this.otherSeller)
			destination += "1";
		else
			destination += "0";
		
		var req = $.post(destination, {});
		
		req.done(function(data)
		{
			var messages = data.split(parent.splitData);
			for (var i = 0; i < messages.length; i++)
			{
				messages[i] = messages[i].split(parent.splitDetails);
			}
			
			if (messages.length > 0)
				parent.itemID = messages[messages.length - 1][2];
			
			callBack(messages);
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
	
}

</script>
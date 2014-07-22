
// AJAX: How to use XMLHttpRequest:
// First instantiate an XMLHttpRequest object that can then call functions from the server. 

var xmlhttp;
function getNewHTTPObject()
{


        /** Special IE only code ... */
        /*@cc_on
          @if (@_jscript_version >= 5)
              try
              {
                  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
              }
              catch (e)
              {
                  try
                  {
                      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                  }
                  catch (E)
                  {
                      xmlhttp = false;
                  }
             }
          @else
             xmlhttp = false;
        @end @*/

        /** Every other browser on the planet */
        if (!xmlhttp && typeof XMLHttpRequest != 'undefined')
        {
            try
            {
                xmlhttp = new XMLHttpRequest();
            }
            catch (e)
            {
                xmlhttp = false;
            }
        }

        return xmlhttp;
}

// step 1 instantiate the XMLHttpRequest request
var xmlHttp = getNewHTTPObject();

//AJAX: Step 2, this function makes the XMLHttpRequest request

function onStopDB(url)
{
  xmlHttp.open('GET', url, true);
  xmlHttp.onreadystatechange = callbackFunction;
  xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xmlHttp.send(null);
}

// AJAX: step 3, the callback function set in xmlHttp.onreadystatechange will be called when data is back from the server

var syndLinkRequest = getNewHTTPObject();

function callbackFunction()
{
	if (syndLinkRequest.readyState != 4)
	{
		//alert('call returns readyState: '+syndLinkRequest.readyState);
		return;
	}
	var result = xmlHttp.responseText;
	if (result != 1)
		alert('Error returned on DB update. return value: '+result);

	// now hide the old message sequence on the web page so the user gets some feedback
	for (i=2; i < (seqArray.length - 3); i++)
	{
		document.getElementById('N'+i).style.visibility='hidden';
		//console.log("id 'N"+i+"' is now hidden");
	}
	
}

function messageAction(arid, cmd, curseq, Subject, mid)
{
	var url, i, msg = '';
	
	switch (cmd)
	{
		case '1':	//	Edit
			//document.EditRecord.submit();
			//alert('EditMessage.php?arid='+arid+'&mid='+mid+'&curseq='+curseq);
			parent.Monitor.location.href = 'EditMessage.php?arid='+arid+'&mid='+mid+'&curseq='+curseq;
			return;
			break;
		case '2': 	//	Delete
			//alert('Deleting message with subject |'+Subject+'| message number is '+curseq);
			url = 'DeleteMessage.php?arid='+arid+'&mid='+mid+'&curseq='+curseq;
			if(Subject != '') 
			{
				if(confirm('Are you sure you want to delete message number '+curseq+' Subject: ' +Subject + '?') == 0)
				{
					var xxx = document.getElementById('cmd'+curseq);
					xxx.value = 0;
					//alert(xxx.value);
					return;
				}
			}
			
			break;
		case '22': //delete batch
			//console.log("there are "+curseq+" messages to be deleted");
			for(i = 0; i < curseq; i++)
			{
				//console.log('message '+mid[i]+' will be deleted');
				msg += '&m'+i+'='+mid[i];
			}
			//console.log('URI: arid='+arid+'&curseq='+ (-1 * curseq)+msg);
			url = 'DeleteMessage.php?arid='+arid+'&curseq='+ (-1 * curseq)+msg;
			break;
			
		case '3':	//	Move Up
		case '4': 	//	Move Down
			url = "./MoveMessageAction.php?arid=" + arid + "&direction=" + cmd + "&curseq=" + curseq;
			break;
	}
			
	xmlHttp.open('GET', url, true);
	xmlHttp.onreadystatechange = messageActionCallback;
	xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xmlHttp.send(null);
}

function messageActionCallback()
{
	if (syndLinkRequest.readyState != 4)
	{
		//console.log('messageActionCallback readyState is : '+syndLinkRequest.readyState);
		return;
	}
	var result = xmlHttp.responseText;
	if (result != 1)
		alert('return value: '+result);
	else
		location.reload();
}


var midArray = new Array(); 
var seqArray = new Array();
var newOrder = new Array();
var subjectArray = new Array(); 
var delayArray = new Array(); 
//  first dimension: message number
// second dimension: 0 - mid 1 - seqno

function checkAll(mNumber, action, seqArray)
{
	//alert("checkAll "+mNumber+" action "+action);
	var box;
	for (i = 0; i < mNumber; i++)
	{
		if (seqArray[i] > 0) {
			box = document.getElementById('B'+seqArray[i]);
			box.checked=action; //'checked' or ''
		}
	}
	
}


function deleteChecked(arid, NumberOfMessages, midArray, seqArray)
{ 
	//alert('deleting');
	var box; var dRecords="", oRecords="", dMidArray = new Array(), i, d = 0;
	//var milliSeconds = 2000, startTime;
	
	if (confirm('Are you sure you want to delete *ALL* checked messages'))
	{
		for (i = 0; i < NumberOfMessages; i++)
		{
			box = document.getElementById('B'+seqArray[i]);
			//console.log('Message sequence: '+seqArray[i]+' is marked: '+box.checked);
			
			if (seqArray[i] > 0)
				if (box.checked == true)
				{
					//console.log("deleteChecked waiting "+milliSeconds+" milliseconds");
					//startTime = new Date().getTime(); // get the current time
					//while (new Date().getTime() < startTime + milliSeconds); // hog cpu
			
					//messageAction(arid, '2', seqArray[i], '', midArray[i]);
					dRecords += seqArray[i] + " ";
					dMidArray[d++] = midArray[i];
				}
				else
					oRecords += seqArray[i] + " ";			
		}
		//for(i=0;i<dMidArray.length;i++)
			//console.log("message ID "+dMidArray[i]+" to be deleted");
		messageAction(arid, '22', d, '', dMidArray);
	}

	//console.log("deleteChecked messages "+dRecords+"will be deleted\nrecords "+oRecords+"will be untouched");
}


//	Each message in the campaign will be listed here.
//	Every campaign will have the following common messages:
//	seqno	subject
//	-------	---------
//    -4		Broadcast Message
//	  -3		Subscription Confirmation Message, in a 2-step opt-in
//	  -2		Welcome Message
//	  -1		Unsubscribe Acknowledgement Message
//	   0		Campaign Signature
//
//	The format for each message div is to have 5  divs sitting side-by-side (float:left)
//+---------+----------+-------+-----------+---------+
//| command |select Box| Delay | Msg Number| Subject | 
//+---------+----------+-------+-----------+---------+

function WriteMessageTable(arid, seqArray, midArray, subjectArray, delayArray)
{
		var count; var MsgId; 
		var mHeight=30; // message line height
		var mN; 		// message number
		
		document.writeln("<div id='msgHeadings'><div class='box'>Chk</div>");
		document.writeln("<div class='msgNumber'>Seq</div><div class='delay'>Delay</div><div class='subject'>Subject</div></div>");
		document.writeln("<div id='Messages'>");
		
		for(count=0;count < seqArray.length; count++)
		{	
			mN = seqArray[count];
			
			document.write ("\n<div class='OneMessage "); 
			
			if (mN > 0)
				document.write("draggableMessage'");
			else
				document.write("specialMessage'");
				
			MsgId = 'M' + mN;

			document.write(" id='"+MsgId+"'>\n");  
			document.getElementById(MsgId).style.height=mHeight + 'px';	//spacing is mHeight px per message line

			//$sss = htmlentities($row->subject, ENT_QUOTES);
			sss=subjectArray[count];
			// limit subject to 55 characters
			if (sss.length > 55)
				sss = sss.substr(0, 55) + '...';
			
			document.write("<div class='box'><input id='B"+mN+"' type='checkbox'></div>");
			
			switch(mN)
			{
				case -4:
				case -3:
				case -1:
				case 0:
					document.write("<div class='msgNumber' id='N"+mN+"'></div>\n");
					break;
				case -2:
					document.write("<div class='msgNumber' id='N"+mN+"'>1</div>\n");
					break;
				default:
					document.write("<div class='msgNumber' id='N"+mN+"'>"+mN+"</div>\n");
					break;
			}
			
			if ((mN == - 2) || (mN > 0))
				document.write("<div class='delay' id='D"+mN+"'>    <label onclick='messageAction("+arid+", \"1\", "+mN+", \""+sss+"\", \""+midArray[count]+"\");'>"+delayArray[count]+"</label></div>\n");
			else
				document.write("<div class='delay' id='D"+mN+"'></div>\n");
			document.write("<div class='subject' id='S"+mN+"'>  <label onclick='messageAction("+arid+", \"1\", "+mN+", \""+sss+"\", \""+midArray[count]+"\");'>"+sss+"</label></div>");
			document.write("<div style='float:right;margin-right:10px;' id='arrows"+mN+"' class='ui-icon ui-icon-arrowthick-2-n-s'></div>");
			if (mN < 1)
			{
				document.getElementById('B'+mN).style.visibility='hidden';
				document.getElementById('arrows'+mN).style.visibility='hidden';
			}
			
			document.write("</div>\n"); //end of 1 message div

			if (mN == 0)
				document.write("<div id='sortableMessages'>");
		}	

		document.writeln("</div></div>\n<div id='Mbottom'>"); //end of sortableMessages div and Messages div
		document.close();
}

// jquery stuff

// function runs each time a message line is sorted
//
function onStop (event, ui) 
{ 
	var i, k, nn, messageOrder = "";
	
	//for (i = 0; i < seqArray.length; i++) //look at each msg sequence originally put in the array
	//	messageOrder += seqArray[i]+' ';
	//console.log('Original order: '+ messageOrder);
	messageOrder = "sortMessages.php?arid="+arid+"&nM="+seqArray.length;
	$('.msgNumber').each(function(k){	//look at the DOM's sequence
			nn = $(this).attr('id').substr(1); //ignore leading 'M' in the id
			kk = k - 1;
			messageOrder += "&nS" +kk+'='+nn;
			newOrder[k] = nn;
		});
	//console.log('URL of sort update: '+ messageOrder);
	
	// Even though only 2 messages are being changed at one time, all the message numbers 
	// must be potentially rewritten in the database every time a sort ends just in case, for example,
	// the first message is dragged behind the last message.
	onStopDB(messageOrder);
}

$(document).ready(function(){
	$('#sortableMessages').sortable({ 
							forcePlaceholderSize: true,	//creates a place that grows as a Message row is dragged in between 2 rows
							grid: [15,15],
							//tolerance: 'pointer',
							//containment: '#sortableMessages',
							handle: '.ui-icon',				// a message is dragged by this field 
							update: onStop					//execute this function once sort dragging stops and updates a sequence
							});	
/*
	$('.specialMessage').draggable({ 	opacity: 0.35,
										cursorAt: { cursor: 'move', top: 15, left: 105 }, 
										axis: 'y',
										containment: '#Messages',
										revert: true, 
										helper: 'clone' });
*/								
/*	
	$('.draggableMessage').draggable({  opacity: 0.35,
										cursorAt: { cursor: 'move', top: 15, left: 105 },
										axis: 'y',
										containment: '#Messages',
										//snap: '.draggableMessage',
										connectToSortable: '#Messages',
										//helper: 'clone',
										zIndex: 1000,
										grid: [15,15]
										/*
										start: function(event, ui) { 
											console.log("ui.offset.top at start: "+ ui.offset.top);
										},
										stop: function(event, ui) { 
											console.log("ui.offset.top at stop: "+ ui.offset.top); 
										}
									});
*/
/*
	$('.specialMessage').hover(function(){
			$(this).css('backgroundColor', '#fff');
		}, function(){
			$(this).css('backgroundColor', 'transparent');
		});
*/		
	$('.draggableMessage').hover(function(){
			$(this).css('backgroundColor', '#fff');
		}, function(){
			$(this).css('backgroundColor', 'transparent');
		});
	
	$('.ui-icon').hover(function(){
			$(this).css('cursor', 'move');
		}, function(){
			$(this).css('cursor', 'default');
		});
	
	$('#droppable').droppable({
			drop: function(event, ui) {
				$(this).addClass('ui-state-highlight').find('h2').html('Dropped!');
			}
	});
});
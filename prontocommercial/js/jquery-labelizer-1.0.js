/*
 	jQuery Labelizer
    Copyright (C) 2010 Cristi Habliuc <cristi.habliuc@gmail.com>

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/ 

// we keep the labels for multiple fields
var labelizerItems = {};

// fast unicode string trimming function
fastTrim = function (str) {
	var	str = str.replace(/^\s\s*/, ''),
		ws = /\s/,
		i = str.length;
	while (ws.test(str.charAt(--i)));
	return str.slice(0, i + 1);
}

// the main method body
jQuery.fn.labelize = function(options) {
	if (options == "" + options) {
		// it's a string, so use the short format
		var label = options;
		options = {
			label: label
		};
	}
	
	var settings = jQuery.extend({
	     label: "<Your label here>",		// the label to set as the value when nothing is entered
	     initialize: true					// set this to true if you want to set the label at initialization
	}, options);
	
	var obj = jQuery(this);					// the subject

	if (settings.initialize) {
		obj.val(settings.label);
	}
	
	labelizerItems[obj] = '';	
	obj.focus(function() {
		obj.val(labelizerItems[obj]);
	}); 
	obj.blur(function() {
		if (fastTrim(obj.val()) != '') {
			// we're not storing the trimmed version - that's other components' business
			labelizerItems[obj] = obj.val();
		} else {
			labelizerItems[obj] = '';
		}
		// same here, we're not storing the trimmed value, but the full value - not our business
		obj.val(fastTrim(obj.val()) != '' ? obj.val() : settings.label);
	});
};
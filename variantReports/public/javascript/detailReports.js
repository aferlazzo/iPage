"use strict";
(function require() {
	console.log("require test");
	
	/*
	*
	*	Our Report is made up of variants, one per row. We're going to build our Object-Oriented JavaScript 
	*	based on the concept of each row being an object.
	*
	*	
	*/
	
	
	
	// The Variant function is the parent for all other variant objects;
	// All variant objects will inherit from this Variant constructor
	function Variant(the_dbSNP, the_gene, the_chr, the_position, etc){
		this.dbSNP = the_dbSNP;
		this.gene = the_gene;
		this.chr = the_chr;
		this.etc = the_otherColumns;
	}
	
	// Define the prototype methods that will be inherited by all variants
	Variant.prototype = {
		constructor: Variant,
		buildGeneColumn: function() {
			var htmlString;
			
			htmlString = "<div>" + this.gene + "</div>";
			return htmlString;
		},
		buildGenePopup: function() {
			var htmlString;
			
			htmlString = "<div>" + this.gene + "</div>";
			return htmlString;
		},
		buildChromosomeColumn: function(){
			var htmlString;
			
			htmlString = "<div>" + this.gene + "</div>";
			return htmlString;
		},
		buildChromosomePopup: function(){
			var htmlString;
			
			htmlString = "<div>" + this.gene + "</div>";
			return htmlString;
		}
	};
	
	
	//now we can create each column and the popup for each column in the report row
	var thisVariant = new Variant(col1, col2, col3);
	thisVariant.buildGeneColumn();
	thisVariant.buildGenePopup();
	thisVariant.buildChromosomeColumn();
	thisVariant.buildChromosomePopup();

	
	
	
	
	
	
	// ============================================ Single Sample DataTable Functions ========================
	// ============================================ Single Sample Functions ==================================
	// ============================================ Ajax Calling Functions ===================================
	// ============================================ Event Handlers ===========================================
})();
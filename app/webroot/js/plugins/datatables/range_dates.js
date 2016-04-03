$.fn.dataTableExt.search.push(
	function( oSettings, aData, iDataIndex ) {
		var iFini = document.getElementById('min').value;
		var iFfin = document.getElementById('maximal').value;
		var iStartDateCol = 4;
		var iEndDateCol = 4;
		iFini=iFini.substring(0,4) + iFini.substring(5,7) + iFini.substring(8,10);
		iFfin=iFfin.substring(0,4) + iFfin.substring(5,7)+ iFfin.substring(8,10);

		var datofini=aData[iStartDateCol].substring(0,4) + aData[iStartDateCol].substring(5,7)+ aData[iStartDateCol].substring(8,10);
		//var datoffin=aData[iEndDateCol].substring(0,4) + aData[iEndDateCol].substring(5,7)+ aData[iEndDateCol].substring(8,10);
		
		if ( iFini == "" && iFfin == "" )
		{
			
			return true;
		}
		else if ( iFini <= datofini && iFfin == "")
		{
			console.log("iFini: "+iFini+" datofini: "+datofini+" iFfin: "+iFfin);
			return true;
		}
		else if ( iFfin >= datofini && iFini == "")
		{
			console.log("iFini: "+iFini+" datofini: "+datofini+" iFfin: "+iFfin);
			return true;
		}
		else if (iFini <= datofini && iFfin >= datofini)
		{
			console.log("iFini: "+iFini+" datofini: "+datofini+" iFfin: "+iFfin);
			return true;
		}else{
		console.log("iFini: "+iFini+" datofini: "+datofini+" iFfin: "+iFfin);
		}
		return false;
		
	}
);

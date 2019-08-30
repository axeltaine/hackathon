
function distance(lat1, lon1, lat2, lon2, unit = "K") {
    
	if ((lat1 == lat2) && (lon1 == lon2)) {
		return 0;
	}
	else {
		var radlat = Math.PI * lat1/180;
		var radlatmont = Math.PI * lat2/180;
		var theta = lon1-lon2;
		var radtheta = Math.PI * theta/180;
		var dist = Math.sin(radlat) * Math.sin(radlatmont) + Math.cos(radlat) * Math.cos(radlatmont) * Math.cos(radtheta);
		if (dist > 1) {
			dist = 1;
		}
		dist = Math.acos(dist);
		dist = dist * 180/Math.PI;
		dist = dist * 60 * 1.1515;
		if (unit=="K") { dist = dist * 1.609344 }
		
        return dist;
        
   
    }
   
};
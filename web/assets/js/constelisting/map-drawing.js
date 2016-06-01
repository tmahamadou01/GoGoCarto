function drawLineBetweenPoints(point1, point2, providerType = 'producteur', map_, options)
{
  	var LineStart = point1;
  	var LineEnd = point2;

	var LineArray = [
    	{lat: LineStart.lat(), lng: LineStart.lng()},
    	{lat: LineEnd.lat(), lng: LineEnd.lng()}
  	];

  	var options = options || {};
  	// valeurs par default
  	options.lineType = options.lineType || 'normal';
  	options.strokeOpacity = options.strokeOpacity || 0.5;
  	options.strokeWeight = options.strokeWeight || 3;

  	var color = '#AE3536';

	switch(providerType) 
	{
	    case 'producteur': color = '#B33536'; break;
	    case 'amap': color = '#4B7975'; break;
	    case 'boutique': color = '#813c81'; break;
	    case 'marche': color = '#3F51B5'; break;
	    case 'epicerie': color = '#383D5A'; break;
	}

	if (options.lineType == 'dashed')
	{
		var poly = new google.maps.Polyline({
			path: LineArray,
			strokeOpacity: 0,
			icons: [{
			  icon: {
			    path: 'M 0,-1 0,1',
			    strokeOpacity: options.strokeOpacity,
			    strokeWeight: options.strokeWeight,
			    strokeColor: '#777',
			    scale: 4
			  },
			  offset: '0',
			  repeat: '20px'
			}],
		});
		poly.isDashed = true;
	}
	else
	{
		var poly = new google.maps.Polyline({
			path: LineArray,
			strokeColor: color,
			strokeOpacity: options.strokeOpacity,
			strokeWeight: options.strokeWeight,
		});

		poly.isDashed = false;
	}

	poly.setMap(map_);

	return poly;  		
}



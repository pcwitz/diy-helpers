var socialMedia = {
	facebook: 'http://diyhelpers.com/viewsource',
	twitter: 'http://twitter.com/diyhelpers',
	flickr: 'http://flickr.com/diyhelpers',
	youtube: 'http://youtube.com/diyhelpers'
}

var social = function() {
	var output = '<ul>', mediaNodeList = document.querySelectorAll('nav.socialmedia'); //using querySelectorAll you can insert the nav multiple times, anywhere

	for(var key in arguments[0]) {
		output += '<li><a href="' + socialMedia[key] + '">' + '<img src="images/' + key + '.png" " alt="icon for ' + key + '">' + '</a></li>';
	}
	output += '</ul>';

	for (var i = mediaNodeList.length - 1; i >= 0; i--) {
		mediaNodeList[i].innerHTML = output;
	}
}(socialMedia);  //this way: assigning function to variable (above) and inserting arguments here it runs without calling it
/**
 * @author Nathan
 */

var Carousel = (function(){				 
	var pub = {};
	
	var catList, imageIndex, pub;

function nextImage() {
	var moviecat = catList[imageIndex];
	document.getElementById("carousel").innerHTML = moviecat.makeHTML();
	//document.getElementById("carousel").innerHTML = 
	//"<img src ='" + catList[imageIndex] + "'>";
	imageIndex++;
	if (imageIndex == catList.length) {
		imageIndex = 0;
	}
}

function MovieCategory(title, image, page) {
	this.title = title;
	this.image = image;
	this.page = page;
	this.makeHTML = function() {
		var ret_str;
		ret_str = "<a href='" + this.page + "'><figure>";
		ret_str += "<img src = '" + this.image + "'><figure>";
		ret_str += "<figcaption>" + this.title + "</figcaption></figure></a>";
		return ret_str;
	}
}

pub.setup = function() {
	catList = [];
	catList.push(new MovieCategory("Classics", "images/Metropolis.jpg", "classic.php"));
	catList.push(new MovieCategory("Science Fiction and Horror", "images/Plan_9_from_Outer_Space.jpg", "scifi.php"));
	catList.push(new MovieCategory("Alfred Hitchcock", "images/Vertigo.jpg", "hitchcock.php"));
	imageIndex = 0;
	nextImage();
	setInterval(nextImage, 2000);
};
return pub;
}());

if (window.addEventListener) { 
window.addEventListener('load', Carousel.setup);
} else if (window.attachEvent) { 
window.attachEvent('onload', Carousel.setup);
} else {
alert("Could not attach 'Carousel.setup' to the 'window.onload' event");
}
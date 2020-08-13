let cookies = (function(){
	cookie = {};
	lines = document.cookie.split(';')
	for(var l of lines){
		entry = l.trim().split('=');
		cookie[entry[0]] = entry[1];
	}
	return cookie;
}());

let size = cookies['size'];
seaBattle = {};
window.onload = function () {
	seaBattle.theGame = new seaBattle.Game();
		if(size==10)
			seaBattle.theGame.prepare(10,10,4);
		else
			seaBattle.theGame.prepare(7,7,3);
}


seaBattle = {};
let size = location.href.split("=")[1];
window.onload = function () {
	seaBattle.theGame = new seaBattle.Game();
		if(size==10)
			seaBattle.theGame.prepare(10,10,4);
		else
			seaBattle.theGame.prepare(7,7,3);
}
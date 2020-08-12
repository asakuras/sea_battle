seaBattle.Game = function () {
	var result = null;
	this.playerField = null;
	this.enemyField = null;

	this.prepare = function(width, height, maxShipSize) {
		this.playerField = new seaBattle.Field(width, height, maxShipSize),
		this.enemyField = new seaBattle.Field (width, height, maxShipSize),
		enemy = new seaBattle.Player(width, height);
		for (var i = 0; i < width; i++) {
			for (var j = 0; j < height; j++) {
				var playerCell = new seaBattle.Cell(i, j);
				var enemyCell = new seaBattle.Cell(i,j);
				playerCell.field = this.playerField;
				enemyCell.field = this.enemyField;
				this.playerField.addCell(playerCell);
				this.enemyField.addCell(enemyCell);
			}
		}
	
	// creates objects 'ship' for each field
		for (var k = 0; k < this.playerField.maxShipSize ; k++) {
			for (var m = 0; m < (this.playerField.maxShipSize - k); m++) {
				var playerShip = new seaBattle.Ship(k+1);
				var enemyShip = new seaBattle.Ship(k+1);
				this.playerField.addShip(playerShip, m);
				this.enemyField.addShip(enemyShip, m);
			}
		}

		this.playerField.draw('playerField', false );
	}
	
	this.start = function  () {
		this.enemyField.draw('enemyField');
		this.enemyField.arrangeShipRandomly();
		let div = document.querySelector(".container");
		let width = this.playerField.width;
		if(width == 10){
			div.setAttribute('id','bg-game-play-10x10');

		}
		else{
			div.setAttribute('id','bg-game-play-7x7');

		}
	} 
	
	this.priority = function (result) {
		this.checkShipsLeft();
		if (result == 'miss') {
			enemy.move();
		}
		return;
	}
	this.checkShipsLeft = function () {
		var plField = document.getElementById('playerField');
		var enField = document.getElementById('enemyField');
		var playerShipsCrashed = plField.querySelectorAll('.sank').length;
		var enemyShipsCrashed = enField.querySelectorAll('.sank').length;
		var maxShipSize = this.playerField.maxShipSize;
		var totalShips = maxShipSize * (maxShipSize + 1) * (maxShipSize + 2) / 6;
		console.log(totalShips + " " + playerShipsCrashed);
		if (playerShipsCrashed == totalShips)  {
			this.enemyField.drawLiveShips();
			this.enemyField.delCelEvents();
			alert ('ЛУЗЕР!!');
		}
		else {
			if (enemyShipsCrashed == totalShips) {
				this.enemyField.delCelEvents();
				alert('Поздравляем! Ты нереально крут!)');
			}
		}
	}
		
}
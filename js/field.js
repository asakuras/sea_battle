seaBattle.Field = function (width, height,maxShipSize) {
	this.maxShipSize = maxShipSize;
	this.width = width;
	this.height = height;
	this.cells = [];
	this.ships = [];
	//size (s), number (n) of current ship 
	var s = this.maxShipSize-1,
		n = 0;

	//variables used when ships arranged manually
	var lastX = 'empty',
		lastY = null,
		h = false,
		v = false;

	let ajaxShip = [];
	let pointShip = 0;
	let requestShip=null;
	let ready=false,
		First=false;

	for (var i = 0; i < width; i++) {
		this.cells.push([]);
		for (var j = 0; j < height; j++) {
			this.cells[i].push(null);
		}
	}

	for (var k = 0; k < this.maxShipSize ; k++) {
		this.ships.push([]);
		for (var m = 0; m < (this.maxShipSize - k); m++) {
			this.ships[k].push(null);
		}
	}
	
	this.addCell = function (cell) {
		this.cells[cell.x][cell.y] = cell;
	}
	
	this.addShip = function (ship, orderNumber) {
		this.ships[ship.size-1][orderNumber] = ship; 
	}
	
	this.draw = function (attachment, randomly) {
		var table = document.createElement('table');
		table.setAttribute('id', attachment);
		table.setAttribute('align', 'left');
		div = document.querySelector('#game_table');
		div2 = document.querySelector(".container");
		if(width == 7){
			div.style.width="38%";
			div.style.paddingTop="15%";
			div2.setAttribute('id','bg-game-setting-7x7');
		}
		else{
			div.style.width="51%";
			div.style.paddingTop="12%";
			div2.setAttribute('id','bg-game-setting-10x10');
		}
		div.appendChild(table);	
		for (var y = 0; y < this.width; y++) {
			var tr = document.createElement('tr');
			table.appendChild(tr);
			for (var x = 0; x < this.height; x++) {
				var td = this.cells[x][y].createElement(attachment, randomly);
				tr.appendChild(td);
			}
		}
	}

	this.addCelEvents = function () {
		for (let i = 0; i < width; i++) {
			for (let j = 0; j < height; j++) {
				if(this.cells[i][j].state=='empty'||this.cells[i][j].state=='ship-horizontal'||this.cells[i][j].state=='ship-begin-horizontal'
					||this.cells[i][j].state=='ship-end-horizontal'||this.cells[i][j].state=='ship-vertical'
					||this.cells[i][j].state=='ship-end-vertical'||this.cells[i][j].state=='ship-begin-vertical') {
					this.cells[i][j].addEvent('click');
				}
			}
		}
	};

	this.delCelEvents = function () {
		for (var i = 0; i < width; i++) {
		for (var j = 0; j < height; j++) {
		this.cells[i][j].delEvent('click');
		}
		}
	}

	//Arranges ships randomly
	this.arrangeShipRandomly = function ( ) {

		for (s; s >= 0 ; s--) {
			for (n =0 ; n < (this.maxShipSize - s); n++) {
				size = this.ships[s][n].size;
				var orientation = (Math.round(Math.random()) == 0) ? 'vertical' : 'horizontal';
				var check = false;
					while (!(check)) {
						var orientation = (Math.round(Math.random()) == 0) ? 'vertical' : 'horizontal';
						var randomX = ( Math.round( Math.random()*width- 0.5 ) );
						var randomY = ( Math.round( Math.random()*height- 0.5 ) );
						check = this.checkPlace (randomX, randomY, size, orientation);
					}
				this.ships[s][n].orientation = orientation;
				this.putShip (this.ships[s][n], randomX, randomY);
			}
		}
	}
	
	this.arrangeShip = function (x,y) {

		if (lastX == 'empty')  {
			h = this.checkPlace (x,y,s + 1, 'horizontal');
			v = this.checkPlace (x,y,s + 1, 'vertical');
			if ( (!v) && (!h) ) {
				return; 
			}
			lastX = x;
			lastY = y;
			this.cells[x][y].setClassName('darkblue');
		}
		else {
			if ( ( (x == lastX) && v ) || (s == 0) ) { 
				this.ships[s][n].orientation = 'vertical'
			}
			else {
				if ((y == lastY) && h) {
					this.ships[s][n].orientation = 'horizontal'
				}
				else {
					let message=null;
					if(x == lastX) message = "Your ship can\'t be vertical！";
					else if (y != lastY) message = "You can\'t put your ship except vertical or horizontal!";
					else if((y==lastY)&&v) message = "Your ship can\'t be horizontal！";
					alert (message);
					return;
				}
			}

			this.putShip(this.ships[s][n], lastX, lastY);
			this.ships[s][n].draw();
			
			//checks if all ships are placed
			if ((s == 0) && (n == this.maxShipSize-1)) {
				this.delCelEvents();
				if(mode=='human'){
					ajaxRequest('./game/prepare.php','post',{chessboard:ajaxShip},
						function () {
							console.log("Wait a moment for your enemy.");
							ready=true;
							let timer=setInterval(function () {
								ajaxRequest('./game/waitstart.php','get',{},
									function () {
										let result=JSON.parse(this.responseText);
										requestShip=result.opponentboard;//对手棋盘信息
										First=result.firstmove;//先手信息
										console.log(requestShip);
										if(!!requestShip){
											seaBattle.theGame.start(requestShip,First,mode);
											clearInterval(timer);
											timer=null;
										}
									},function () {
										console.log("无响应500");
									})
							},800);
						},function () {
							alert("Maybe you are offline.");
						});
					if(ready){
						
					}
				}
				else seaBattle.theGame.start(null,null,mode);
				return;
			}
			
			//goes to next ship
			if (n < (this.maxShipSize - s-1) ) {
				n++ ;
			}
			else {
				n=0;
				s--;
			}
			
			lastX = 'empty';
			lastY = null;
		}
	} 
		
	//Checks if there is enough free space for the ship (coordinates of beginning are known)
	this.checkPlace = function ( x, y, size, orientation ) {
		var coords = {};
		var cellX = this.cells[x];
		var check = false;
		var cellState = null;
		if ( ( cellX == undefined ) || (cellX[y] == undefined) || (cellX[y].state == 'miss') || (cellX[y].state == 'ship-crashed') || (cellX[y].state == 'sank') ) {
			return false;
		}
		// choses which of coordinates (x and y) is crosscut and which is lenghtway
		if (orientation == 'vertical') {
			var keyX = 'crosscut',
			keyY = 'lengthway' ;
		}
		else {
			var keyX ='lengthway', 
			keyY = 'crosscut' ;
		}
		coords[keyX] = x;
		coords[keyY] = y;
				
		if ((coords.lengthway+size)> width) { 
			return false; // checks if ship goes beyond field
		}
		coords.lengthway --;
		var m = coords.crosscut;
		for ( var i = 0; i < size + 2; i++ ) {
			for ( var j = -1; j <= 1 ; j++ ) { 
			//check the neighboring cells of the longitudinal coordinate
				coords.crosscut = m + j;
				if ((this.cells[ coords[keyX] ]!= undefined) && (this.cells[ coords[keyX] ][ coords[keyY] ] != undefined )) {
						cellState = this.cells[ coords[keyX] ][ coords[keyY] ].state;
					check = (orientation) ? ( cellState == 'empty') : (cellState != 'sank');
					if   (!(check)) { 
						return false;	
					}
				}
			}
		coords.lengthway++;	
		}
		return true;
	}	
	
	//sets ship into the cell due to initial coordinates and orientation
	this.putShip = function(ship, x, y) {
		for ( var i = 0; i < ship.size ; i++) {
			ship.decks[i] = this.cells[x][y];
			this.cells[x][y].ship = ship;
			ajaxShip[pointShip++]=10*x+y;
			ship.makeState(i);
			if (ship.orientation == 'vertical') {
				y++;
			}
			else {
				x++;
			}
		}
	}
	
	this.drawLiveShips = function () {
		for (var k = 0; k < this.maxShipSize ; k++) {
			for (var m = 0; m < (this.maxShipSize - k); m++) {
				if (this.ships[k][m].lives != 0) {
					this.ships[k][m].draw(false);
				}
			}
		}	
	}
}
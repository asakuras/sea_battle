seaBattle.Game = function () {
	var result = null;
	this.playerField = null;
	this.enemyField = null;

	let tmpcoords=null;
	let cookies=setcookie();
	let opponent=cookies['opponent'];

	this.prepare = function(width, height, maxShipSize) {
		this.playerField = new seaBattle.Field(width, height, maxShipSize);
		this.enemyField = new seaBattle.Field (width, height, maxShipSize);
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
				this.playerField.addShip(playerShip, m);
				if(mode=='ai'){
					var enemyShip = new seaBattle.Ship(k+1);
					this.enemyField.addShip(enemyShip, m);
				}
			}
		}

		this.playerField.draw('playerField', false );
	};
	
	this.start = function  (requestShip,First,mode) {
		if(mode=='human'){
			let ships=requestShip.split(',');
			let nShip=0;
			for (let k = this.playerField.maxShipSize; k > 0 ; k--) {
				for (let m = 0; m < (this.playerField.maxShipSize - k + 1); m++) {
					let enemyShip = new seaBattle.Ship(k);
					for(let n=0;n<enemyShip.size;n++){
						let x=parseInt(parseInt(ships[nShip])/10+''),y=parseInt(ships[nShip])%10;
						let nx,ny,hv;
						if(nShip<ships.length&&n<enemyShip.size-1){
							nx=parseInt(parseInt(ships[nShip+1])/10+'');
							ny=parseInt(ships[nShip+1])%10;
							hv=nx==x?'v':'h';
						}
						if(n==0){
							if(k==1)this.enemyField.cells[x][y].state='ship-begin-vertical';
							else if(hv=='h')this.enemyField.cells[x][y].state='ship-begin-horizontal';
							else this.enemyField.cells[x][y].state='ship-begin-vertical';
						}
						else if(n==enemyShip.size-1){
							if(hv=='h')this.enemyField.cells[x][y].state='ship-end-horizontal';
							else this.enemyField.cells[x][y].state='ship-end-vertical';
						}
						else{
							if(hv=='h')this.enemyField.cells[x][y].state='ship-horizontal';
							else this.enemyField.cells[x][y].state='ship-vertical';
						}
						enemyShip.decks[n]=this.enemyField.cells[x][y];
						this.enemyField.cells[x][y].ship=enemyShip;
						nShip++;
					}
					this.enemyField.addShip(enemyShip, m);
				}
			}
			this.enemyField.draw('enemyField');
			if(!First){
				document.getElementById('your_turn').style.display='none';
				document.getElementById('opponent_turn').style.display='inline';
				this.enemyField.delCelEvents();
				this.waitEnemy();
			}
			else{
				document.getElementById('your_turn').style.display='inline';
				document.getElementById('opponent_turn').style.display='none';
			}
		}
		else {
			this.enemyField.arrangeShipRandomly();
			this.enemyField.draw('enemyField');
		}
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
		if(mode=='ai'){
			this.checkShipsLeft();
			if (result == 'miss') {
				enemy.move();
			}
		}
		else {
			let enemyField=this.enemyField;
			enemyField.delCelEvents();
			let your_turn=document.getElementById('your_turn');
			let opponent_turn=document.getElementById('opponent_turn');
			if(this.checkShipsLeft()==2){
				if (result == 'miss') {
					this.waitEnemy();
					your_turn.style.display='none';
					opponent_turn.style.display='inline';
				}
				else {
					let timer=setInterval(function () {
						ajaxRequest('game/nextstep.php','get',{opponent:opponent},
							function () {
								enemyField.addCelEvents();
								clearInterval(timer);
								timer=null;
								alert("Continue your shoot!");
							},function () {
								alert('Maybe you are offline.');
							})
					},1000);
				}
			}
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
		let win_status = document.getElementById("win_status");
		if (playerShipsCrashed == totalShips)  {
			this.enemyField.drawLiveShips();
			this.enemyField.delCelEvents();
			return 0;
		}
		else {
			if (enemyShipsCrashed == totalShips) {
				this.enemyField.delCelEvents();
				return 1;
			}
		}
		return 2;
	}

	this.waitEnemy=function () {
		let x=null;
		let y=null;
		let flag=null;
		let end=null;
		let timer=null;
		let enemyField=this.enemyField;
		let playerField=this.playerField;
		let thisGame=this;
		timer=setInterval(function (){
			ajaxRequest('game/nextstep.php','get',{opponent:opponent},
				function () {
				console.log(this.responseText);
					let result=JSON.parse(this.responseText);
					let state;
					x=result.x;
					y=result.y;
					end=result.islast;
					if((10*x+y)!=tmpcoords&&x!==null){
						flag=result.nextflag;
						switch (flag) {
							case 0:state='miss';break;
							case 1:state='ship-crashed';break;
							case 2:state='sank';
						}
						playerField.cells[parseInt(x)][parseInt(y)].state=state;
						playerField.cells[parseInt(x)][parseInt(y)].setClassName(state);
						if(flag==2)playerField.cells[parseInt(x)][parseInt(y)].ship.draw('sank');
						if(flag==0){
							enemyField.addCelEvents();
							document.getElementById('your_turn').style.display='inline';
							document.getElementById('opponent_turn').style.display='none';
							clearInterval(timer);
							timer=null;
						}
						else if(end){
							thisGame.enemyField.drawLiveShips();
							document.getElementById('opponent_turn').style.display='none';
							clearInterval(timer);
							timer=null;
						}
						tmpcoords=10*x+y;
					}
				},function () {
					console.log('');
				})},1000);
	}
}
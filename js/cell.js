seaBattle.Cell = function (x, y) {
	var empty = 'empty',
		miss = 'miss',
		ship = 'ship-horizontal',
		shipBegin = 'ship-begin-horizontal',
		shipEnd = 'ship-end-horizontal',
		ship = 'ship-vertical',
		shipBegin = 'ship-begin-vertical',
		shipEnd = '`ship-end-vertical`',
		shipCrashed = 'ship-crashed',
		sank = 'sank';
		
	var handlerClick = null;
		
	this.x = x;
	this.y = y;
	this.state = empty;
	this.ship = null;
	this.td = null;
	this.field = null;

	let user2id=setcookie()['opponent'];
	
	this.setClassName = function (state) {
		this.td.className = (state == 'sank') ? state : ('standart-cell '+ state);   
	}

	this.createElement = function (attachment, randomly) {
		this.td = document.createElement('td');
		this.td.setAttribute('data-x', this.x);
		this.td.setAttribute('data-y', this.y);

		//Enemy`s Field. Click means shot.
		if (attachment == 'enemyField') {
			this.td.className = 'standart-cell '+'empty';
			handlerClick = this.shoot.bind(this);
			this.td.addEventListener('click', handlerClick );
		}
		else {
			this.td.className = 'standart-cell '+this.state;
			handlerClick = this.clicked.bind(this);
			this.td.addEventListener('click', handlerClick);
		}
		return this.td;
	};
	
	this.clicked = function () {
		this.field.arrangeShip(this.x, this.y);
	}
			
	this.shoot = function (event) {
		var shotResult = this.checkShot();
		this.delEvent('click', handlerClick);
		seaBattle.theGame.priority(shotResult);
	}

	this.addEvent = function (event) {
		this.td.addEventListener(event, handlerClick );
	};

	this.delEvent = function (event) {
		this.td.removeEventListener(event, handlerClick );
	}
	
	//cheks shot result
	this.checkShot = function () {
		let flag=0;
		let x=this.x;
		let y=this.y;
		if (this.state == 'empty') {
			this.state ='miss';
			if(mode==='human'){
				ajaxRequest('./game/getaclick.php','post',{x:x,y:y,nextflag:flag,isfinish:0,opponent:user2id},
					function () {
						console.log('wait for your opponent');
					},
					function () {
						alert("Maybe you are offline.");
					});
			}
		}
		else {
			this.ship.lives --;
			if (this.ship.lives == 0) {
				this.ship.draw ('sank');
				this.state = 'sank';
				flag=2;
			}
			else {
				this.state = 'ship-crashed';
				flag=1;
			}
			if(mode==='human'){
				let end = seaBattle.theGame.checkShipsLeft()==1?1:0;
				console.log(end+'===end');
				ajaxRequest('./game/getaclick.php','post',{x:x,y:y,nextflag:flag,isfinish:end,opponent:user2id},
					function () {

					},
					function () {
						alert("Maybe you are offline.");
					});
			}
		}
		this.setClassName(this.state);
		return this.state;
	}	
}


seaBattle.Seek=function () {
    let seek_player=document.getElementById('seek_player');
    let acceptOthers=document.getElementById('invitation-table').querySelectorAll('a');
    for(let i=0;i<5;i++){
        acceptOthers[i].onclick=selectone;
    }

    seek_player.onclick=function () {
        ajaxRequest('joininwait.php','post',{},
            function () {
                tellstart();
            },function () {
                console.log('fail to join in table');
            });
    };

    function selectone() {
        let user2id=acceptOthers.getAttribute('userid');
        ajaxRequest('selectone.php','post',{chooseid:user2id},
            function () {
                tellstart();
            },function () {
                console.log('your opponent is selected');
            });
    }

    function tellstart() {
        let ismatch=null;
        let opponent=null;
        let timer=setInterval(function () {
            ajaxRequest('tellstart.php','get',{},
                function () {
                    let result=JSON.parse(this.responseText);
                    ismatch=result.ismatch;
                    opponent=result.opponent;
                    if(ismatch==1){
                        document.cookie="opponent="+opponent;
                        window.location.href="game.php";
                        clearInterval(timer);
                        timer=null;
                    }
                },function () {
                    console.log('wait a moment');
                })
        },500);
    }
};
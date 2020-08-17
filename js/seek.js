window.onload=function(){
    let seek_player=document.getElementById('seek_player');
    let acceptOthers=document.getElementById('invitation-table').querySelectorAll('ul a');
    for(let i=0;i<acceptOthers.length;i++){
        acceptOthers[i].onclick=selectone;
    }

    seek_player.onclick=function () {
        seek_player.setAttribute("src","img/seeking.png");
        ajaxRequest('match/joininwait.php','post',{},
            function () {
                console.log("join in table");
                tellstart();
            },function () {
                console.log('fail to join in table');
            });
    };

    function selectone() {

        let user2id=this.getAttribute('userid');
        console.log(user2id);
        ajaxRequest('match/selectone.php','post',{chooseid:user2id},
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
            ajaxRequest('match/tellstart.php','get',{},
                function () {
                    console.log(this.responseText);
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
}

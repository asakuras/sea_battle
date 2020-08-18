window.onload=function(){
    function setcookie(){
        cookie = {};
        lines = document.cookie.split(';')
        for(var l of lines){
            entry = l.trim().split('=');
            cookie[entry[0]] = entry[1];
        }
        return cookie;
    }
    let seek_player=document.getElementById('seek_player');
    let isseeking = false;
    let acceptOthers=document.getElementById('invitation-table').querySelectorAll('ul a');
    let link_memory =new Array();
    let cookies = setcookie();
    let role = cookies['role'];
    for(let i=0;i<acceptOthers.length;i++){
        acceptOthers[i].onclick=selectone;
    }
    console.log(link_memory);
    if(role == 'tourist'){
        seek_player.style.opacity=0.4;
    }
    else{
        seek_player.onclick=function () {
            if(isseeking == false){
                seek_player.setAttribute("src","img/seeking.png");
                for(let i=0;i<acceptOthers.length;i++){
                    acceptOthers[i].onclick=null;
                    acceptOthers[i].style.color="grey";
                }
                isseeking = true
                ajaxRequest('match/joininwait.php','post',{},
                    function () {
                        console.log("join in table");
                        tellstart();
                    },function () {
                        console.log('fail to join in table');
                    });
            }
            else{
                isseeking = false;
    
                window.location.href = "cancelwait.php";
            }
            
        };
    }


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

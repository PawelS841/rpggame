let fullplayerhp=document.querySelector("#phpo").innerHTML
    let newplayehp

    let playepercent
    let fullenemyhp=document.querySelector("#ehpo").innerHTML
    let newenemyhp
    let enemypercent

    function attack() 
    {
        document.querySelector("#playerspeed").style.transition = attackspeed + "s ease";
        document.querySelector("#playerspeed").style.width="0%"
        setTimeout(() => {
            let enemyhp=document.querySelector("#ehpo").innerHTML
            newenemyhp=enemyhp-playerdmg;
            enemypercent=newenemyhp/fullenemyhp*100
            if(newenemyhp>0)document.querySelector("#ehpo").innerHTML=newenemyhp;
            else 
            {
                document.querySelector("#ehpo").innerHTML=0;
            }
            if(enemypercent>0)document.querySelector("#enemyhp").style.width=enemypercent+"%"
            else document.querySelector("#enemyhp").style.width="0%"
            document.querySelector("#playerspeed").style.transition = "0s ease";
            document.querySelector("#playerspeed").style.width="100%"
            if(newenemyhp<=0)
            {
                clearInterval(playerattack) 
                win()
            }

        }, attackspeed*1000);
    }

    function monsterattack() 
    {
        document.querySelector("#enemyspeed").style.transition = monsterattackspeed + "s ease";
        document.querySelector("#enemyspeed").style.width="0%"

        setTimeout(() => {
            let playerhp=document.querySelector("#phpo").innerHTML
            newplayehp=playerhp-monsterdmg;
            playepercent=newplayehp/fullplayerhp*100
            if(newplayehp>0)
                document.querySelector("#phpo").innerHTML=newplayehp
            else  
               document.querySelector("#phpo").innerHTML=0
            if(playepercent>0)document.querySelector("#playerhp").style.width=playepercent+"%"
            else document.querySelector("#playerhp").style.width="0.1%"
            document.querySelector("#enemyspeed").style.transition = "0s ease";
            document.querySelector("#enemyspeed").style.width="100%"
            if(newplayehp<=0)
                location.replace("../character")  
            
        }, monsterattackspeed*1000);
    }
    let playerattack=setInterval(() => {
        attack()
    }, (attackspeed*1000)+100);

    let enemyattack=setInterval(() => {      
        monsterattack()
    }, (monsterattackspeed*1000)+100);

    function win()
    {
        let data = new FormData()
        data.append("monster",monsterid)
        let xhr = new XMLHttpRequest()
        xhr.open("POST", "win.php")
        xhr.onload = function(){
            let message = this.response;
            console.log(message)
            location.reload();
        }
        xhr.send(data) 
    }



    let change=0
    function hide()
    {
        let w=window.innerWidth
        if(change==0 && w>900)
        {
            document.getElementById("menu").style.width="7.5%"
            document.getElementById("glowny").style.width="90%"

            let icons=document.querySelectorAll(".menu_icon");
            let text=document.querySelectorAll(".menu_text");

            for (let i = 0; i < icons.length; i++) {
                icons[i].style.width="100%"               
            }
            for (let i = 0; i < text.length; i++) {
                text[i].style.width="0%"
                text[i].style.opacity="0"               
            }
            change=1
        }
        else if(w>900)
        {
            document.getElementById("menu").style.width="17.5%"
            document.getElementById("glowny").style.width="80%"

            let icons=document.querySelectorAll(".menu_icon");
            let text=document.querySelectorAll(".menu_text");

            for (let i = 0; i < icons.length; i++) {
                icons[i].style.width="20%"
                
            }
            for (let i = 0; i < text.length; i++) {
                text[i].style.width="80%"
                text[i].style.opacity="1"
            }
            change=0
        }
    }
    function city()
    {
        location.replace("../city")
    }

    function settings()
    {
        location.replace("../settings")
    }

    function exploration()
    {
        location.replace("../exploration")
    }

    function equipment()
    {
        location.replace("../equipment")
    }

    function backpack()
    {
        location.replace("../backpack")
    }

    function character()
    {
        location.replace("../character")
    }

    function logout()
    {
        location.replace("../logout.php")
    }




    let crit_option=1
    setTimeout(() => {
        document.querySelector("#crit").style="filter: grayscale(0);"
    }, (attackspeed*1000*4)-500); 
    setTimeout(() => {
        crit_option=0
    }, (attackspeed*1000*4));

    function crit()
    {
        if(crit_option==0)
        {
            document.querySelector("#crit").style="filter: grayscale(100%);"
            setTimeout(() => {
                document.querySelector("#crit").style="filter: grayscale(0);"
            }, (attackspeed*1000*4)-500); 

            crit_option=1
            let enemyhp=document.querySelector("#ehpo").innerHTML
            newenemyhp=enemyhp-(playerdmg*4);
            enemypercent=newenemyhp/fullenemyhp*100
            if(newenemyhp>0)document.querySelector("#ehpo").innerHTML=newenemyhp;
            else document.querySelector("#ehpo").innerHTML=0;
            if(enemypercent>0)document.querySelector("#enemyhp").style.width=enemypercent+"%"
            else document.querySelector("#enemyhp").style.width="0%"
            setTimeout(() => {
                crit_option=0
            }, (attackspeed*1000*4));
        }
    }

    function potion(x,a,d,h,i)
    {
        x.src="../icons/potion.png"
        x.onclick=null
        let playerhp=document.querySelector("#phpo").innerHTML
        playerhp*=1
        playerhp+=h
        if(fullplayerhp<playerhp)
            playerhp=fullplayerhp
        playepercent=newplayehp/fullplayerhp*100
        document.querySelector("#phpo").innerHTML=playerhp
        document.querySelector("#playerhp").style.width=playepercent+"%"
        playerdmg+=a;
        monsterdmg-=d;

        let data = new FormData()
        data.append("id",i)
        let xhr = new XMLHttpRequest()
        xhr.open("POST", "potion.php")
        xhr.onload = function(){
            let message = this.response;
            console.log(message)
        }
        xhr.send(data) 
    }


    function food(x,a,d,h,i)
    {
        x.src="../icons/food.png"
        x.onclick=null
        let playerhp=document.querySelector("#phpo").innerHTML
        playerhp*=1
        playerhp+=h
        if(fullplayerhp<playerhp)
            playerhp=fullplayerhp
        playepercent=newplayehp/fullplayerhp*100
        document.querySelector("#phpo").innerHTML=playerhp
        document.querySelector("#playerhp").style.width=playepercent+"%"
        playerdmg+=a;
        monsterdmg-=d;

        let data = new FormData()
        data.append("id",i)
        let xhr = new XMLHttpRequest()
        xhr.open("POST", "food.php")
        xhr.onload = function(){
            let message = this.response;
            console.log(message)
        }
        xhr.send(data) 
    }
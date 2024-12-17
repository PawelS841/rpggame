let change=0
    function hide()
    {
        let w=window.innerWidth
        console.log(w);
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
    function settings()
    {
        location.replace("../settings")
    }
    
    function city()
    {
        location.replace("../city")
    }
 
    function exploration()
    {
        location.replace("../exploration")
    }

    
    function equipment()
    {
        location.replace("../equipment")
    }

    function character()
    {
        location.replace("../character")
    }

    function backpack()
    {
        location.replace("../backpack")
    }

    function logout()
    {
        location.replace("../logout.php")
    }


    let str_ponts=document.querySelector("#STR").innerHTML;
    let dex_ponts=document.querySelector("#DEX").innerHTML;
    let int_ponts=document.querySelector("#INT").innerHTML;
    let vit_ponts=document.querySelector("#VIT").innerHTML;
    let end_ponts=document.querySelector("#END").innerHTML;
    let luck_ponts=document.querySelector("#LUCK").innerHTML;

    let min_str_ponts=document.querySelector("#STR").innerHTML;
    let min_dex_ponts=document.querySelector("#DEX").innerHTML;
    let min_int_ponts=document.querySelector("#INT").innerHTML;
    let min_vit_ponts=document.querySelector("#VIT").innerHTML;
    let min_end_ponts=document.querySelector("#END").innerHTML;
    let min_luck_ponts=document.querySelector("#LUCK").innerHTML;

    let punkty=document.querySelector("#points").innerHTML;
    let max_punkty=document.querySelector("#points").innerHTML;
    function decreas_point(x){
        let points = document.querySelector("#"+x).innerHTML
            points=points*1
                switch (x) {
                    case 'STR':
                        if(punkty<=max_punkty && str_ponts>min_str_ponts)
                        {
                            punkty++;
                            document.querySelector("#points").innerHTML=punkty
                            str_ponts--
                            document.querySelector("#"+x).innerHTML=str_ponts
                        }
                        break;
                    case 'DEX':
                        if(punkty<=max_punkty && dex_ponts>min_dex_ponts)
                        {
                            punkty++;
                            document.querySelector("#points").innerHTML=punkty
                            dex_ponts--
                            document.querySelector("#"+x).innerHTML=dex_ponts
                        }
                        break;
                    case 'INT':
                        if(punkty<=max_punkty && int_ponts>min_int_ponts)
                        {
                            punkty++;
                            document.querySelector("#points").innerHTML=punkty
                            int_ponts--
                            document.querySelector("#"+x).innerHTML=int_ponts
                        }
                        break;
                    case 'VIT':
                        if(punkty<=max_punkty && vit_ponts>min_vit_ponts)
                        {
                            punkty++;
                            document.querySelector("#points").innerHTML=punkty
                            vit_ponts--
                            document.querySelector("#"+x).innerHTML=vit_ponts
                        }
                        break;
                    case 'END':
                        if(punkty<=max_punkty && end_ponts>min_end_ponts)
                        {
                            punkty++;
                            document.querySelector("#points").innerHTML=punkty
                            end_ponts--
                            document.querySelector("#"+x).innerHTML=end_ponts
                        }
                        break;
                    case 'LUCK':
                        if(punkty<=max_punkty && luck_ponts>min_luck_ponts)
                        {
                            punkty++;
                            document.querySelector("#points").innerHTML=punkty
                            luck_ponts--
                            document.querySelector("#"+x).innerHTML=luck_ponts
                        }
                        break;
                    default:
                        break;
                
            }
    }


    function increas_point(x){
        let points = document.querySelector("#"+x).innerHTML
            points=points*1
            switch (x) {
                    case 'STR':
                        if((punkty-1)>=0)
                        {
                            punkty--;
                            document.querySelector("#points").innerHTML=punkty
                            str_ponts++
                            document.querySelector("#"+x).innerHTML=str_ponts
                        }
                        break;
                    case 'DEX':
                        if((punkty-1)>=0)
                        {
                            punkty--
                            document.querySelector("#points").innerHTML=punkty
                            dex_ponts++
                            document.querySelector("#"+x).innerHTML=dex_ponts
                        }
                        break;
                    case 'INT':
                        if((punkty-1)>=0)
                        {
                            punkty--
                            document.querySelector("#points").innerHTML=punkty
                            int_ponts++
                            document.querySelector("#"+x).innerHTML=int_ponts
                        }
                        break;
                    case 'VIT':
                        if((punkty-1)>=0)
                        {
                            punkty--
                            document.querySelector("#points").innerHTML=punkty
                            vit_ponts++
                            document.querySelector("#"+x).innerHTML=vit_ponts
                        }
                        break;
                    case 'END':
                        if((punkty-1)>=0)
                        {
                            punkty--
                            document.querySelector("#points").innerHTML=punkty
                            end_ponts++
                            document.querySelector("#"+x).innerHTML=end_ponts
                        }
                        break;
                    case 'LUCK':
                        if((punkty-1)>=0)
                        {
                            punkty--
                            document.querySelector("#points").innerHTML=punkty
                            luck_ponts++
                            document.querySelector("#"+x).innerHTML=luck_ponts
                        }
                        break;
                    default:
                        break;
                
            }         
    }

    function stat_accept()
    {
        min_str_ponts=str_ponts;
        min_dex_ponts=dex_ponts;
        min_int_ponts=int_ponts;
        min_vit_ponts=vit_ponts;
        min_end_ponts=end_ponts;
        min_luck_ponts=luck_ponts;

        let data = new FormData()
        data.append("STR",str_ponts)
        data.append("DEX",dex_ponts)
        data.append("INT",int_ponts)
        data.append("VIT",vit_ponts)
        data.append("END",end_ponts)
        data.append("LUCK",luck_ponts)

        let xhr = new XMLHttpRequest()
        xhr.open("POST", "script.php")
        xhr.onload = function(){
            console.log(this.response)
        }
        xhr.send(data)
    }

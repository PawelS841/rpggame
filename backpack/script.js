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

    let desc_open=0
    function show_desc(x)
    {
        let w=window.innerWidth
        if(w>900)document.querySelector(".inventory").style.width="50%"
        else 
        {
                document.querySelector(".inventory").style.display="none"
        }


        let desc=document.querySelectorAll(".item_desc");
        for (let i=0; i < desc.length; i++)
        {
            desc[i].style.display="none"
        }
        document.querySelector(x).style.display="flex"

        if(desc_open==0)
        {
            if(w>900)
            {
                setTimeout(() => {
                document.querySelector(".description").style.display="flex"
                document.querySelector(".description").style.width="0%"
                }, 100);
                setTimeout(() => {
                    document.querySelector(".description").style.width="50%"
                    document.querySelector(".description").style.opacity="1"
                }, 130);
            }

            else 
                {
                    document.querySelector(".description").style.display="flex"
                    document.querySelector(".description").style.opacity="1"
                    document.querySelector(".description").style.width="100%"
                    document.querySelector(x+' img').scrollIntoView({block: 'start'})
                }

            desc_open=1
        }
        
            
    }

    function cancel()
    {
        let w=window.innerWidth
            document.querySelector(".description").style.width="0%"
            document.querySelector(".description").style.opacity="0"
            
            if(w>900)
            {
                setTimeout(() => {
                    document.querySelector(".description").style.display="none"
                    document.querySelector(".inventory").style.display="flex"
                }, 950);
            }
            else{
                    document.querySelector(".description").style.display="none"
                    document.querySelector(".inventory").style.display="flex"
            }
            document.querySelector(".inventory").style.width="100%"
            desc_open=0
    }

    function sell(id,price)
    {
        let quantity=document.querySelector("#Q"+id).innerHTML
        let sell_quantity=document.querySelector("#S"+id).value

        let data = new FormData()
        data.append("id",id)
        data.append("sell_quantity",sell_quantity)

        let xhr = new XMLHttpRequest()
        xhr.open("POST", "script.php")
        xhr.onload = function(){
            console.log(this.response)
        }
        xhr.send(data)        



        let money=document.querySelector("#money").innerHTML
        let multiplier=1
        while(money.slice(-1)=="k")
        {
            money=money.substring(0, money.length - 1)
            multiplier*=1000
        }
        money*=multiplier
        let old_slider=document.querySelector("#S"+id)
        let new_slider = document.createElement("input");
        quantity=quantity-sell_quantity;
        money=(money*1)+(sell_quantity*price)
        let suffix=""
        if(money>100000)
            while(money>=1000)
                {
                    money=money/1000
                    console.log(money)
                    suffix+="k"
                    if(suffix.includes("kkk"))
                        {
                            suffix = suffix.slice(0, -3);
                            suffix="G"+suffix
                        }
                        if(suffix.includes("GGG"))
                        {
                            suffix = suffix.slice(0, -3);
                            suffix="P"+suffix
                        }
                }
            
        money*=10
        money=Math.round(money)
        money/=10
        money=money+suffix
        new_slider.className = "slider";
        new_slider.type = "range";
        new_slider.id = "S"+id;
        new_slider.min = "0";
        new_slider.max = quantity;
        new_slider.value = "0";
        new_slider.setAttribute("oninput", "slider("+id+")");
        old_slider.replaceWith(new_slider);
        document.querySelector("#Q"+id).innerHTML=quantity
        document.querySelector("#money").innerHTML=money
        let view_quantity=quantity
        suffix=""
        while(view_quantity>=1000)
        {
            view_quantity=view_quantity/1000
            console.log(view_quantity)
            suffix+="k"
            if(suffix.includes("kkk"))
                {
                    suffix = suffix.slice(0, -3);
                    suffix="G"+suffix
                }
                if(suffix.includes("GGG"))
                {
                    suffix = suffix.slice(0, -3);
                    suffix="P"+suffix
                }
        }
        view_quantity*=10
        view_quantity=Math.round(view_quantity)
        view_quantity/=10
        view_quantity=view_quantity+suffix
        document.querySelector("#IQ"+id).innerHTML=view_quantity
        if(quantity==0)
        {
            cancel()
            document.querySelector("#id"+id).remove()
            document.querySelector("#slot"+id).remove()
            document.querySelector(".inventory").innerHTML+="<section class='inventory_slot'></section>"
            
        }
    }
    function settings()
    {
        location.replace("../settings")
    }
    
    function slider(x)
    {
        console.log(x)
        document.querySelector("#HM"+x).innerHTML=document.querySelector("#S"+x).value
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
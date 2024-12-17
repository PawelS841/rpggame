function buy(x)
{
    let price=1
    switch (x) {
        case 1:
            price=backpack_u;
            break;
        case 2:
            price=mining;
            break;
        case 3:
            price=theft;
            break;
        case 4:
            price=fish;
            break;
        default:
            break;
    }
    
    if((money-price)>=0)
    {
        switch (x) {
        case 1:
            backpack_u=Math.floor(price*1.5)
            break;
        case 2:
            mining=Math.floor(price*1.5)
            break;
        case 3:
            theft=Math.floor(price*1.5)
            break;
        case 4:
            fish=Math.floor(price*1.5)
            break;
        default:
            break;
        }
        money-=price
        price=Math.floor(price*1.5)
        document.querySelector("#cena"+x).innerHTML="cena: "+scale(price,100000)
        document.querySelector("#money").innerHTML=scale(money,100000)

        let data = new FormData()
        data.append("uppgrade",x)

        let xhr = new XMLHttpRequest()
        xhr.open("POST", "shop_script.php")
        xhr.onload = function(){
            console.log(this.response)
        }
        xhr.send(data)      
    }
}
function scale(x, y)
{
    let suffix=""
    if(x>100000)
        while(x>=1000)
            {
                x=x/1000
                console.log(x)
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
    x*=10
    x=Math.round(x)
    x/=10
    x=x+suffix
    return x;
}





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

function equipment()
{
    location.replace("../equipment")
}

function city()
{
    location.replace("../city")
}

function exploration()
{
    location.replace("../exploration")
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


function market()
{
    location.replace("market.php")
}
function merchant()
{
    location.replace("index.php")
}
function fishing()
{
    location.replace("fish.php")
}
function sneak()
{
    location.replace("theft.php")
}
function mine()
{
    location.replace("mining.php")
}
function blacksmith()
{
    location.replace("blacksmith.php")
}
function magic()
{
    location.replace("magic.php")
}
function alchemy()
{
    location.replace("alchemy.php")
}
function cook()
{
    location.replace("cook.php")
}
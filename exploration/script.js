let isclicked=0
let ischanging=0
function width(x,y)
{   
    let enemy=x.parentElement.querySelectorAll(".enemy")
    let new_x = document.createElement("section");
    new_x.className = "name";
    new_x.innerHTML= x.innerHTML;
    if(ischanging==0)
    {
        ischanging=1
        if(y==0)
        {
                new_x.setAttribute("onclick", "width(this, 1)");
                x.parentElement.style.height="auto"
                for (let i = 0; i < enemy.length; i++) {
                    enemy[i].style.display="flex"
                    setTimeout(() => {
                        enemy[i].style.height="18svh" 
                    }, 100);
                    setTimeout(() => {
                        enemy[i].style.opacity="1"
                    }, 200);
                    setTimeout(() => {
                        ischanging=0
                        x.replaceWith(new_x)
                    }, 1000);
                    
                }
                isclicked=1
            }
            else
            {
                new_x.setAttribute("onclick", "width(this, 0)");
                setTimeout(() => {
                    x.parentElement.style.height="20svh"
                }, 1000);
                for (let i = 0; i < enemy.length; i++) {
                    enemy[i].style.opacity="0"
                    setTimeout(() => {
                        enemy[i].style.height="0" 
                        
                    }, 100);
                    setTimeout(() => {
                        enemy[i].style.display="none"
                    }, 1000);
                    setTimeout(() => {
                        ischanging=0
                        x.replaceWith(new_x)
                    }, 1000);
                }
                isclicked=0
            }
   }
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


function battle(x)
{
    let data = new FormData()
    data.append("monster",x)
    let xhr = new XMLHttpRequest()
    xhr.open("POST", "data_operation.php")
    xhr.onload = function(){
        let message = this.response;
        if(message="sended")
            location.replace("battle.php")
    }
    xhr.send(data)   
}


function dig(x)
{
    let data = new FormData()
    data.append("resource",x)
    let xhr = new XMLHttpRequest()
    xhr.open("POST", "data_operation.php")
    xhr.onload = function(){
        let message = this.response;
        if(message="sended")
            location.replace("dig.php")     
    }
    xhr.send(data) 
}
function return_mine()
{
    location.replace("mining.php")
}
function diging(){
    document.querySelector("#speed").style.transition = speed + "s ease";
    document.querySelector("#speed").style.width="0%"
    setTimeout(() => {
        document.querySelector("#speed").style.transition ="0.1s ease";
        document.querySelector("#speed").style.width="100%"
        diged()
    }, speed*1000);
}
function diged()
{
    let data = new FormData()
    data.append("id",id)
    let xhr = new XMLHttpRequest()
    xhr.open("POST", "mined.php")
    xhr.onload = function(){
        let message = this.response;
        console.log(message)
        if(message!="")
            speed=message;
    }
    xhr.send(data) 
}

function  start_fishing(x)
{
let data = new FormData()
data.append("resource",x)
let xhr = new XMLHttpRequest()
xhr.open("POST", "data_operation.php")
xhr.onload = function(){
    let message = this.response;
    if(message="sended")
        location.replace("fishing.php")     
}
xhr.send(data) 
}
function return_fish()
{
    location.replace("fish.php")
}
function throw_rod()
{
    document.querySelector("#speed").style.transition = speed + "s ease";
    document.querySelector("#speed").style.width="0%"
    setTimeout(() => {
        document.querySelector("#speed").style.transition ="0.1s ease";
        document.querySelector("#speed").style.width="100%"
        catched()
    }, speed*1000);
}
function catched()
{
    let data = new FormData()
    data.append("id",id)
    let xhr = new XMLHttpRequest()
    xhr.open("POST", "fished.php")
    xhr.onload = function(){
        let message = this.response;
        console.log(message)
        if(message!="")
            speed=message;
    }
    xhr.send(data) 
}

function start_theft(x)
{
    let data = new FormData()
    data.append("resource",x)
    let xhr = new XMLHttpRequest()
    xhr.open("POST", "data_operation.php")
    xhr.onload = function(){
        let message = this.response;
        if(message="sended")
            location.replace("robbery.php")     
    }
    xhr.send(data) 
}
function return_theft()
{
    location.replace("theft.php")
}

function open_chest()
{
    document.querySelector("#speed").style.transition = speed + "s ease";
    document.querySelector("#speed").style.width="0%"
    setTimeout(() => {
        document.querySelector("#speed").style.transition ="0.1s ease";
        document.querySelector("#speed").style.width="100%"
        escepe()
    }, speed*1000);
}
function escepe()
{
    let data = new FormData()
    data.append("id",id)
    let xhr = new XMLHttpRequest()
    xhr.open("POST", "escepe.php")
    xhr.onload = function(){
        let message = this.response;
        console.log(message)
        if(message!="")
            speed=message;
    }
    xhr.send(data) 
}
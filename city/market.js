function market_buy()
{
    location.replace("market.php")
}
function market_sell()
{
    location.replace("market_sell.php")
}
function market_offer()
{
    location.replace("market_offer.php")
}
function show_offer(x)
{
   document.querySelector(x).style.display="flex"
   document.querySelector("#offers").style.display="none"
}
function cancel()
{
    let hide=document.querySelectorAll(".place_offer")
    for (let i = 0; i < hide.length; i++)
        hide[i].style.display="none";
    document.querySelector("#offers").style.display="flex"
}
function back()
{
    location.replace("market.php")
}
let element
function destroy(x,y)
{
    element=y;
    let data = new FormData()
    data.append("offert",x)

    let xhr = new XMLHttpRequest()
    xhr.open("POST", "offer_destroy.php")
    xhr.onload = function(){
        let message=this.response;
        if(message=="destroy")
        {
            element.parentElement.remove()
        }
    }
    xhr.send(data) 
}
function buy(x,y)
{
    element=y
    let data = new FormData()
    data.append("offert",x)

    let xhr = new XMLHttpRequest()
        xhr.open("POST", "offer_buy.php")
        xhr.onload = function(){
            let message=this.response;
            if(message!="")
            {
                let text = message.split(" ");
                console.log(text[0])
                console.log(text[1])
                if(text[0]=="destroy")
                {
                    element.parentElement.remove()
                    document.querySelector("#money").innerHTML=scale(text[1])
                }
            }
        }
        xhr.send(data) 
}

function scale(x)
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
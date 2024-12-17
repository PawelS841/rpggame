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
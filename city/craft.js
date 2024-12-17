function craft(RID,id1,q1,id2,q2,id3,q3)
{
    let war1=true
    let war2=true
    let war3=true
    let quantity1
    let quantity2
    let quantity3
    if(id1!=0)
    {
        quantity1=document.querySelector(".material"+id1).innerHTML
        if(q1>quantity1)
            war1=false
    }
    if(id2!=0)
    {
        quantity2=document.querySelector(".material"+id2).innerHTML
        if(q2>quantity2)
            war2=false
    }
    if(id3!=0)
    {
        quantity3=document.querySelector(".material"+id3).innerHTML
        if(q3>quantity3)
            war3=false
    }
    if(war1&&war2&&war3)
    {
        console.log("test")
        let data = new FormData()
        data.append("recipe",RID)

        let xhr = new XMLHttpRequest()
        xhr.open("POST", "craft.php")
        xhr.onload = function(){
            let message=this.response
            console.log(message)
            if(message.includes("reload"))
            {
                location.reload()
            }
            else if(message.includes("created"))
            {
                let update1=document.querySelectorAll(".material"+id1)
                let update2=document.querySelectorAll(".material"+id2)
                let update3=document.querySelectorAll(".material"+id3)
                quantity1-=q1
                quantity2-=q2
                quantity3-=q3
        
                for (let i = 0; i < update1.length; i++) 
                    update1[i].innerHTML=quantity1
                for (let i = 0; i < update2.length; i++) 
                    update2[i].innerHTML=quantity2
                for (let i = 0; i < update3.length; i++) 
                    update3[i].innerHTML=quantity3
            }
        }
        xhr.send(data)      
       
    }
}

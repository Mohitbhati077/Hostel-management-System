const txt = document.getElementsByClassName("text");

setTimeout(()=>{
    txt[0].style.visibility = "visible";
}, 1000);

setTimeout(()=>{
    const mainDiv = document.getElementById("mainDiv");
    const containerDiv = document.getElementById("containerDiv");
    console.log("debug", mainDiv);
    mainDiv.scrollIntoView({behavior: "smooth"});
    setTimeout(()=>{
        containerDiv.style.display="none";
    }, 1000)
}, 4000)

function openNav(){
    const navBar = document.querySelector(".navBar");
    navBar.style.transform="translateX(0)";
}
function closeNav(){
    const navBar = document.querySelector(".navBar");
    navBar.style.transform="translateX(100%)";
}
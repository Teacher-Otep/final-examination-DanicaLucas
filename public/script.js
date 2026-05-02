// SHOW SECTION
function showSection(sectionID){
    document.querySelectorAll('.content, .homecontent').forEach(sec=>{
        sec.style.display='none';
    });
    document.getElementById(sectionID).style.display='block';
}

// LOGO CLICK → HIDE ALL
document.addEventListener("DOMContentLoaded", () => {
    document.getElementById("logo").addEventListener("click", () => {
        document.querySelectorAll('.content, .homecontent').forEach(sec=>{
            sec.style.display='none';
        });
    });
});

// CLEAR FIELDS
function clearFields(){
    document.querySelectorAll("input").forEach(input=>{
        input.value="";
    });
}

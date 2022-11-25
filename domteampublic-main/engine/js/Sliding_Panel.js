let is_Sliding_Panel_Open = false;
function Sliding_Panel(){
    if (is_Sliding_Panel_Open) {
        document.getElementById("Sliding_Panel").style.width = 0;
        is_Sliding_Panel_Open = false;
    }
    else {
        document.getElementById("Sliding_Panel").style.width = "15%";
        is_Sliding_Panel_Open = true;
    }
}
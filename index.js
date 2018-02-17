/**
 * Created by Nick's PC on 6/11/2017.
 */
function showWeather(button) {


        function helper() {
            if (document.getElementById('wholeDataUL').style.visibility == "hidden") {
                return "visible";
            } else {
                return "hidden";
            }
        }
        document.getElementById('wholeDataUL').style.visibility = helper();
        button.value == "Yes!" ? button.value = "Nope." : button.value = "Yes!";




}
const gramsElement = document.getElementById("edited-grams");

function ajax(url, functionName) {
    var xmlhttprequest = new XMLHttpRequest();

    xmlhttprequest.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            functionName(this);
        }
    }

    xmlhttprequest.open("GET", url, true);
    xmlhttprequest.send();
}








function closeManagment() {
    closeAddingDiv();
    closeEditingDiv();
}








function openAddingDiv() {
    document.getElementById("adding-div").style.display = "block";
    document.getElementById("editing-div").style.display = "none";

    document.getElementById("food-search").focus();
}








function closeAddingDiv() {
    removePreviousSuggestions();

    document.getElementById("food-search").value = "";
    document.getElementById("adding-div").style.display = "none";
}








function openEditingDiv() {
    document.getElementById("editing-div-loading").style.display = "block";
    document.getElementById("editing-div").style.display = "block";
    document.getElementById("edit-table").style.display = "none";
    document.getElementById("adding-div").style.display = "none";
    
    document.getElementById("edited-grams").focus();
}








function closeEditingDiv() {
    document.getElementById("editing-div").style.display = "none";
    document.getElementById("editing-div-loading").style.display = "block";
    document.getElementById("edited-key").innerHTML = "";
    document.getElementById("edited-id").innerHTML = "";
    document.getElementById("edited-name").innerHTML = "";
    document.getElementById("edited-grams").value = 0;
    document.getElementById("edited-calories").innerHTML = 0;
    document.getElementById("edited-total-fat").innerHTML = 0;
    document.getElementById("edited-sat-fat").innerHTML = 0;
    document.getElementById("edited-net-carbs").value = 0;
    document.getElementById("edited-fiber").innerHTML = 0;
    document.getElementById("edited-protein").innerHTML = 0;
}








function fetchSuggestions() {
    ajax('ajax/select_names.php', prepareSuggestions);
}








function prepareSuggestions(xhr) {
    var foodSearchElement = document.getElementById("food-search");
    let string = xhr.responseText;

    arrays = string.split("/");

    foodSearchElement.addEventListener("input", () => {
        addSuggestions(arrays);
    });

    document.getElementById("food-search-loading").style.display = "none";
    
    foodSearchElement.style.display = "block";
}








function removePreviousSuggestions() {
    var previousSuggestions = document.getElementById("suggestions-div");

    previousSuggestions.innerHTML = "";
}








function addSuggestions(arrays) 
{
    removePreviousSuggestions();

    let input = document.getElementById("food-search").value.replace(/[^a-zA-Z āčēģīķļņšūžĀČĒĢĪĶĻŅŠŪŽ]/g, "").toLowerCase();

    if (input != "" && input != " ") {
        for (let i = 1; i < arrays.length; i++) { // "i = 1" because first element in "arrays" is empty.
            let item = arrays[i];

            if (item.toLowerCase().search(input) != -1) {
                let data = item.split("-");
                let id = parseInt(data[0]);
                let name = String(data[1]);

                var newSuggestion = document.createElement("input");

                newSuggestion.setAttribute("type", "button");
                newSuggestion.setAttribute("class", "suggestion");

                newSuggestion.setAttribute("value", name);

                newSuggestion.addEventListener("click", () => {
                    closeAddingDiv();
                    collectData(0, id, name, "", 0, 0, 0, "", 0, 0);
                })

                document.getElementById("suggestions-div").appendChild(newSuggestion);
            }
        }
    }
}








function collectData(keyParameter, idParameter, nameParameter, gramsParameter, caloriesParameter, totalFatParameter, satFatParameter, netCarbsParameter, fiberParameter, proteinParameter) {
    openEditingDiv();

    ajax("ajax/select_food.php?id="+idParameter, (xhr) => {
        var nutrition = xhr.responseText.split("-");

        let initialCalories = nutrition[3];
        let initialTotalFat = nutrition[4];
        let initialSatFat = nutrition[5];
        let initialTotalCarbs = nutrition[6];
        let initialFiber = nutrition[7];
        let initialProtein = nutrition[8];

        var keyElement = document.getElementById("edited-key");
        var idElement = document.getElementById("edited-id");
        var nameElement = document.getElementById("edited-name");
        var gramsElement = document.getElementById("edited-grams");
        var caloriesElement = document.getElementById("edited-calories");
        var totalFatElement = document.getElementById("edited-total-fat");
        var satFatElement = document.getElementById("edited-sat-fat");
        var netCarbsElement = document.getElementById("edited-net-carbs");
        var fiberElement = document.getElementById("edited-fiber");
        var proteinElement = document.getElementById("edited-protein");

        keyElement.innerHTML = keyParameter;
        idElement.innerHTML = idParameter;
        nameElement.innerHTML = nameParameter;
        gramsElement.value = gramsParameter;
        caloriesElement.innerHTML = caloriesParameter;
        totalFatElement.innerHTML = totalFatParameter;
        satFatElement.innerHTML = satFatParameter;
        netCarbsElement.value = netCarbsParameter;
        fiberElement.innerHTML = fiberParameter;
        proteinElement.innerHTML = proteinParameter;

        function test() {
            let gramsValue = parseInt(gramsElement.value);

            if(!isNaN(gramsValue)) {
                let caloriesValue = initialCalories / 100 * gramsValue;
                let totalFatValue = initialTotalFat / 100 * gramsValue;
                let satFatValue = initialSatFat / 100 * gramsValue;
                let netCarbsValue = (initialTotalCarbs - initialFiber) / 100 * gramsValue;
                let fiberValue = initialFiber / 100 * gramsValue;
                let proteinValue = initialProtein / 100 * gramsValue;

                caloriesElement.innerHTML = caloriesValue.toFixed();
                totalFatElement.innerHTML = totalFatValue.toFixed(1);
                satFatElement.innerHTML = satFatValue.toFixed(1);
                netCarbsElement.value = netCarbsValue.toFixed(1);
                fiberElement.innerHTML = fiberValue.toFixed(1);
                proteinElement.innerHTML = proteinValue.toFixed(1);
            }
        }

        gramsElement.removeEventListener("input", test);

        gramsElement.addEventListener("input", test);
        
        netCarbsElement.addEventListener("input", () => {
            let netCarbsValue = parseFloat(netCarbsElement.value).toFixed(1);

            if(!isNaN(netCarbsValue)) {
                let gramsValue = 100 / (initialTotalCarbs - initialFiber) * netCarbsValue;
                let caloriesValue = initialCalories / (initialTotalCarbs - initialFiber) * netCarbsValue;
                let totalFatValue = initialTotalFat / (initialTotalCarbs - initialFiber) * netCarbsValue;
                let satFatValue = initialSatFat / (initialTotalCarbs - initialFiber) * netCarbsValue;
                let fiberValue = initialFiber / (initialTotalCarbs - initialFiber) * netCarbsValue;
                let proteinValue = initialProtein / (initialTotalCarbs - initialFiber) * netCarbsValue;

                gramsElement.value = gramsValue.toFixed();
                caloriesElement.innerHTML = caloriesValue.toFixed();
                totalFatElement.innerHTML = totalFatValue.toFixed(1);
                satFatElement.innerHTML = satFatValue.toFixed(1);
                fiberElement.innerHTML = fiberValue.toFixed(1);
                proteinElement.innerHTML = proteinValue.toFixed(1);
            }
        });

        document.getElementById("edit-table").style.display = "block";
        document.getElementById("editing-div-loading").style.display = "none";
    });
}








function saveFood() {
    var key = document.getElementById("edited-key").innerHTML;
    var id = document.getElementById("edited-id").innerHTML;
    var grams = parseInt(document.getElementById("edited-grams").value);
    var calories = document.getElementById("edited-calories").innerHTML;
    var totalFat = document.getElementById("edited-total-fat").innerHTML;
    var satFat = document.getElementById("edited-sat-fat").innerHTML;
    var netCarbs = parseFloat(document.getElementById("edited-net-carbs").value);
    var fiber = document.getElementById("edited-fiber").innerHTML;
    var protein = document.getElementById("edited-protein").innerHTML;

    if(!isNaN(grams) && !isNaN(netCarbs) && grams >= 0 && netCarbs >= 0) {
        document.getElementById("edit-table").style.display = "none";
        document.getElementById("editing-div-saving").style.display = "block";

        ajax("ajax/save.php?key="+ key + "&id=" + id + "&grams=" + grams + "&calories=" + calories + "&totalFat=" + totalFat + "&satFat=" + satFat + "&netCarbs=" + netCarbs + "&fiber=" + fiber + "&protein=" + protein, (xhr) => { window.location.reload() });
    } else {
        return;
    }
}








function deleteFood() {
    let key = document.getElementById("edited-key").innerHTML;

    document.getElementById("editing-div-deleting").style.display = "block";
    document.getElementById("edit-table").style.display = "none";

    ajax("ajax/remove_key.php?key="+key, () => {
        window.location.reload();
    });
}
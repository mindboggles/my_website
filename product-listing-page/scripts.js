function changeInput(type) {
    document.getElementById("DVD").style.display = "none";
    document.getElementById("Book").style.display = "none";
    document.getElementById("Furniture").style.display = "none";

    document.getElementById(type).style.display = "block";
}

function checkForm() {
    var sku = document.getElementById("product_form").SKU.value;
    var name = document.getElementById("product_form").Name.value;
    var price = document.getElementById("product_form").Price.value;
    var type = document.getElementById("product_form").Type.value;

    var size = document.getElementById("product_form").Size.value;
    var weight = document.getElementById("product_form").Weight.value;
    var height = document.getElementById("product_form").Height.value;
    var width = document.getElementById("product_form").Width.value;
    var length = document.getElementById("product_form").Length.value;

    if (
        sku == "" || name == "" || price == "" || type == "" || 
        type == "DVD" && size == "" ||
        type == "Book" && weight == "" ||
        type == "Furniture" && height == ""||
        type == "Furniture" && width == ""||
        type == "Furniture" && length == ""
    ) {   
        alert("Please, submit required data");
        return false;
    } else if (
        /[^\s A-Za-z0-9.-]/.test(sku) || 
        /[^\s A-Za-z0-9.-]/.test(name)
    ) {
        alert("Please, provide the data of indicated type");
        return false;
    }
    else {
        return true;
    }
}
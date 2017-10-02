var model = ['M5','Corola','Gran Turismo','BMW X4','A4','Audi TT','S5'];
var color = ['Red','Black','Grey'];
var year = ['2011','2015','2016'];
var engine = ['1600','2500','3200'];
var maxSpeed = ['160','180','190','200'];
var price = ['1200','2900','5000','10000'];
var error = document.querySelector('.error');
var serch = {};
var filter = document.querySelector('#filter');

function getSelect(data,myDiv,param){
    myDiv.innerHTML = "";
    var def = document.createElement('option');
    def.innerHTML=param;
    def.setAttribute('disabled','true');
    def.setAttribute('selected','selected');
    myDiv.appendChild(def);
    for (var i = 0; i < data.length; i++) {
        var option = document.createElement("option");
        option.setAttribute("value", data[i]);
        option.text = data[i];
        myDiv.appendChild(option);
    }
}

var modelSel = document.querySelector("select[name=model]");
getSelect(model,modelSel,'Model');

var yearSel = document.querySelector("select[name=year]");
getSelect(year,yearSel,'Year');

var engineSel = document.querySelector("select[name=engine]");
getSelect(engine,engineSel,'Engine');

var colorSel = document.querySelector("select[name=color]");
getSelect(color,colorSel,'Color');

var maxSpeedSel = document.querySelector("select[name=maxSpeed]");
getSelect(maxSpeed,maxSpeedSel,'Max Speed');

var priceSel = document.querySelector("select[name=price]");
getSelect(price,priceSel,'Price');

var clearSel = document.querySelector("#clear");
clearSel.addEventListener('click',function(){

    getSelect(model,modelSel,'Model');
    getSelect(year,yearSel,'Year');
    getSelect(engine,engineSel,'Engine');
    getSelect(color,colorSel,'Color');
    getSelect(maxSpeed,maxSpeedSel,'Max Speed');
    getSelect(price,priceSel,'Price');
    error.innerHTML='';
    allCars();
});

function getXmlHttp(){
    var xmlhttp;
    try {
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
        try {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (E) {
            xmlhttp = false;
        }
    }
    if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
        xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
}

function allCars(){
    var xhr = getXmlHttp();
    xhr.open('POST', 'SoapClient.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    var body = "allCars=" + encodeURIComponent();
    xhr.send(body);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
            if(xhr.status == 200) {
                var obj = JSON.parse(xhr.responseText)
                drowCars(obj);
            }
        }

    }
}

filter.addEventListener("click", function(){
    var model = document.querySelector('#model');
    var year = document.querySelector('#year');
    var engine = document.querySelector('#engine');
    var color = document.querySelector('#color');
    var maxSpeed = document.querySelector('#maxSpeed');
    var price = document.querySelector('#price');

    if(model[model.selectedIndex].innerHTML != 'Model'){
        serch.model = model[model.selectedIndex].innerHTML;
    }
    if(year[year.selectedIndex].innerHTML != 'Year'){
        serch.year = year[year.selectedIndex].innerHTML;
    }else{
        return error.innerHTML = 'Make a choice year';
    }
    if(engine[engine.selectedIndex].innerHTML != 'Engine'){
        serch.engine = engine[engine.selectedIndex].innerHTML;
    }
    if(color[color.selectedIndex].innerHTML != 'Color'){
        serch.color = color[color.selectedIndex].innerHTML;
    }
    if(maxSpeed[maxSpeed.selectedIndex].innerHTML != 'Max Speed'){
        serch.maxSpeed  = maxSpeed[maxSpeed.selectedIndex].innerHTML;
    }
    if(price[price.selectedIndex].innerHTML != 'Price'){
        serch.price = price[price.selectedIndex].innerHTML;
    }

    var obj = JSON.stringify(serch);
    if(Object.keys(obj).length !== 0){
        var xmlhttp = getXmlHttp();
        xmlhttp.open('POST', 'SoapClient.php', false);
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        var getSerch = "getSerch=" + encodeURIComponent(obj);
        xmlhttp.send(getSerch);
        if (xmlhttp.readyState == 4) {
            if(xmlhttp.status == 200) {
                var serchCar = JSON.parse(xmlhttp.responseText);
                drowCars(serchCar);
            }
        }
    }

});

function drowCars(cars){
    var list = document.querySelector('.mainContent');
    list.innerHTML ='';
    cars.forEach( function(car,key) {
        var container = document.createElement("div");
        container.setAttribute('class','col-md-4');
        var brand = document.createElement('h4');
        var model = document.createElement('p');
        var a = document.createElement('a');
        a.setAttribute('href','http://soap.loc/client/car?id=' + car.id);
        brand.innerHTML =car.brand;
        model.innerHTML = car.model;
        container.appendChild(brand);
        container.appendChild(a);
        a.appendChild(model);
        list.appendChild(container);
    });
}
allCars();

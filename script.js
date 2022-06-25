let startURL = "/testapi.php?action=get_cows";
let FC = "&filter_color="
let FCV = 0
let FMAmin = "&filter_milk_avg_min="
let FMAminV = 0
let FMAmax = "&filter_milk_avg_max="
let FMAmaxV = 0
let OB = "&order_by="
let OBV = 0
let OD = "&order_dir="
let ODV = "DESC"
let cowsInApi = 0
let P = "&page="
let PV = 0

const xhr = new XMLHttpRequest();
xhr.responseType = 'json';
getCows()

//cows
function getCows (){
 //create URL
    let URL = startURL

    if (FCV>0) {URL+=FC+FCV} //chenge url if some color filter choisen
    if (FMAminV>0) {URL+=FMAmin+FMAminV} //chenge url if minAverageMilk filter choisen
    if (FMAmaxV>0) {URL+=FMAmax+FMAmaxV} //chenge url if maxAverageMilk filter choisen
    if (OBV!=""&&ODV=="DESC") {URL+=OB+OBV+OD+ODV} //chenge url if user want sort column by column name and do
    if (OBV!=""&&ODV=="ASC") {URL+=OB+OBV} //chenge url if user want sort column by column name
    if (PV>0) {URL+=P+PV}

    xhr.open('GET', URL, true);

    xhr.responseType = 'json';
    xhr.onload = () => {
        needPages = Math.ceil(xhr.response.total/xhr.response.on_page)
        pagination(needPages, PV)
        drawTable(xhr.response.data);
    }
    xhr.send()
}
// Pagination Start
function pagination(needPages, currentPage) {
    let pagDiv = document.getElementById('pag')
    pagDiv.innerHTML = ''
    for (let index = 0; index < needPages; index++) {
        if (currentPage === index) {
            pagDiv.innerHTML += `<ul><li data-page-num="${index+1}"><div id="pag-${index+1}" class="active">${index+1}</div></li></ul>`
        }
        else {
        pagDiv.innerHTML += `<ul><li data-page-num="${index+1}"><div id="pag-${index+1}" class="pag-pages">${index+1}</div></li></ul>`
        }
    }
    
    let dDiv = document.querySelectorAll(".pag-pages")
    dDiv.forEach(el => {
        el.addEventListener("click", function(e)
        {   
            PV = e.target.innerHTML-1
            getCows ()
        })
    });
}
// Pagination Ends

function drawTable(data){
    const tableDiv = document.querySelector(".my-farm")
    tableDiv.innerHTML = `<table class="cows"></table>`
    for (i=0;i<data.length;i++)
    {
        let cowObject = data[i]
        let row = document.createElement('tr')
        row.innerHTML = `
        <td>${cowObject.name}</td>        
        <td>${cowObject.bdate}</td>
        <td>${cowObject.color}</td>
        <td>${cowObject.age}</td>
        <td>${cowObject.milk_avg}</td>
        `
        document.querySelector(".cows").appendChild(row)
    }
}
//Sort by name column
const cowNameSort = document.getElementById('cow-name-sort');
cowNameSort.addEventListener('click', function (){
        if (ODV=="ASC"){ODV="DESC";}
        else if (ODV=="DESC"){ODV="ASC";}
        OBV = "name"
    getCows ()
})
//Sort by Bdate column
const cowBdateSort = document.getElementById('cow-date-sort');
cowBdateSort.addEventListener('click', function (){
        if (ODV=="ASC"){ODV="DESC";}
        else if (ODV=="DESC"){ODV="ASC";}
        OBV = "bdate"
    getCows ()
})
//Sort by name color
const cowColorSort = document.getElementById('cow-color-sort');
cowColorSort.addEventListener('click', function (){
        if (ODV=="ASC"){ODV="DESC";}
        else if (ODV=="DESC"){ODV="ASC";}
        OBV = "color"
    getCows ()
})
//Sort by name milk
const cowMilkSort = document.getElementById('cow-milk-sort');
cowMilkSort.addEventListener('click', function (){
        if (ODV=="ASC"){ODV="DESC";}
        else if (ODV=="DESC"){ODV="ASC";}
        OBV = "milk_avg"
    getCows ()
})
//Sort by name age
const cowAgesort = document.getElementById('cow-age-sort');
cowAgesort.addEventListener('click', function (){
        if (ODV=="ASC"){ODV="DESC";}
        else if (ODV=="DESC"){ODV="ASC";}
        OBV = "age"
    getCows ()
})


//colors
const colorsURL = "/testapi.php?action=get_colors";
const xhr_colors = new XMLHttpRequest();
xhr_colors.responseType = 'json';

xhr_colors.open('GET', colorsURL, true);
xhr_colors.onload = () => {
    drawFilter(xhr_colors.response);
}
xhr_colors.send()


let filterChoice = document.getElementById("filter")
filterChoice.addEventListener("change", () => {
    if (filterChoice.value == "all"){FCV=0}
    if (filterChoice.value == 1){FCV=1}
    if (filterChoice.value == 2){FCV=2}
    if (filterChoice.value == 3){FCV=3}
    if (filterChoice.value == 4){FCV=4}
    if (filterChoice.value == 5){FCV=5}
    PV = 0 
    getCows()
})

function drawFilter(data){
    let filterItem = ` <option value="all" selected>All</option>`
    filterChoice.innerHTML += filterItem
    for (let key in data) {
        let filterItem = `<option value="${key}">${data[key]}</option>`
        filterChoice.innerHTML += filterItem
    }
}
//COLORS Ends

//Filter min -- max MilkAvg
let minAvgMilkFilter = document.getElementById("filter_milk_avg_min")
let maxAvgMilkFilter = document.getElementById("filter_milk_avg_max")

minAvgMilkFilter.addEventListener("change", () => {
    FMAminV = minAvgMilkFilter.value
    getCows()
})
maxAvgMilkFilter.addEventListener("change", () => {
    FMAmaxV = maxAvgMilkFilter.value
    getCows()
})

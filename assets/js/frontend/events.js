var months = [],
    days   = [],
    counts = [];
var exampleDate;

function addDates(date) {
    if (date.getDay() === 0 || date.getDay() == 6) {
        return [true, ""];
    }
    console.log(days.length);
    for (x = 0; x < days.length; x++) {

        if (date.getMonth() == months[x] -1 && date.getDate() == days[x]) {
            console.log("We have An Event(s)! ("+ counts[x] +") "+ months[x] + "/" + days[x]);
            if(counts[x] >= 1 && counts[x] < 5){
                return [true, "lightRed"];
            }else if(counts[x] >= 5 && counts[x] < 10){
                return [true, "medRed"];
            }else if(counts[x] <= 10 && counts[x] >= 5){
                return [true, "darkRed"];
            }
        }
    }
    return [true, ""];
}
$.ajax({
    url: "/index/process/geteventdates.html",
    type: "POST",
    dataType: "JSON",
    success: function(data){
        for (var i = data.length - 1; i >= 0; i--) {
            months.push(data[i].month);
            days.push(data[i].day);
            counts.push(data[i].count);
            console.log('date is:'+data[i].month+'/'+data[i].day+'. ('+data[i].count+') ');
        }
        var pickerOpts = {
            beforeShowDay: addDates,
            minDate: +1,
            defaultDate: +0
        };
        $("#eventdate").datepicker(pickerOpts); // now I will be run only after the data is returned from the server
    }
});
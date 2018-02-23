
$(document).ready(function() {


    var _events = generateCalendarEvents();

    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();

    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,basicWeek,basicDay'
        },
        editable: false,
        events: _events,
    });

});


function stringToDate(str) {

    // String Format: 18/02/2017
    if (str) {
        var dateArr = str.split('/');
        var date = new Date(dateArr[2], dateArr[1] - 1, dateArr[0]);

        return date;
    }
    return new Date('2000', '0', '01');

}


function generateCalendarEvents() {
    var jsonString = $('#json-result').text();
    var jsonResult = JSON.parse(jsonString);

    var events = [];


    /*
    ***** Hard Code Quick fix: /svmatrix/ before every links ******
    * TODO: NEED TO CHANGE *
    * */


    $.each(jsonResult['quotes'], function (i, item) {
        events.push(
            {
                title: item.user.username + ' - ' + item.customer_name + ' - ORDER IN',
                start: stringToDate(item.orderin_date),
                className: 'order-orderin',
                url: '/svmatrix/quotes/cuttingschedule/' + item.id
            }
        );
        if (item.required_date) {
            var status = '';
            var className = '';
            if (item.status == 'in progress') {
                status = 'REQUIRED';
                className = 'order-required';
            } else if (item.status == 'complete' || item.status == 'paid') {
                status = 'COMPLETED'
                className = 'order-completed'
            }
            events.push(
                {
                    title: item.user.username + ' - ' + item.customer_name + ' - ' + status,
                    start: stringToDate(item.required_date),
                    className: className,
                    url: '/svmatrix/quotes/cuttingschedule/' + item.id
                }
            );
        }
    });

    return events;
}



function addLog(type, message) {
    var $log = $('<tr />');
    $log.append($('<th />').text(type));
    $log.append($('<td />').text(message ? JSON.stringify(message) : ''));
    $("#logs table").prepend($log);
}
$.ajax({

 headers: {
    "X-CSRF-TOKEN": window.CSRF_TOKEN,
},
type: "POST",
url: `/bookings/gantt`,
cache: false,

success: function (data) {
// console.log(data);
datos=JSON.parse(data);
let datosGantt= "";
datos.find((object,index) =>{
    
    if(Array.isArray(object)==false){
        // console.log(object)
        datosGantt+=formato(object, index)
       
        //   console.log(rows)
    }
    

})
// '0': {
//     title: 'Aula I1',
//     schedule: [
//         {
//             start: '09:00',
//             end: '12:00',
//             text: 'Elu puto',
//             data: {}
//         },
//         {
//             start: '11:00',
//             end: '14:00',
//             text: 'Text Area',
//             data: {}
//         }
//     ]
function formato(elem, index){
// console.log(elem, 'linea 32')
    let rta = `'0': { 
        title:'aula de prueba',
        schedule: [`
    Object.values(elem).forEach(val => {
        // console.log(val , 'linea 35')
         rta+=`{    
                    start: '${val.start_time}',
                    end: '${val.finish_time}',
                    text: '${val.description}',
                    data: {}
                },
                `    
          
    });
rta+=`
]},`
    return rta;

}
// datos.forEach(function (elem, index){
   
//     rows+=formato(elem, index);

// })
// console.log(rows);
$(function () {
    $("#logs").append('<table class="table">');
    var isDraggable = false;
    var isResizable = false;
    
    var $sc = $("#schedule").timeSchedule({
       
        startTime: "08:00:00", // schedule start time(HH:ii)
        endTime: "23:00:00",   // schedule end time(HH:ii)
        widthTime: 60 * 20,  // cell timestamp example 10 minutes
        timeLineY: 50,       // height(px)
        verticalScrollbar: 20,   // scrollbar (px)
        timeLineBorder: 2,   // border(top and bottom)
        bundleMoveWidth: 6,  // width to move all schedules to the right of the clicked time line cell
        draggable: isDraggable,
        resizable: isResizable,
        resizableLeft: true,
        rows: {datosGantt},
        onChange: function (node, data) {
            addLog('onChange', data);
        },
        onInitRow: function (node, data) {
            addLog('onInitRow', data);
        },
        onClick: function (node, data) {
            addLog('onClick', data);
        },
        onAppendRow: function (node, data) {
            addLog('onAppendRow', data);
        },
        onAppendSchedule: function (node, data) {
            addLog('onAppendSchedule', data);
            if (data.data.class) {
                node.addClass(data.data.class);
            }
            if (data.data.image) {
                var $img = $('<div class="photo"><img></div>');
                $img.find('img').attr('src', data.data.image);
                node.prepend($img);
                node.addClass('sc_bar_photo');
            }
        },
        // onScheduleClick: function (node, time, timeline) {
        //     var start = time;
        //     var end = $(this).timeSchedule('formatTime', $(this).timeSchedule('calcStringTime', time) + 3600);
        //     $(this).timeSchedule('addSchedule', timeline, {
        //         start: start,
        //         end: end,
        //         text: 'Insert Schedule',
        //         data: {
        //             class: 'sc_bar_insert'
        //         }
        //     });
        //     addLog('onScheduleClick', time + ' ' + timeline);
        // },
    });
    $('#event_timelineData').on('click', function () {
        addLog('timelineData', $sc.timeSchedule('timelineData'));
    });
    $('#event_scheduleData').on('click', function () {
        addLog('scheduleData', $sc.timeSchedule('scheduleData'));
    });
    $('#event_resetData').on('click', function () {
        $sc.timeSchedule('resetData');
        addLog('resetData');
    });
    $('#event_resetRowData').on('click', function () {
        $sc.timeSchedule('resetRowData');
        addLog('resetRowData');
    });
    $('#event_setDraggable').on('click', function () {
        isDraggable = !isDraggable;
        $sc.timeSchedule('setDraggable', isDraggable);
        addLog('setDraggable', isDraggable ? 'enable' : 'disable');
    });
    $('#event_setResizable').on('click', function () {
        isResizable = !isResizable;
        $sc.timeSchedule('setResizable', isResizable);
        addLog('setResizable', isResizable ? 'enable' : 'disable');
    });
    $('.ajax-data').on('click', function () {
        $.ajax({url: './data/' + $(this).attr('data-target')})
            .done((data) => {
                addLog('Ajax GetData', data);
                $sc.timeSchedule('setRows', data);
            });
    });
    $('#clear-logs').on('click', function () {
        $('#logs .table').empty();
    });
} 
)}
})
// });

// [
//     [
       
//     ],
//     {
//        "1":{
//           "id":28,
//           "user_id":3,
//           "classroom_id":5,
//           "description":"Quidem provident et est nesciunt occaecati.",
//           "status":"finished",
//           "assignment_id":null,
//           "week_day":"Lunes",
//           "event_id":1,
//           "booking_date":"2022-06-20",
//           "start_time":"17:30:00",
//           "finish_time":"20:30:00",
//           "created_at":"2022-06-20T17:59:40.000000Z",
//           "updated_at":"2022-06-20T17:59:40.000000Z"
//        },
//        "11":{
//           "id":132,
//           "user_id":12,
//           "classroom_id":5,
//           "description":"Velit rerum veritatis fugiat.",
//           "status":"finished",
//           "assignment_id":13,
//           "week_day":"Lunes",
//           "event_id":null,
//           "booking_date":"2022-06-20",
//           "start_time":"09:30:00",
//           "finish_time":"10:30:00",
//           "created_at":"2022-06-20T17:59:41.000000Z",
//           "updated_at":"2022-06-20T17:59:41.000000Z"
//        }
//     },
//     [
       
//     ]
//  ]

// $(function () {
//     $("#logs").append('<table class="table">');
//     var isDraggable = false;
//     var isResizable = false;
//     var $sc = $("#schedule").timeSchedule({
//         startTime: "08:00", // schedule start time(HH:ii)
//         endTime: "23:00",   // schedule end time(HH:ii)
//         widthTime: 60 * 20,  // cell timestamp example 10 minutes
//         timeLineY: 50,       // height(px)
//         verticalScrollbar: 20,   // scrollbar (px)
//         timeLineBorder: 2,   // border(top and bottom)
//         bundleMoveWidth: 6,  // width to move all schedules to the right of the clicked time line cell
//         draggable: isDraggable,
//         resizable: isResizable,
//         resizableLeft: true,
//         rows: {rows},
//         onChange: function (node, data) {
//             addLog('onChange', data);
//         },
//         onInitRow: function (node, data) {
//             addLog('onInitRow', data);
//         },
//         onClick: function (node, data) {
//             addLog('onClick', data);
//         },
//         onAppendRow: function (node, data) {
//             addLog('onAppendRow', data);
//         },
//         onAppendSchedule: function (node, data) {
//             addLog('onAppendSchedule', data);
//             if (data.data.class) {
//                 node.addClass(data.data.class);
//             }
//             if (data.data.image) {
//                 var $img = $('<div class="photo"><img></div>');
//                 $img.find('img').attr('src', data.data.image);
//                 node.prepend($img);
//                 node.addClass('sc_bar_photo');
//             }
//         },
//         // onScheduleClick: function (node, time, timeline) {
//         //     var start = time;
//         //     var end = $(this).timeSchedule('formatTime', $(this).timeSchedule('calcStringTime', time) + 3600);
//         //     $(this).timeSchedule('addSchedule', timeline, {
//         //         start: start,
//         //         end: end,
//         //         text: 'Insert Schedule',
//         //         data: {
//         //             class: 'sc_bar_insert'
//         //         }
//         //     });
//         //     addLog('onScheduleClick', time + ' ' + timeline);
//         // },
//     });
//     $('#event_timelineData').on('click', function () {
//         addLog('timelineData', $sc.timeSchedule('timelineData'));
//     });
//     $('#event_scheduleData').on('click', function () {
//         addLog('scheduleData', $sc.timeSchedule('scheduleData'));
//     });
//     $('#event_resetData').on('click', function () {
//         $sc.timeSchedule('resetData');
//         addLog('resetData');
//     });
//     $('#event_resetRowData').on('click', function () {
//         $sc.timeSchedule('resetRowData');
//         addLog('resetRowData');
//     });
//     $('#event_setDraggable').on('click', function () {
//         isDraggable = !isDraggable;
//         $sc.timeSchedule('setDraggable', isDraggable);
//         addLog('setDraggable', isDraggable ? 'enable' : 'disable');
//     });
//     $('#event_setResizable').on('click', function () {
//         isResizable = !isResizable;
//         $sc.timeSchedule('setResizable', isResizable);
//         addLog('setResizable', isResizable ? 'enable' : 'disable');
//     });
//     $('.ajax-data').on('click', function () {
//         $.ajax({url: './data/' + $(this).attr('data-target')})
//             .done((data) => {
//                 addLog('Ajax GetData', data);
//                 $sc.timeSchedule('setRows', data);
//             });
//     });
//     $('#clear-logs').on('click', function () {
//         $('#logs .table').empty();
//     });
// });
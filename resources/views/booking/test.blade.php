@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.min.css')}}"/>
@endsection
@section('content')
    <div class="container-fluid">
        <h2 id="demo">Demo</h2>
        <p>
            Example Sample Demo
        </p>
        <h3>Method</h3>
        <div style="padding: 0 0 12px;">
            <button id="event_timelineData" class="btn btn-info" style="margin-bottom: 12px;">timelineData()</button>
            <button id="event_scheduleData" class="btn btn-info" style="margin-bottom: 12px;">scheduleData()</button>
            <button id="event_setDraggable" class="btn btn-info" style="margin-bottom: 12px;">toggleDraggable</button>
            <button id="event_setResizable" class="btn btn-info" style="margin-bottom: 12px;">toggleResizable</button>
            <button id="event_resetData" class="btn btn-danger" style="margin-bottom: 12px;">resetData()</button>
            <button id="event_resetRowData" class="btn btn-danger" style="margin-bottom: 12px;">resetRowData()</button>
        </div>
        <div style="padding: 0 0 40px;">
            <div id="schedule"></div>
        </div>
    </div>
@endsection
@section('scripts')
    <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.min.js" type="text/javascript"
            language="javascript"></script>
    <script type="text/javascript" src="{{asset('js/jq.schedule.js')}}"></script>
    <script type="text/javascript">
        function addLog(type, message) {
            var $log = $('<tr />');
            $log.append($('<th />').text(type));
            $log.append($('<td />').text(message ? JSON.stringify(message) : ''));
            $("#logs table").prepend($log);
        }

        $(function () {
            $("#logs").append('<table class="table">');
            var isDraggable = false;
            var isResizable = false;
            var $sc = $("#schedule").timeSchedule({
                startTime: "07:00", // schedule start time(HH:ii)
                endTime: "21:00",   // schedule end time(HH:ii)
                widthTime: 60 * 20,  // cell timestamp example 10 minutes
                timeLineY: 50,       // height(px)
                verticalScrollbar: 20,   // scrollbar (px)
                timeLineBorder: 2,   // border(top and bottom)
                bundleMoveWidth: 6,  // width to move all schedules to the right of the clicked time line cell
                draggable: isDraggable,
                resizable: isResizable,
                resizableLeft: true,
                rows: {
                    '0': {
                        title: 'Aula I1',
                        schedule: [
                            {
                                start: '09:00',
                                end: '12:00',
                                text: 'Elu puto',
                                data: {}
                            },
                            {
                                start: '11:00',
                                end: '14:00',
                                text: 'Text Area',
                                data: {}
                            }
                        ]
                    },
                    '1': {
                        title: 'Aula I2',
                        schedule: [
                            {
                                start: '16:00',
                                end: '17:00',
                                text: 'Text Area',
                                data: {}
                            }
                        ]
                    },
                    '2': {
                        title: 'Aula I3',
                        schedule: [
                            {
                                start: '16:00',
                                end: '17:00',
                                text: 'Text Area',
                                data: {}
                            }
                        ]
                    },
                    '3': {
                        title: 'Aula I4',
                        schedule: [
                            {
                                start: '16:00',
                                end: '17:00',
                                text: 'Text Area',
                                data: {}
                            }
                        ]
                    },
                    '4': {
                        title: 'Aula I5',
                        schedule: [
                            {
                                start: '16:00',
                                end: '17:00',
                                text: 'Text Area',
                                data: {}
                            }
                        ]
                    },
                    '5': {
                        title: 'Aula I6',
                        schedule: [
                            {
                                start: '16:00',
                                end: '17:00',
                                text: 'Text Area',
                                data: {}
                            }
                        ]
                    }
                },
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
        });
    </script>
@endsection

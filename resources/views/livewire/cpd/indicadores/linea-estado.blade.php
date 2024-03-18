<div class="w-full container-fluid inline-block overflow-auto">
    <div class="Timeline w-100">

        <?php $i=1; ?>
        @foreach($tareasCPD as $tarea)

            @if($i % 2 == 0)
                <svg height="5" width="200">
                    <line x1="0" y1="0" x2="200" y2="0" style="stroke:#004165;stroke-width:5" />
                    Sorry, your browser does not support inline SVG.
                </svg>

                <div class="event1">

                    <div class="event1Bubble">
                        <div class="eventTime">
                            <div class="DayDigit">{{date('d',strtotime($tarea->created_at))}}</div>
                            <div class="Day">
                                {{$dias[date('D',strtotime($tarea->created_at))]}}
                                <div class="MonthYear">{{$meses[date('M',strtotime($tarea->created_at))]}} {{date('Y',strtotime($tarea->created_at))}}</div>
                            </div>
                        </div>
                        <div class="eventTitle">{{$tarea->Tipo->NombreTarea}}</div>
                    </div>
                    <div class="eventAuthor">{{@$tarea->Estado}}</div>
                    <svg height="20" width="20">
                        <circle cx="10" cy="11" r="5" fill="#004165" />
                    </svg>
                    <div class="time">{{date('H:i a',strtotime($tarea->created_at))}}</div>

                </div>
            @else
                <svg height="5" width="300">
                    <line x1="0" y1="0" x2="300" y2="0" style="stroke:#004165;stroke-width:5" />
                    Sorry, your browser does not support inline SVG.
                </svg>

                <div class="event2">

                    <div class="event2Bubble">
                        <div class="eventTime">
                            <div class="DayDigit">{{date('d',strtotime($tarea->created_at))}}</div>
                            <div class="Day">
                                {{$dias[date('D',strtotime($tarea->created_at))]}}
                                <div class="MonthYear">{{$meses[date('M',strtotime($tarea->created_at))]}} {{date('Y',strtotime($tarea->created_at))}}</div>
                            </div>
                        </div>
                        <div class="eventTitle">{{$tarea->Tipo->NombreTarea}}</div>
                    </div>
                    <div class="event2Author">{{@$tarea->Estado}}</div>
                    <svg height="20" width="20">
                        <circle cx="10" cy="11" r="5" fill="#004165" />
                    </svg>
                    <div class="time2">{{date('H:i a',strtotime($tarea->created_at))}}</div>
                </div>
            @endif
            <?php $i++; ?>
        @endforeach

        <svg height="5" width="150">
            <line x1="0" y1="0" x2="150" y2="0" style="stroke:#004165;stroke-width:5" />
            Sorry, your browser does not support inline SVG.
        </svg>

        <div class="now">
            Ahora
        </div>


        <svg height="5" width="150">
            <line x1="0" y1="0" x2="150" y2="0" style="stroke:rgba(162, 164, 163, 0.37);stroke-width:5" />
            Sorry, your browser does not support inline SVG.
        </svg>
        <div class="event3 futureGray ">
            <div class="event1Bubble futureOpacity">
                <div class="eventTime">
                    <div class="DayDigit">{{date('d', strtotime(date('Y-m-d'). '+1 day'))}}</div>
                    <div class="Day">
                        {{$dias[date('D', strtotime(date('Y-m-d'). '+1 day'))]}}
                        <div class="MonthYear">{{$meses[date('M',strtotime(date('Y-m-d'). '+1 day'))]}} {{date('Y',strtotime(date('Y-m-d'). '+1 day'))}}</div>
                    </div>
                </div>
                <div class="eventTitle">{{@$tarea->Tipo->ProximaTarea->NombreTarea}}</div>
            </div>
            <svg height="20" width="20">
                <circle cx="10" cy="11" r="5" fill="rgba(162, 164, 163, 0.37)" />
            </svg>
        </div>
        <svg height="5" width="50">
            <line x1="0" y1="0" x2="50" y2="0" style="stroke:#004165;stroke-width:5" />
        </svg>
        <svg height="20" width="42">
            <line x1="1" y1="0" x2="1" y2="20" style="stroke:#004165;stroke-width:2" />
            <circle cx="11" cy="10" r="3" fill="#004165" />
            <circle cx="21" cy="10" r="3" fill="#004165" />
            <circle cx="31" cy="10" r="3" fill="#004165" />
            <line x1="41" y1="0" x2="41" y2="20" style="stroke:#004165;stroke-width:2" />
        </svg>

    </div>


</div>

<style>

    .Timeline {
        display: flex;
        align-items: center;
        height: 200px;
        width: {{100 + (count($tareasCPD)*150)}}px;
        min-width: 99%;
        overflow: scroll;
        padding-left: 50px;
        padding-right: 50px;
    }

    .event1,
    .event2, .event3 {
        position: relative;
    }

    .event1Bubble {
        position: absolute;
        background-color: rgba(158, 158, 158, 0.1);
        width: 139px;
        height: 60px;
        top: -70px;
        left: -15px;
        border-radius: 5px;
        box-shadow: inset 0 0 5px rgba(158, 158, 158, 0.64)
    }

    .event2Bubble {
        position: absolute;
        background-color: rgba(158, 158, 158, 0.1);
        width: 139px;
        height: 60px;
        left: -105px;
        top: 33px;
        border-radius: 5px;
        box-shadow: inset 0 0 5px rgba(158, 158, 158, 0.64)
    }

    .event1Bubble:after,
    .event1Bubble:before,
    .event2Bubble:after,
    .event2Bubble:before {
        content: "";
        position: absolute;
        width: 0;
        height: 0;
        border-style: solid;
        border-color: transparent;
        border-bottom: 0;
    }

    .event1Bubble:before {
        bottom: -10px;
        left: 13px;
        border-top-color: rgba(222, 222, 222, 0.66);
        border-width: 12px;
    }

    .event1Bubble:after {
        bottom: -8px;
        left: 13px;
        border-top-color: #F6F6F6;
        border-width: 12px;
    }

    .event2Bubble:before {
        bottom: 59px;
        left: 103px;
        border-top-color: rgba(222, 222, 222, 0.66);
        border-width: 12px;
        -webkit-transform: rotate(180deg);
        -moz-transform: rotate(180deg);
        -o-transform: rotate(180deg);
        -ms-transform: rotate(180deg);
        transform: rotate(180deg);
    }

    .event2Bubble:after {
        bottom: 57px;
        left: 103px;
        border-top-color: #F6F6F6;
        border-width: 12px;
        -webkit-transform: rotate(180deg);
        -moz-transform: rotate(180deg);
        -o-transform: rotate(180deg);
        -ms-transform: rotate(180deg);
        transform: rotate(180deg);
    }

    .eventTime {
        display: flex;
    }

    .DayDigit {
        font-size: 27px;
        font-family: "Arial Black", Gadget, sans-serif;
        margin-left: 10px;
        color: #4C4A4A;
    }

    .Day {
        font-size: 11px;
        margin-left: 5px;
        font-weight: bold;
        margin-top: 10px;
        font-family: Arial, Helvetica, sans-serif;
        color: #4C4A4A;
    }

    .MonthYear {
        font-weight: 600;
        line-height: 10px;
        color: #9E9E9E;
        font-size: 9px;
    }

    .eventTitle {
        font-family: "Arial Black", Gadget, sans-serif;
        color: #a71930;
        font-size: 8px;
        text-transform: uppercase;
        display: flex;
        flex: 1;
        align-items: center;
        margin-left: 12px;
        margin-top: -2px;
    }

    .time {
        position: absolute;
        font-family: Arial, Helvetica, sans-serif;
        width: 50px;
        font-size: 8px;
        margin-top: -3px;
        margin-left: -5px;
        color: #9E9E9E;
    }

    .eventAuthor {
        position: absolute;
        font-family: Arial, Helvetica, sans-serif;
        color: #9E9E9E;
        font-size: 8px;
        width: 100px;
        top: -8px;
        left: 63px;
    }

    .event2Author {
        position: absolute;
        font-family: Arial, Helvetica, sans-serif;
        color: #9E9E9E;
        font-size: 8px;
        width: 100px;
        top: 96px;
        left: -32px;
    }

    .time2{
        position: absolute;
        font-family: Arial, Helvetica, sans-serif;
        width: 50px;
        font-size: 8px;
        margin-top: -31px;
        margin-left: -5px;
        color: #9E9E9E;
    }

    .now{
        background-color: #004165;
        color: white;
        border-radius: 7px;
        margin: 5px;
        padding: 4px;
        font-size: 10px;
        font-family: Arial, Helvetica, sans-serif;
        border: 2px solid white;
        font-weight: bold;
        box-shadow: 0 0 0 2px #004165
    }

    .futureGray{
        filter: grayscale(1);
        -webkit-filter: grayscale(1);

    }

    .futureOpacity{
        -webkit-filter: opacity(.3);
        filter: opacity(.3);

    }
</style>

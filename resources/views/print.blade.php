<!DOCTYPE html>
<html lang="en">
<head>
    <title>@if(isset($dashboard['success'])){{ strtoupper($dashboard['success']['employee']['last_name']) }} - {{ strtoupper($dashboard['success'][$dashboard['success']['mode']]) }}@endif  DTR @ LGU Nabua</title>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
        }

        .no-margin-top {
            margin-top: 0;
        }

        .no-margin-bottom {
            margin-bottom: 0;
        }

        .text-uppercase {
            text-transform: uppercase;
        }

        .text-underlined {
            text-decoration: underline;
        }

        .text-monospace {
            font-family: monospace;
        }
    </style>
</head>
<body>
    @if(isset($dashboard['error']))
        <p style="color: red;" {{ $dashboard['error'] }}</p>
    @elseif(isset($dashboard['success']))
        {{-- DTR TABLE --}}
        <table id="dtr" style="width: 25%;" border="1" cellspacing="0">
            <thead>
                <tr>
                    <td colspan="7" style="padding: 3px;">
                        <p class="no-margin-top">CIVIL SERVICE FORM No. 48</p>
                        <div align="center">
                            {{-- HEADER --}}
                            <p class="no-margin-bottom"><b>DAILY TIME RECORD</b></p>
                            <p class="no-margin-top no-margin-bottom">oOo</p>

                            {{-- EMPLOYEE NAME --}}
                            <p class="text-uppercase text-underlined no-margin-bottom">
                                <b>
                                    @if($dashboard['success']['employee']['title'] != '')<span>{{ $dashboard['success']['employee']['title'] }}&nbsp;</span>@endif
                                    <span>{{ $dashboard['success']['employee']['first_name'] }}&nbsp;</span>
                                    @if($dashboard['success']['employee']['middle_name'] != '')<span>{{ substr($dashboard['success']['employee']['middle_name'], 0, 1) }}.&nbsp;</span>@endif
                                    <span>{{ $dashboard['success']['employee']['last_name'] }}</span>
                                    @if($dashboard['success']['employee']['name_suffix'])<span>&nbsp;{{ $dashboard['success']['employee']['name_suffix'] }}</span>@endif
                                </b>
                            </p>
                            <p class="no-margin-top"><small>(Name)</small></p>

                            {{-- SUBHEADER --}}
                            <p><i>For the period of <b class="text-underlined">&nbsp;&nbsp;{{ $dashboard['success'][$dashboard['success']['mode']] }}&nbsp;&nbsp;</b></i></p>
                            <table style="width: 100%">
                                <tr>
                                    <td style="width: 50%; padding-right: 10px;" align="right">
                                        <div style="display: inline-block" align="center">
                                            <small><b><i>Official hours for arrival</i><br><i>and departure</i></b></small>
                                        </div>
                                    </td>
                                    <td style="width: 50%; padding-left: 10px;" align="left">
                                        <table cellspacing="0">
                                            <tr>
                                                <td><b><small><i>Regular days</i></small></b></td>
                                                <td>:</td>
                                                <td>______</td>
                                            </tr>
                                            <tr>
                                                <td><b><small><i>Saturdays</i></small></b></td>
                                                <td>:</td>
                                                <td>______</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th rowspan="2" style="width: 8%"><small>Day</small></th>
                    <th colspan="2"><small>A.M.</small></th>
                    <th colspan="2"><small>P.M.</small></th>
                    <th colspan="2"><small>Under time</small></th>
                </tr>
                <tr>
                    <th style="width: 18%"><small>Arrival</small></th>
                    <th style="width: 18%"><small>Departure</small></th>
                    <th style="width: 18%"><small>Arrival</small></th>
                    <th style="width: 18%"><small>Departure</small></th>
                    <th style="width: 10%"><small>Hrs.</small></th>
                    <th style="width: 10%"><small>Min.</small></th>
                </tr>
            </thead>
            <tbody>
                @foreach($dashboard['success']['dtr'] as $dtr)
                    <tr>
                        <td class="text-monospace" align="center"><small><b>@if($loop->index + 1 < 10)&nbsp;@endif{{ $loop->index + 1 }}</b></small></td>
                        <td class="text-monospace" align="center"><small>{{ $dtr['logs']['1'] }}</small></td>
                        <td class="text-monospace" align="center"><small>{{ $dtr['logs']['2'] }}</small></td>
                        <td class="text-monospace" align="center"><small>{{ $dtr['logs']['3'] }}</small></td>
                        <td class="text-monospace" align="center"><small>{{ $dtr['logs']['4'] }}</small></td>
                        <td class="text-monospace" align="center"><small></small></td>
                        <td class="text-monospace" align="center"><small></small></td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5"><b>TOTAL</b></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="7" style="padding: 3px;">
                        <p style="text-indent: 30px; text-align: justify">
                            <small><i>
                                    I CERTIFY on my honor that the above is a true and correct
                                    report of the hours and work performed, record of which was made
                                    daily at the time of arrival and departure from office.
                                </i></small>
                        </p>
                        <p align="right">_____________________________</p>
                        <hr>
                        <p style="text-indent: 30px; text-align: justify">
                            <small><i>
                                    Verified as to the prescribed office hours.
                            </i></small>
                        </p>
                        <div align="right">
                            <div style="display: inline-block">
                                <p class="no-margin-top no-margin-bottom" align="center">_____________________________</p>
                                <p class="no-margin-top no-margin-bottom" align="center">In Charge</p>
                            </div>
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>
    @endif
    <script>
        window.print();
    </script>
</body>
</html>

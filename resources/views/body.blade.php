<!DOCTYPE html>
<html>
    <head>
        <meta name="robots" content="noindex,nofollow" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="x-apple-disable-message-reformatting">
        <!--[if !mso]><!-->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <style>
        .exception-details 
        {
           max-width: 1024px;
           margin: 20px auto;
           padding: 0 15px;
        }
        .table 
        {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }
        table 
        {
            border-collapse: collapse;
        }
        table 
        {
            display: table;
            border-collapse: separate;
            box-sizing: border-box;
            border-spacing: 2px;
            border-color: grey;
        }
        tbody 
        {
            display: table-row-group;
            vertical-align: middle;
            border-color: inherit;
        }
        tr 
        {
            display: table-row;
            vertical-align: inherit;
            border-color: inherit;
        }
        .table td, .table th 
        {
            padding: .75rem;
            vertical-align: top;
            border-top: 1px solid #efefef;
        }
        {!! $stylesheet !!}
        .exception-summary 
        {
            max-width: 1024px;
            margin: 0 auto;
            padding: 0px 0px;
        }
        </style>
    </head>
    <body>
        <div class="exception-details">
            <div class="sf-tabs">
                <div class="tab">
                    <div class="tab-content">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th colspan="2">
                                        <div class="trace-head">
                                            <h3 class="trace-class">
                                                Exception Details
                                            </h3>
                                        </div>
                                    </th>
                                </tr>
                                <tr>
                                    <td>  User </td>
                                    <td> 
                                        {{ optional(request()->user())->email ?? 'No Auth / User Object' }}
                                    </td>
                                </tr> 

                                <tr>
                                    <td>  Requested Url </td>
                                    <td>  {{ request()->url() }} </td>
                                </tr> 
                                <tr>
                                    <td> Time </td>
                                    <td> {{ date('l, jS \of F Y h:i:s a') }} {{ date_default_timezone_get() }}  </td>
                                </tr> 
                                <tr>
                                    <td>Hostname</td>
                                    <td> {{ request()->getHttpHost() }}  </td>
                                </tr> 
                                <tr >
                                    <td> Message </td> 
                                    <td >  {!! $message !!}  </td>
                                </tr>
                                <tr>
                                    <td> Environment </td>
                                    <td>  {{ app()->environment() }} </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {!! $content !!}
    </body>
</html>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        pre {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 0;
            margin: 0;
        }
        #invoice {
            padding: 30px;
            padding-top: 10px;
            color: #555;
        }
        .strong {
            color: #000 !important;
            font-weight: bold;
            font-size: 1.1rem;
        }
        .left {
            float: left;
            width: 50%;
        }
        .right {
            float: right;
            width: 50%;
        }
        .pull-right {
            float: right;
        }
        .clear {
            clear: both;
        }
        .logo {
            margin-top: 50px;
        }
        .text-left {
            text-align: left;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
    </style>
  </head>
  <body>
    <div class="container" id='invoice'>
        <div class="row">
            <div class="left">
                <div class="logo">
                    <img src="{{asset('assets/logo').'/'.$settings->logo}}" width="220" height="42" alt="logo">
                </div>
            </div>
            <div class="right">
                <h1 class="strong pull-right" style="font-size: 2.5rem;">TAX INVOICE</h1>
            </div>    
            <div class="clear"></div>
        </div>
        <br />
        <div class="row">
            <div class="left">
                <table>
                    <tr><td class="strong">BILL FROM</td></tr>
                    <tr><td>{{env('APP_NAME')}}</td></tr>
                    <tr><td></td></tr>
                    <tr><td><pre>{{$settings->address}}</pre></td></tr>
                    <tr><td></td></tr>
                    <tr><td>{{env('COMPANY')}}</td></tr>
                </table>
            </div>
            <div class="right">
                <table class="pull-right" style="width: 300px;">
                    <tr>
                        <td class="strong">TAX #</td>
                        <td class="strong">TAX RATE</td>
                    </tr>
                    <tr>
                        <td>{{$settings->tax_id}}</td>
                        <td>{{$settings->tax_rate}}%</td>
                    </tr>
                    <tr><td></td></tr>
                    <tr class="strong">
                        <td>CURRENCY</td>
                        <td>DATE</td>
                    </tr>
                    <tr>
                        <td>CAD</td>
                        <td>{{$payment->created_at}}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="clear"></div>
        <br />
        <div class="row">
            <div class="left">
                <table>
                    <tr><td class="strong">BILL TO</td></tr>
                    <tr><td>{{$payment->user->f_name}} {{$payment->user->l_name}}</td></tr>
                    <tr><td></td></tr>
                    <tr><td><pre>{{$payment->user->location}}</pre></td></tr>
                    <tr><td>E-mail: {{$payment->user->email}}</td></tr>
                </table>
            </div>
            <div class="right"></div>
        </div>
        <div class="clear"></div>
        <br />
        <div class="row">
            <table>
                <tr><td class="strong">FOR</td></tr>
                <tr><td>Services on {{env('APP_NAME')}}</td></tr>
            </table>
        </div>
        <div class="clear"></div>
        <br />
        <br />
        <div class="row">
            <table style="width: 100%;">
                <thead class="strong" style="background-color: #ccc;">
                    <tr>
                        <th style="padding: 10px;" class="text-left">Description</th>
                        <th style="padding: 10px;" class="text-right">Amount</th>
                    </tr>
                </thead>
                <tbody style="border-bottom: 1px solid #ccc !important;">
                    <tr>
                        <td style="padding: 10px;">{{strtoupper($payment->package->name)}} package purchase payment.</td>
                        <td style="padding: 10px;" class="text-right">${{$payment->package->price}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <br />
        <br />
        <br />
        <br />
        <br />
        <div class="row">
            <div class="left"></div>
            <div class="right">
                <table style="width: 100%;">
                    <tbody style="border-top: 1px solid #ccc !important;">
                        <tr class="strong">
                            <td style="padding: 10px;" class="text-left">Total</td>
                            <td style="padding: 10px;" class="text-right">${{round($payment->package->price + $payment->package->price * ($settings->tax_rate)/100, 2)}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
  </body>
</html>
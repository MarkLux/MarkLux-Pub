@extends('layout.app')

@section('content')
    <div class="container">
        <div class="mycontainer">
        <div class="title">
            工作室老黄历<sup>beta</sup>
        </div>
        <div class="date">
            {{$date}}
        </div>
        <div class="good">
            <div class="title">
                <table>
                    <tr><td>宜</td></tr>
                </table>
            </div>
            <div class="content">
                <ul>
                   @foreach($goods as $good)
                       <li><div class="name">{{$good['name']}}</div><div class="description">{{$good['good']}}</div></li>
                    @endforeach
                </ul>
            </div>
            <div class="clear"></div>
        </div>
        <div class="split"></div>
        <div class="bad">
            <div class="title">
                <table>
                    <tr><td>不宜</td></tr>
                </table>
            </div>
            <div class="content">
                <ul>
                    @foreach($bads as $bad)
                        <li><div class="name">{{$bad['name']}}</div><div class="description">{{$bad['bad']}}</div></li>
                    @endforeach
                </ul>
            </div>
            <div class="clear"></div>
        </div>
        <div class="split"></div>
        <div class="line-tip">
            <strong>座位朝向：</strong>面向<span class="direction_value">{{$direction[0]}}</span>写程序，BUG 最少。
        </div>
        <div class="line-tip">
            <strong>今日宜饮：</strong><span class="drink_value">
                @foreach($drinks as $drink)
                    {{$drink." "}}
                @endforeach
            </span>
        </div>
            <div class="line-tip">
                <strong>今日宜吃：</strong><span class="drink_value">
                    @foreach($foods as $food)
                        {{$food." "}}
                    @endforeach
                </span>
            </div>
        <div class="line-tip">
            <strong>女神亲近指数：</strong><span class="goddes_value">{{$stars}}</span>
        </div>

        <div class="comment">
            <ul>
                <li>本老黄历由runJS原版本修改而来</li>
            </ul>
        </div>
    </div>
    </div>
    {{--{{$daysPassed}}--}}
    </body>
    </html>
    <style>body * {
            font-family:"Consolas","Microsoft Yahei", Arial, sans-serif;
        }

        body {
            background: white;
            margin: 0;
            padding: 0;
        }

        .mycontainer {
            width: 320px;
            margin: 0 auto 50px;
        }

        .mycontainer>.title {
            color: #bbb;
            font-weight: bold;
            margin-bottom: 10px;
            background: #555;
            padding: 5px 15px;
        }

        .adlink {
            text-align: center;
            font-size: 11pt;
        }

        .adlink a {
            text-decoration: none;
            display:block;
            color: #666;
            font-weight: bold;
            margin-bottom: 10px;
            background: #eee;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 10pt;
            margin-top: 10pt;
        }

        .date{
            font-size:17pt;
            font-weight: bold;
            line-height: 30pt;
            text-align: center;
        }

        .split, .clear {
            clear: both;
            height: 1px;
            overflow-y: hidden;
        }

        .good, .bad {
            clear: both;
            position: relative;
        }

        .bad {
            /*top: -1px;*/
        }

        .good .title, .bad .title {
            float: left;
            width: 100px;
            font-weight: bold;
            text-align: center;
            font-size: 30pt;
            position:absolute;
            top:0;
            bottom:0;
        }

        .good .title>table, .bad .title>table {
            position:absolute;
            width:100%;
            height:100%;
            border:none;
        }

        .good .title {
            background: #ffee44;
        }

        .someday .good .title {
            background: #aaaaaa;
        }

        .bad .title {
            background: #ff4444;
            color: #fff;
        }

        .someday .bad .title {
            background: #666666;
            color: #fff;
        }

        .good .content, .bad .content {
            margin-left: 115px;
            padding-right: 10px;
            padding-top: 1px;
            font-size:15pt;
        }

        .someday .good {
            background: #dddddd;
        }

        .someday .bad {
            background: #aaaaaa;
        }

        .good {
            background: #ffffaa;
        }

        .bad {
            background: #ffddd3;
        }

        .content ul {
            list-style: none;
            margin:10px 0 0;
            padding:0;
        }

        .content ul li {
            line-height:150%;
            font-size: 15pt;
            font-weight: bold;
            color: #444;
        }

        .content ul li div.description {
            font-size: 11pt;
            font-weight: normal;
            color: #777;
            line-height: 110%;
            margin-bottom: 10px;
        }

        .line-tip {
            font-size: 11pt;
            margin-top: 10px;
            margin-left: 10px;
        }

        .direction_value {
            color:#4a4;
            font-weight: bold;
        }

        .someday .direction_value {
            color:#888;
        }

        .goddes_value {
            color: #f87;
        }

        .someday .goddes_value {
            color: #777;
        }

        .comment {
            margin-top: 50px;
            font-size: 11pt;
            margin-left: 10px;
        }

        .comment ul {
            margin-left: 0;
            padding-left: 20px;
            color: #999;
        }</style>
@endsection

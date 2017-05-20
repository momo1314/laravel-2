<!DOCTYPE html>
<html>
    <head>
        <title>homework</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{ URL::asset('css/welcome.css') }}" type="text/css" />
    </head>
    <body>
        <form action="/stu" method="post">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="container">
                    <div class="content">
                        <div class="con">
                            <p>请输入学号：</p>
                            <input type="text" name="stuid" id="stuid" value="10位/暂时无法存入库">
                            <br /><br /><br />
                            <button type="submit" id="button2">提交</button>
                            <div id="stu"></div>
                        </div>
                    </div>
                </div>
            </form>
            <form action="/cla" method="post">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="container">
                    <div class="content">
                        <div class="con">
                            <p>请输入班级：</p>
                            <input type="text" name="classid" id="classid" value="7-8位">
                            <br /><br /><br />
                            <button type="submit" id="button">提交</button>
                            <div id="class"></div>
                        </div>
                    </div>
                    <div>

                    </div>
            </div>
        </form>

    </body>
</html>

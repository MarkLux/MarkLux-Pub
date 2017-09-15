<div class="container">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-1"><a class="btn btn-default" href="#" role="button">+ 添加</a></div>
                <div class="col-md-1"><a class="btn btn-default" href="#" role="button">编辑</a></div>
                <div class="col-md-1"><a class="btn btn-default" href="#" role="button">删除</a></div>
                <div class="col-md-1"><a class="btn btn-default" href="#" role="button">账单信息</a></div>
            </div>
        </div>
        <table class="table">
            <tr>
                <th>#</th>
                <th>客户名称</th>
                <th>类型</th>
                <th>国家</th>
                <th>邮箱</th>
                <th>电话</th>
                <th>行程日期</th>
                <th>人数</th>
                <th>天数</th>
                <th>创建日期</th>
                <th>状态</th>
            </tr>
            @for($i=0;$i<13;$i++)
                <tr>
                    <td>{{$i}}</td>
                    <td>马克</td>
                    <td>旅行社</td>
                    <td>法国</td>
                    <td>marlx6590@163.com</td>
                    <td>+8615076051320</td>
                    <td>2017-08-20 ~ 2017-08-28</td>
                    <td>8</td>
                    <td>9</td>
                    <td>2017-08-11 12:00:00</td>
                    <td>正常</td>
                </tr>
            @endfor
        </table>
    </div>
</div>
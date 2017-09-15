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
                <th>模板名称</th>
                <th>标签</th>
                <th>行程安排</th>
                <th>天数</th>
                <th>价格</th>
                <th>状态</th>
                <th>创建日期</th>
                <th>创建人</th>
                <th>备注</th>
            </tr>
            @for($i=0;$i<13;$i++)
                <tr>
                    <td>{{$i}}</td>
                    <td>未命名</td>
                    <td>多个标签</td>
                    <td>北京—西安—上海—广州—北京</td>
                    <td>10</td>
                    <td>8000</td>
                    <td>草稿</td>
                    <td>2017-08-11 12:00:00</td>
                    <td>东方不败</td>
                    <td>备注</td>
                </tr>
            @endfor
        </table>
    </div>
</div>
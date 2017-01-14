<html>
@include('jg.main.header')
@section('title', '登录系统')
<body class="easyui-layout">
<div data-options="region:'north',split:true" style="height:50px;">
</div>
<div data-options="region:'center'">
    <div class="easyui-panel" style="max-width:400px;padding:30px 60px;" data-options="border:false">
        <form id="ff" method="post">
            <div style="margin-bottom:20px">
                <input class="easyui-textbox" name="name" style="width:300px"
                       data-options="label:'Name:',required:true">
            </div>
            <div style="margin-bottom:20px">
                <input class="easyui-textbox" type="password" name="password" style="width:300px"
                       data-options="label:'Password:',required:true">
            </div>
        </form>
        <div style="text-align:center;padding:5px 0">
            <input class="easyui-textbox" type="hidden" id="_token" name="_token" value="{{ csrf_token() }}" />
            <a href="javascript:void(0)" class="easyui-linkbutton" onclick="submitForm()" style="width:80px">Submit</a>
        </div>
    </div>
</div>
</body>
</html>
<script>
    var loginUrl = '{{$loginUrl}}';
</script>
@include('jg.main.footer')
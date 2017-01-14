<html>
@include('jg.main.header')
<body class="easyui-layout">
<div data-options="region:'north',split:true" style="height:50px;">
    @section('header')
        客户管理系统
    @show
</div>
<div data-options="region:'west',split:true,title:'菜单'" style="width:80px;">
    @section('lefter')
        <ul class="easyui-tree" id="leftMenu" style="margin-left: -15px;">
        </ul>
    @show
</div>
<div data-options="region:'center'">
    @section('contenter')
        This is the master sidebar.
    @show
</div>
</body>
</html>
@include('jg.main.footer')
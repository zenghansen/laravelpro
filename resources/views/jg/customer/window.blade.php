<div id="window" class="easyui-window" style="padding: 20px;display: none"
     data-options="modal:true,minimizable:false,maximizable:false,collapsible:false,closed:true">
    <form id="ff" class="easyui-form" method="post" data-options="novalidate:true">
        <table cellpadding="5">
            <tr>
                <td>名字:</td>
                <td><input class="easyui-textbox" name="name" data-options="required:true"/></td>
            </tr>
            <tr>
                <td>电话:</td>
                <td><input class="easyui-textbox" name="mobile" data-options="required:true"/></td>
            </tr>
            <tr>
                <td>地址:</td>
                <td><input class="easyui-textbox" name="addr" data-options="required:false"/></td>
            </tr>
        </table>
    </form>
    <div style="text-align:center;padding:5px">
        <input class="easyui-textbox" type="hidden" id="_token" name="_token" value="{{ csrf_token() }}" />
        <a href="javascript:void(0)" class="easyui-linkbutton" onclick="submitForm()">提交</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" onclick="closeForm()">关闭</a>
    </div>
</div>

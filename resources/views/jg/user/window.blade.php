<div id="window" class="easyui-window" style="padding: 20px;display: none"
     data-options="modal:true,minimizable:false,maximizable:false,collapsible:false,closed:true">
    <form id="ff" class="easyui-form" method="post" data-options="novalidate:true">
        <table cellpadding="5">
            <tr>
                <td>账号:</td>
                <td><input class="easyui-textbox" name="name" data-options="required:true"/></td>
            </tr>
            <tr>
                <td>密码:</td>
                <td><input class="easyui-textbox" type="password" name="password" data-options="required:true"/></td>
            </tr>
            <tr>
                <td>角色:</td>
                <td>
                    <select class="easyui-combobox" name="roleId" data-options="required:true">
                        <option value="2" selected>普通</option>
                        <option value="1">管理</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>真名:</td>
                <td><input class="easyui-textbox" name="realName" data-options="required:true"/></td>
            </tr>
        </table>
    </form>
    <div style="text-align:center;padding:5px">
        <input class="easyui-textbox" type="hidden" id="_token" name="_token" value="{{ csrf_token() }}"/>
        <a href="javascript:void(0)" class="easyui-linkbutton" onclick="submitForm()">提交</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" onclick="closeForm()">关闭</a>
    </div>
</div>

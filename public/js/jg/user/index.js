$(function ($) {
    initList();
})
function initList() {
    $('#grid').datagrid({
        title: '员工列表',
        method: 'get',
        singleSelect: true,
        //rownumbers: true,
        pagination: true,
        pageSize: 20,
        fit: true,
        border: false,
        fitColumns: true,
        url: getUrl,
        loadFilter: function (data) {
            data.rows = data.data;
            return data;
        },
        columns: [
            [
                {title: '编号', field: 'id', width: 50, align: 'center'},
                {title: '账号', field: 'name', width: 100, align: 'center'},
                {title: '角色', field: 'roleId', width: 100, align: 'center',formatter: function (value, row, index) {
                    return value == 1?'管理员':value == 2?'普通员工':'未知';
                }},
                {title: '真名', field: 'realName', width: 100, align: 'center'},
                {
                    title: '操作', field: 'opt', width: 100, align: 'center', formatter: function (value, row, index) {
                    var btn1 = '<a class="easyui-linkbutton" onclick="edit(\'' + index + '\')"  href="javascript:void(0)">編輯</a> | ';
                    var btn2 = '<a class="easyui-linkbutton" onclick="del(\'' + row.id + '\')"  href="javascript:void(0)">删除</a>';
                    return btn1 + btn2;
                }
                }
            ]
        ],
        toolbar: [{
            text: '添加',
            iconCls: 'icon-add',
            handler: add
        }]
    });
    //设置分页控件
    var p = $('#grid').datagrid('getPager');
    $(p).pagination({
        layout: ['first', 'prev', 'next', 'last'],
        displayMsg: '{from}-{to} 共{total}'
    });
}
function add() {
    $('#window').window({
        title: "添加账号"
    });
    selectRow = null;
    $('#window').window('open');
    $('#ff').form('clear');
}
function edit(index) {
    $('#grid').datagrid('selectRow', index);
    $('#window').window({
        title: "编辑账号"
    });
    selectRow = $('#grid').datagrid('getSelected'); //此处竟然传引用。
    $('#ff').form('load', selectRow);
    $('#window').window('open');
}

function del(id) {
    $.messager.confirm('删除', '你確定要删除该账号?', function (r) {
        if (r) {
            var _token = $('#_token').textbox('getValue');
            $.post(editUrl, {id: id, oper: 'del', _token: _token}, function (data) {
                if (data.code != 0) {
                    $.messager.alert('提示', '操作失败');
                    $('#grid').datagrid('reload');
                    return;
                }
                $.messager.alert('提示', '操作成功');
                $('#grid').datagrid('reload');
            }, 'json')
        }
    });
}


function submitForm() {
    $('#ff').form('submit', {
        url: editUrl,
        onSubmit: function (param) {
            param._token = $('#_token').textbox('getValue');
            if (selectRow != null) {
                param.id = selectRow.id;
                param.oper = 'edit';
            } else {
                param.oper = 'add';
            }
            return $(this).form('enableValidation').form('validate');
        },
        success: function (data) {
            var data = eval('(' + data + ')');
            if (data.code !== 0) {
                $.messager.alert('提示', '操作失败');
                return;
            }
            $.messager.alert('提示', '操作成功');
            $('#window').window('close');
            $('#grid').datagrid('reload');
            clearForm();
        }
    });
}
$(function ($) {
    initList();
})
function initList() {
    $('#grid').datagrid({
        title: '用户列表',
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
                {title: '名字', field: 'name', width: 100, align: 'center'},
                {title: '电话', field: 'mobile', width: 100, align: 'center'},
                {title: '地址', field: 'addr', width: 100, align: 'center'},
                /*{title: '简介', field: 'desc', width: 100, align: 'center'},*/
                {title: '创建人', field: 'adminName', width: 100, align: 'center'},
                {title: '创建时间', field: 'created_at', width: 100, align: 'center'}
            ]
        ],
        toolbar: [{
            text: '添加',
            iconCls: 'icon-add',
            handler: add
        }, {
            text: '编辑',
            iconCls: 'icon-edit',
            handler: edit
        }, {
            text: '删除',
            iconCls: 'icon-remove',
            handler: del
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
    $('#grid').datagrid('unselectAll');
    $('#window').window({
        title: "添加客户"
    });
    selectRow = null;
    $('#window').window('open');
    $('#ff').form('clear');
}
function edit() {
    if (!checkSelected()) return false;
    $('#window').window({
        title: "编辑客户"
    });
    $('#ff').form('load', selectRow);
    $('#window').window('open');

}

function del() {
    if (!checkSelected()) return false;
    $.messager.confirm('删除', '你確定要删除该客户?', function (r) {
        if (r) {
            var _token = $('#_token').textbox('getValue');
            $.post(editUrl, {id: selectRow.id, oper: 'del', _token: _token}, function (data) {
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
var selectRow;
function clearForm() {
    $('#ff').form('clear');
}
function closeForm() {
    $('#window').window('close');
}
function checkSelected(){
    selectRow = $('#grid').datagrid('getSelected');
    if(selectRow == undefined){
        $.messager.alert('提示', '请选择需要操作的行');
        return false;
    }
    return true;
}
$(function ($) {
    $('#leftMenu').tree({
        data: [{
            id: 2,
            text: 'Item1',
            href: '/admin/jg/customer/index',
        }, {
            id: 1,
            text: 'Item2',
            href: '/admin/jg/user/index',
        }],
        onClick: function (node) {
            location.href = node.href;
        }
    });

    if (urlId != 0) {
        var node = $('#leftMenu').tree('find', urlId);
        $('#leftMenu').tree('select', node.target);
    }
})

$(function ($) {
})
function submitForm() {
    $('#ff').form('submit', {
        url: loginUrl,
        onSubmit: function (param) {
            param._token = $('#_token').textbox('getValue');
            return $(this).form('enableValidation').form('validate');
        },
        success: function (data) {
            var data = eval('(' + data + ')');
            if (data.code !== 0) {
                $.messager.alert('提示', data.msg);
                return;
            }
            $.messager.alert('提示', '操作成功');
            location.href = '/admin/jg/customer/index';

        }
    });
}
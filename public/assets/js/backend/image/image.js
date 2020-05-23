define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'image/image/index',
                    add_url: 'image/image/add',
                    edit_url: 'image/image/edit',
                    del_url: 'image/image/del',
                    multi_url: 'image/image/multi',
                    table: 'image',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'user.id',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: __('Id'), sortable: true},
                        {field: 'name', title: __('Name'), operate: 'LIKE'},
                        {field: 'tags', title: __('Tags'), operate: 'LIKE'},
                        {field: 'pic', title: __('Pic'), events: Table.api.events.image, formatter: Table.api.formatter.image, operate: false},
                        {field: 'cid', title: __('Cid'), sortable: true},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        add: function () {
            Controller.api.bindevent();
        },
        edit: function () {
            Controller.api.bindevent();
        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }
        }
    };
    return Controller;
});

<script type="text/javascript">
    var temp=-1;
     $(function(){

        var dg = $("#dgJemaat").datagrid(
            {
                remoteFilter:true,
                pagination:true,
                rownumbers:true,
                fitColumns:true,
                fit:true,
                remoteSort:true,
                singleSelect:true,
                checkOnSelect: false,
                selectOnCheck: false,
                clientPaging: false,
                autoResize:true,
                url:"<?= base_url() ?>jemaat/gridBesuk",
                method:'get',
                onClickRow:function(index,row){
                    $("#member").textbox('setValue',row.member_key);
                    $("#member_name").textbox('setValue',row.membername);
                    $("#chinese_name").textbox('setValue',row.chinesename);
                    $("#address").textbox('setValue',row.address);
                    var image1 = $(row.photofile).attr('src');
                    image1 = image1.replace("small","medium");
                    $("#blah").attr("src",image1);
                    $("#aliasname2").textbox('setValue',row.aliasname2);
                    $("#dlgViewLookup").dialog('close');
                },onLoadSuccess:function(data){
                    $("#dgJemaat").datagrid('enableFilter');
                 }
            });
    });

</script>
 <table id="dgJemaat" class="easyui-datagrid" style="height:350px"
 toolbar="#tb">
    <thead>
        <tr>
            <th hidden="true" field="member_key" width="5%"></th>
            <th sortable="true" field="membername" width="30">membername</th>
            <th sortable="true" field="chinesename" width="30">chinesename</th>
             <th sortable="true" field="aliasname2" width="30">aliasname2</th>
            <th sortable="true" field="address" width="30">address</th>

        </tr>
    </thead>
</table>

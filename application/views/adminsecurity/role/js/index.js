$(document).ready(function(){
    
    $("#btn_save_role").click(function(){

        UIkit.modal.confirm("Bạn có chắc muốn lưu",function(){
               $("form[name=frmsaverole]").submit();
            
        });
    })
    $("#change_role").change(function(){
            var form = document.createElement("form");
            var element1 = document.createElement("input"); 
             form.method = "POST";
             form.action = ADMIN_URL+"role/index";
             element1.value=$(this).val();
             element1.name="role_not_update";
             form.appendChild(element1);  
             document.body.appendChild(form);
             form.submit();
    })
})
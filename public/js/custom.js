
$(document).on('click', '.add-product' ,function (e) {
  var target=$(this).parent().parent().parent();
var color_select= $('#color_sel').html();
var size_select= $('#size_sel').html();	
var delete_btn='<a href="javascript:void(0);"  class="btn btn-danger btn-circle btn-sm btn-remove"><i class="fas fa-trash"></i></a>';
var html='<tr><td><input type="file" accept="jpg,jpeg,png,gif" class="file" name="add_product_image[]" style="width:100px"></td><td>'+
		'<select name="add_color[]" class="form-control form-control-user">'+color_select+'</select></td><td><select name="add_size[]" class="form-control form-control-user">'+
		size_select+'</select></td><td><input type="number" name="add_original_price[]" class="form-control form-control-user" style="width:100px"></td>'+'<td><input type="number" name="add_discount_price[]" class="form-control form-control-user" style="width:100px"></td>'+
		'<td><input type="number" name="add_quantity[]" class="form-control form-control-user" style="width:100px"></td><td><a href="javascript:void(0);" class="btn btn-info btn-circle btn-sm add-product"><i class="fas fa-plus"></i></a></td></tr>';

target.append(html);
$(this).parent().html(delete_btn);
});

$(document).on('click', '.add-service' ,function (e) {
  var target=$(this).parent().parent().parent();
var delete_btn='<a href="javascript:void(0);"  class="btn btn-danger btn-circle btn-sm btn-remove"><i class="fas fa-trash"></i></a>';
var html='<tr><td><input type="name" name="service_variation[]" class="form-control form-control-user"></td>'+
		 '<td><input type="name" name="service_subvariation[]" class="form-control form-control-user"></td>'+
		 '<td><input type="number" name="original_price[]" class="form-control form-control-user" style="width:100px" min="0"></td>'+
		 '<td><input type="number" name="discount_price[]" class="form-control form-control-user" style="width:100px"  min="0"></td>'+
		 '<td><a href="javascript:void(0);" class="btn btn-info btn-circle btn-sm add-service"><i class="fas fa-plus"></i></a></td></tr>';

target.append(html);
$(this).parent().html(delete_btn);
});

$(document).on('click', '.btn-remove' ,function (e) {
  var target=$(this).parent().parent();
target.remove();
});

$(document).on('change', '.update_product_fields' ,function (e) {
 var id=$(this).data('id');
 var table=$(this).data('table');
 var column=$(this).data('column');
 var cname=$(this).data('cname');
 var value=$(this).val();
 $.post(base_url+'admin/update_product_ajax', {id: id,table:table,column:column,value:value}, function(result){
    if(result==true)
	{
		alert(cname+' sucessfully update');
	}
  });
});


$(document).on('change', '.update_service_fields' ,function (e) {
 var id=$(this).data('id');
 var table=$(this).data('table');
 var column=$(this).data('column');
 var cname=$(this).data('cname');
 var value=$(this).val();
 $.post(base_url+'admin/update_service_ajax', {id: id,table:table,column:column,value:value}, function(result){
    if(result==true)
	{
		alert(cname+' sucessfully update');
	}
  });
});




$('.image_update_ajax').change(function(){
 var file = this.files[0];
 var id=$(this).data('id');
 var table=$(this).data('table');
 var column=$(this).data('column');
 var fd = new FormData();
 
        
        // Check file selected or not
        if(file){
           fd.append('file',file);
		   fd.append('id',id);
		   fd.append('table',table);
		   fd.append('column',column);

           $.ajax({
              url: base_url+'admin/product_ajax_upload',
              type: 'post',
              data: fd,
			  dataType : "json",
              contentType: false,
              processData: false,
              success: function(response){
                 if(response.status==true){
                    $("#img_"+id).attr("src",response.src); 
					alert('Photo uploaded Sucessfully');
                 }else{
                    alert('file not uploaded');
                 }
              },
           });
        }
	
	
});


$('.update_default').click(function(){
 var id=$(this).data('id');
 var table=$(this).data('table');
 var column=$(this).data('column');
 var fd = new FormData();
 
        
        // Check file selected or not
        if(id){
		   fd.append('id',id);
		   fd.append('table',table);
		   fd.append('column',column);

           $.ajax({
              url: base_url+'admin/product_ajax_default',
              type: 'post',
              data: fd,
			  dataType : "json",
              contentType: false,
              processData: false,
              success: function(response){
                 if(response.status==true){
                     alert('Default product uploaded');
                 }else{
                    alert('Please try again');
                 }
              },
           });
        }
	
	
});

$('.update_default_service').click(function(){
 var id=$(this).data('id');
 var table=$(this).data('table');
 var column=$(this).data('column');
 var fd = new FormData();
 
        
        // Check file selected or not
        if(id){
		   fd.append('id',id);
		   fd.append('table',table);
		   fd.append('column',column);

           $.ajax({
              url: base_url+'admin/service_ajax_default',
              type: 'post',
              data: fd,
			  dataType : "json",
              contentType: false,
              processData: false,
              success: function(response){
                 if(response.status==true){
                     alert('Default product uploaded');
                 }else{
                    alert('Please try again');
                 }
              },
           });
        }
	
	
});

$('.remove_gallery_ajax').click(function(){
 var id=$(this).data('id');
 var flag=$(this).data('flag');
 if(flag==1)
 {
	 alert('Can not delete default product');
	 return false;
 }
 
 var fd = new FormData();
 
        
        // Check file selected or not
        if(id){
		   fd.append('id',id);
		   fd.append('flag',flag);


           $.ajax({
              url: base_url+'admin/remove_gallery_ajax',
              type: 'post',
              data: fd,
			  dataType : "json",
              contentType: false,
              processData: false,
              success: function(response){
                 if(response.status==true){
                     alert('Default product uploaded');
                 }else{
                    alert('Please try again');
                 }
              },
           });
        }
	
	
});


$('.remove_pricing_ajax').click(function(){
 var id=$(this).data('id');
 var flag=$(this).data('flag');
 if(flag==1)
 {
	 alert('Can not delete default product');
	 return false;
 }
 
 var fd = new FormData();
 
        
        // Check file selected or not
        if(id){
		   fd.append('id',id);
		   fd.append('flag',flag);


           $.ajax({
              url: base_url+'admin/remove_pricing_ajax',
              type: 'post',
              data: fd,
			  dataType : "json",
              contentType: false,
              processData: false,
              success: function(response){
                 if(response.status==true){
                     alert('Default Service uploaded');
                 }else{
                    alert('Please try again');
                 }
              },
           });
        }
	
	
});

if($("select").hasClass("select2"))
{
	$('.select2').select2();
}



if($("select").hasClass("select_2"))
{
	if(vars[0].max_cat!='-1')
	{
		$('.select_2').select2({maximumSelectionLength: vars[0].max_cat});
	}
	else
	{
		$('.select_2').select2();
	}
	
}



if($("#color_value").length)
{
	$('#color_value').colorpicker();
}




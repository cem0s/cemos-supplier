
 $(function () {
    // $('input').iCheck({
    //   checkboxClass: 'icheckbox_square-blue',
    //   radioClass: 'iradio_square-blue',
    //   increaseArea: '20%' // optional
    // });
    $('#ordertable').DataTable()
    $(".fancybox").fancybox();

    

});


function assignMember(id)
{
	getModalForAssignMember(id);
	getMembers();
	$('#modal-assign').modal('show');

}

function getModalForAssignMember(id)
{
	var modal = '';

	modal+='<div class="modal fade" id="modal-assign">'
	    modal+='<div class="modal-dialog">';
	        modal+='<div class="modal-content">';
		        modal+='<div class="modal-header">';
		            modal+='<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
		               modal+='<span aria-hidden="true">&times;</span></button>';
		            modal+='<h4 class="modal-title">Choose Member</h4>';
		        modal+='</div>';
		        modal+='<div class="modal-body">';
		            modal+='<select class="form-control" name="member" id="member"></select><br>';
		        modal+='</div>';
		        modal+='<div class="modal-footer">';
		            modal+='<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>';
		            modal+='<button type="button" class="btn btn-primary" onclick="assign('+id+')">Assign Member</button>';
		        modal+='</div>';
	        modal+='</div>';
	   modal+=' </div>';
   modal+=' </div>';

   $('body').append(modal);
}

function getMembers()
{
	$('#modal-assign select[name="member"]').html('');
	$.ajax({
		url: "/cemos-supplier/get-members",
		success: function(res){
			var d = $.parseJSON(res);
            var options = '<option value="-">--Select Member--</option>';
             $.each(d, function (i, item) {
                options += '<option value="' + item.id + '">' + item.firstname + ' '+ item.lastname+ '</option>';

            });
            $('#modal-assign select[name="member"]').append(options);
		}
	});
}


function assign(id)
{
	var supId = $('#member').val();

	$.ajax({
		url: '/cemos-supplier/assign-member',
		data:{ id: id, supplier:supId},
		success: function(res)
		{
			if(res) {
				location.reload();
			} else {
				alert('Ops, there is something wrong in assigning this product to a supplier. Kindly contact the web admin.');
				return;
			}

		}
	});
}

function confirm()
{
	getModalForConfirmation();
	$('#modal-confirm').modal('show');
}

function getModalForConfirmation()
{
	var modal = '';

	modal+='<div class="modal fade" id="modal-confirm">'
	    modal+='<div class="modal-dialog">';
	        modal+='<div class="modal-content">';
		        modal+='<div class="modal-header">';
		            modal+='<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
		               modal+='<span aria-hidden="true">&times;</span></button>';
		            modal+='<h4 class="modal-title">Confirmation</h4>';
		        modal+='</div>';
		        modal+='<div class="modal-body">';
		            modal+='Please confirm if the files you are going to upload are edited or not.<br> This action cannot be undone.<br>';
		        modal+='</div>';
		        modal+='<div class="modal-footer">';
		            modal+='<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>';
		            modal+='<button type="button" class="btn btn-primary" onclick="confirmEdited()">Yes</button>';
		        modal+='</div>';
	        modal+='</div>';
	   modal+=' </div>';
   modal+=' </div>';

   $('body').append(modal);
}

function confirmEdited()
{
	$('#modal-confirm').modal('hide');
	$("input[type=radio]").attr('disabled', true);
	var selectedOption = $("input:radio[name=isEdited]:checked").val();
	$('#isEdited').val(selectedOption);
	$('#upload-here').css('display','block');

}

function submitFiles(id, orderId, step, e)
{
	//var countImages = $('div.dz-preview').length;
	var isEdited = $('#isEdited').val();
	if(isEdited == 1){
		step += 2;
	} else {
		step += 1;
	}

	// if(countImages == 0 ){
	// 	alert("Please upload some images first.");
	// } else {
	$.ajax({
		url:"/cemos-supplier/submit-images",
		data: {id:id, orderId:orderId, step:step},
		beforeSend: function() {
			$(e).attr('disabled', true);
			$(e).next().css('display','inline');	
		},
		success: function(res) {
			if(res.success=="success"){
				alert("Files are delivered!");
				window.location.href = '/cemos-supplier/dashboard';
			}
			
		}
	});
	//}

}

function zipDownload(zipFileName)
{
	var objId = $('#objectId').val();
    var orderId = $('#orderId').val();
    var orderPId = $('#orderProductId').val();
    var companyId = $('#companyId').val();
    var step = $('#step').val();
	$.ajax({
		url:"/cemos-supplier/zip-file",
		data: {
			name:zipFileName,
			objId:objId,
			orderId:orderId,
			orderPId:orderPId,
			companyId:companyId,
			step:step
		}
	});
}

function showVideo(src, type) 
{
    var embed_video = "<video width='560px' height='278px' type='"+type+"' controls><source src='"+src+"'>Your browser does not support the video tag.</video>";
    $("#videoModal .modal-body").html(embed_video);
    $("#videoModal").modal("show");
}
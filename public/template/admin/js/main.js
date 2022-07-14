$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function removeRow(id,url){
    if (confirm('Bạn chắc là xóa chưa?')) {
        $.ajax({
            type: 'DELETE',
            dataType: 'JSON',
            data:{id},
            url: url,
            success: function (results){
                if(results.error == false){
                    alert('Xóa thành công');
                    location.reload();
                }else{
                    alert('Xóa thất bại');
                }
            }
        });
    }
}


// Upload files

$('#upload').change(function(){
    // console.log('123');
    const form = new FormData();
    form.append('file', $(this)[0].files[0]);

    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        dataType: 'JSON',
        data: form,
        url: '/admin/upload/services',
        success: function (results){
            if(results.error == false){
                $('#image_show').html('<a href="'+ results.url +'" target="_blank"><img src="'+ results.url +'" width="150px"></a>');
                $('#thumb').val(results.url);
            }else{
                alert('Tải ảnh không thành công');
            }
        }
    });
});
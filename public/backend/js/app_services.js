$(document).ready(function () {
    // jQuery.ajaxSetup({
    //     headers: { 'X-CSRF-Token' : jQuery('meta[name=_token]').attr('content') }
    // });
    //
    // CKEDITOR.replaceClass = 'ckeditor';

    jsInEmployee();

});

function jsInEmployee() {
    $( "#addRelative" )
    addRelative();
    themQuaTrinhCongTac();
    suaQuaTrinhCongTac();
}

function suaQuaTrinhCongTac() {
    $( ".suaQuaTrinhCongTac" ).click(function() {
        var index = $(this).attr('index');

        // $('.bodyqtct'+index).remove();
        var tu_ngay = $('.collapse'+index).remove();
        var tu_ngay = $('#thoigianCongTac'+index).attr('tungay');
        var den_ngay = $('#thoigianCongTac'+index).attr('denngay');
        $('#thoigianCongTac'+index).text('Sửa thông tin');
        var congviec = $('#congviec'+index).text();
        var ghichu = $('#ghichu'+index).text();
        var formBody = '<div class="portlet-body">' +
            '<div class="table-scrollable">' +
            '<table class="table table-striped table-hover">' +
            '<tr>'+
            '<th> Từ ngày </th>' +
            '<td> <input name="'+'quatrinhcongtac['+index+'][tu_ngay]" class="form-control" type="date" value="'+tu_ngay+'"> </td>' +
            '</tr>' +
            '<tr><th> Đến ngày </th><td> <input name="'+'quatrinhcongtac['+index+'][den_ngay]" class="form-control" type="date" value="'+den_ngay+'"> </td></tr>' +
            '<tr><th> Công việc </th><td><input name="'+'quatrinhcongtac['+index+'][congviect]" class="form-control" style="width: 100%;border: 1px solid #ccc" value="'+congviec+'"></td></tr>' +
            '<tr><th> Ghi chú </th><td><input name="'+'quatrinhcongtac['+index+'][ghichu]" class="form-control" style="width: 100%;border: 1px solid #ccc" value="'+ghichu+'"></td></tr>' +
            '</table>' +
            '</div>' +
            '</div>' ;
        $( ".bodyqtct"+index ).remove();
        $( "#prependQTCT"+index ).prepend(formBody);
    });
}



function themQuaTrinhCongTac() {
    $( "#addQuaTrinhCongTac" ).click(function() {
        var index = $(this).attr('index');
        alert(index);
        var formQuaTrinhCongTac ='  <div class="portlet box green">' +
            '<div class="portlet-title">' +
            '<div class="caption">' +
            '<i class="fa fa-user"></i><span>Sửa thông tin</span> </div>' +
            '<div class="tools">' +
            '<a href="javascript:;" class="collapse" data-original-title="" title=""> </a>' +
            '</div>' +
            '</div>' +
            '<div class="portlet-body">' +
            '<div class="table-scrollable">' +
            '<table class="table table-striped table-hover">' +
            '<tr>'+
            '<th> Từ ngày </th>' +
            '<td> <input name="'+'quatrinhcongtac['+index+'][tu_ngay]" class="form-control" type="date" value="2017-03-04"> </td>' +
            '</tr>' +
            '<tr><th> Đến ngày </th><td> <input name="'+'quatrinhcongtac['+index+'][den_ngay]" class="form-control" type="date" value="2017-03-04"> </td></tr>' +
            '<tr><th> Công việc </th><td><input name="'+'quatrinhcongtac['+index+'][congviect]" class="form-control" style="width: 100%;border: 1px solid #ccc" value="Cong Viec"></td></tr>' +
            '<tr><th> Ghi chú </th><td><input name="'+'quatrinhcongtac['+index+'][ghichu]" class="form-control" style="width: 100%;border: 1px solid #ccc" value="Ghi chu"></td></tr>' +
            '</table>' +
            '</div>' +
            '</div>' +
            '</div>';


        $( "#buttonAddQuaTrinhCongTac" ).prepend(formQuaTrinhCongTac);
        $(this).attr('index',index-1);
    });
}


function addRelative() {
    $( "#addRelative" ).click(function() {
        var index =parseInt($(this).attr('index'));
        var formRelative = "<div class='portlet box green'>"
            +"<div class='portlet-title'>"
            +"<div class='caption'>"
            +"<i class='fa fa-user'></i><span>Thêm thông tin người thân</span> </div>"
            +"<div class='tools'>"
            +"<a href='javascript:;' class='collapse' data-original-title='' title=''> </a>"
            +"<a href='javascript:;' class='remove' data-original-title='' title=''> </a>"
            + "</div>"
            + "</div>"
            + "<div class='portlet-body'>"
            + "<div class='table-scrollable'>"
            + "<table class='table table-striped table-hover'>"
            + "<tr>"
            +"<th> Họ và tên </th>"
            +"<td><input name="+'nguoithan['+index+'][hoten]'+" class='form-control' style='width: 100%' ></td>"
            + "</tr>"
            + "<tr>"
            +  "<th> Quan hệ là </th>"
            +"<td><input name="+'nguoithan['+index+'][quanhe]'+" class='form-control' style='width: 100%' ></td>"
            + "</tr>"
            +  "<tr>"
            + "<th> Ngày tháng năm sinh </th>"
            +"<td><input name="+'nguoithan['+index+'][namsinh]'+" class='form-control' type='date' value='{{$nguoithan->namsinh}}'> </td>"
            + '</tr>'
            + "<tr>"
            + "<th> Nghề nghiệp </th>"
            +"<td><input name="+'nguoithan['+index+'][nghenghiep]'+" class='form-control' style='width: 100%' ></td>"
            + "</tr>"
            +  "<tr>"
            +   "<th> Nguyên Quán </th>"
            +"<td><input name="+'nguoithan['+index+'][nguyenquan]'+" class='form-control' style='width: 100%' ></td>"
            +  "</tr>"
            + "<tr>"
            +  "<th> Địa Chỉ </th>"
            +"<td><input name="+'nguoithan['+index+'][diachi]'+" class='form-control' style='width: 100%' ></td>"
            + "</tr>"
            +  "<tr>"
            +   "<th> Điện thoại liên hệ </th>"
            + "<td><input name="+'nguoithan['+index+'][sdt]'+" class='form-control' style='width: 100%' ></td>"
            +    "</tr>"
            +   "<tr>"
            +   "<th> Địa chỉ công tác </th>"
            +"<td><input name="+'nguoithan['+index+'][diachi_congtac]'+" class='form-control' style='width: 100%' ></td>"
            +   "</tr>"
            +   "</table>"
            +    "</div>"
            +    "</div>"
            +    "</div>";


        $( "#buttonActionRelative" ).prepend(formRelative);
        $(this).attr('index',index-1);
    });
}

function startAjaxLoading() {
    $("#wait").css("display", "block");
    $.blockUI({ css: {
        border: 'none',
        padding: '15px',
        backgroundColor: 'none',
        '-webkit-border-radius': '10px',
        '-moz-border-radius': '10px',
        opacity: .5,
        color: '#fff'
    },
        message: '',
    });
}

function endAjaxLoading(){
    $("#wait").css("display", "none");
    $.unblockUI();
}
